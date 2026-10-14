<?php
/**
 * Pricing setup builder: funnel events logged on the site (in addition to GA4 / Clarity).
 *
 * - Table `{prefix}vzo_setup_events`, created/updated automatically (no manual migration).
 * - The builder JS sends every step to the REST endpoint POST /wp-json/viezo/v1/setup-event.
 * - "Form submitted" is logged server-side when WPForms accepts the entry (with the entry ID).
 * - Tools → Setup builder stats: funnel, answer breakdowns, recent leads, CSV export.
 *
 * Anonymous: no IP address, user agent or contact details are stored, only the funnel
 * session ID (random, per visit) and the answers. Events older than 24 months are deleted.
 *
 * @package Viezo
 */

const VZO_SETUP_EVENTS_DB_VERSION = '1';

/**
 * Events the endpoint accepts (setup_form_submitted is logged server-side only).
 */
const VZO_SETUP_EVENTS = [ 'setup_started', 'setup_step_answered', 'setup_result_viewed', 'setup_offer_clicked', 'setup_form_submitted' ];

/**
 * Events table name.
 *
 * @return string
 */
function vzo__setup_events_table() {
	global $wpdb;

	return $wpdb->prefix . 'vzo_setup_events';
}

/**
 * Create or update the events table when the stored schema version differs.
 */
function vzo__setup_events_install() {
	if ( get_option( 'vzo_setup_events_db' ) === VZO_SETUP_EVENTS_DB_VERSION ) {
		return;
	}

	global $wpdb;

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	dbDelta(
		'CREATE TABLE ' . vzo__setup_events_table() . " (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			created_at datetime NOT NULL,
			session varchar(64) NOT NULL DEFAULT '',
			event varchar(40) NOT NULL DEFAULT '',
			lang varchar(10) NOT NULL DEFAULT '',
			step tinyint(3) unsigned NOT NULL DEFAULT 0,
			question varchar(40) NOT NULL DEFAULT '',
			answer varchar(191) NOT NULL DEFAULT '',
			industry varchar(191) NOT NULL DEFAULT '',
			equipment varchar(191) NOT NULL DEFAULT '',
			challenge varchar(191) NOT NULL DEFAULT '',
			machines varchar(20) NOT NULL DEFAULT '',
			gateways varchar(20) NOT NULL DEFAULT '',
			case_key varchar(191) NOT NULL DEFAULT '',
			entry_id bigint(20) unsigned NOT NULL DEFAULT 0,
			PRIMARY KEY  (id),
			KEY created_at (created_at),
			KEY event (event),
			KEY session (session)
		) {$wpdb->get_charset_collate()};"
	);

	update_option( 'vzo_setup_events_db', VZO_SETUP_EVENTS_DB_VERSION, false );
}
add_action( 'admin_init', 'vzo__setup_events_install' );

/**
 * Insert one event.
 *
 * @param array $data Column => value.
 * @return bool
 */
function vzo__setup_events_insert( $data ) {
	global $wpdb;

	vzo__setup_events_install();

	$clean = function ( $value, $length = 191 ) {
		return mb_substr( sanitize_text_field( (string) $value ), 0, $length );
	};

	return (bool) $wpdb->insert(
		vzo__setup_events_table(),
		[
			'created_at' => current_time( 'mysql', true ),
			'session'    => $clean( $data['session'] ?? '', 64 ),
			'event'      => $clean( $data['event'] ?? '', 40 ),
			'lang'       => $clean( $data['lang'] ?? '', 10 ),
			'step'       => min( 255, absint( $data['step'] ?? 0 ) ),
			'question'   => $clean( $data['question'] ?? '', 40 ),
			'answer'     => $clean( $data['answer'] ?? '' ),
			'industry'   => $clean( $data['industry'] ?? '' ),
			'equipment'  => $clean( $data['equipment'] ?? '' ),
			'challenge'  => $clean( $data['challenge'] ?? '' ),
			'machines'   => $clean( $data['machines'] ?? '', 20 ),
			'gateways'   => $clean( $data['gateways'] ?? '', 20 ),
			'case_key'   => $clean( $data['case'] ?? '' ),
			'entry_id'   => absint( $data['entry_id'] ?? 0 ),
		]
	);
}

/**
 * REST endpoint for the builder's events. Public (anonymous visitors), so it only accepts
 * known events, a well-formed session ID and a limited number of events per session.
 */
function vzo__setup_events_rest() {
	register_rest_route(
		'viezo/v1',
		'/setup-event',
		[
			'methods'             => 'POST',
			'permission_callback' => '__return_true',
			'callback'            => function ( WP_REST_Request $request ) {
				// Sent with navigator.sendBeacon as text/plain (no CORS preflight), so parse the body.
				$data = json_decode( $request->get_body(), true );

				if ( ! is_array( $data ) ) {
					return new WP_REST_Response( null, 400 );
				}

				$event   = (string) ( $data['event'] ?? '' );
				$session = (string) ( $data['session'] ?? '' );

				if ( 'setup_form_submitted' === $event || ! in_array( $event, VZO_SETUP_EVENTS, true ) || ! preg_match( '/^[A-Za-z0-9-]{8,64}$/', $session ) ) {
					return new WP_REST_Response( null, 400 );
				}

				global $wpdb;
				vzo__setup_events_install();

				$count = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT COUNT(*) FROM ' . vzo__setup_events_table() . ' WHERE session = %s', $session ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared

				if ( $count >= 100 ) {
					return new WP_REST_Response( null, 429 );
				}

				vzo__setup_events_insert( $data );

				return new WP_REST_Response( null, 204 );
			},
		]
	);
}
add_action( 'rest_api_init', 'vzo__setup_events_rest' );

/**
 * Log "form submitted" server-side, once WPForms accepted the entry.
 *
 * @param array $fields    Sanitized fields.
 * @param array $entry     Raw entry.
 * @param array $form_data Form data.
 * @param int   $entry_id  Entry ID (0 when entries aren't stored).
 */
function vzo__setup_events_log_submission( $fields, $entry, $form_data, $entry_id ) {
	$map = function_exists( 'vzo__setup_builder_forms_map' ) ? vzo__setup_builder_forms_map() : [];

	if ( ! isset( $map[ (int) $form_data['id'] ] ) && ! in_array( $form_data['settings']['form_title'] ?? '', VZO_SETUP_FORM_TITLES, true ) ) {
		return;
	}

	$ids   = vzo__setup_builder_form_fields();
	$value = function ( $key ) use ( $fields, $ids ) {
		return (string) ( $fields[ $ids[ $key ] ]['value'] ?? '' );
	};

	// Language-independent answer keys: "industry=food; equipment=pumps,fans; challenge=…".
	$keys = [];
	foreach ( explode( ';', $value( 'keys' ) ) as $pair ) {
		$parts = array_map( 'trim', explode( '=', $pair, 2 ) );

		if ( 2 === count( $parts ) ) {
			$keys[ $parts[0] ] = $parts[1];
		}
	}

	// Case study: "Title (URL)" → English slug when possible (same key as the JS / GA4).
	$case = $value( 'case' );
	if ( preg_match( '/\((https?:\/\/[^)\s]+)\)$/', $case, $match ) ) {
		$post_id = url_to_postid( $match[1] );

		if ( $post_id && function_exists( 'pll_get_post' ) ) {
			$post_id = (int) pll_get_post( $post_id, pll_default_language() ) ?: $post_id;
		}

		$case = $post_id ? get_post_field( 'post_name', $post_id ) : trim( preg_replace( '/\s*\(.*$/', '', $case ) );
	}

	vzo__setup_events_insert(
		[
			'event'     => 'setup_form_submitted',
			'session'   => $value( 'session' ),
			'lang'      => $value( 'lang' ),
			'industry'  => $keys['industry'] ?? '',
			'equipment' => $keys['equipment'] ?? '',
			'challenge' => $keys['challenge'] ?? '',
			'machines'  => $value( 'machines' ),
			'gateways'  => $value( 'gateways' ),
			'case'      => $case,
			'entry_id'  => $entry_id,
		]
	);
}
add_action( 'wpforms_process_complete', 'vzo__setup_events_log_submission', 10, 4 );

/**
 * Daily cleanup: delete events older than 24 months.
 */
function vzo__setup_events_cleanup() {
	global $wpdb;

	$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . vzo__setup_events_table() . ' WHERE created_at < %s', gmdate( 'Y-m-d H:i:s', strtotime( '-24 months' ) ) ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
}
add_action( 'vzo_setup_events_cleanup', 'vzo__setup_events_cleanup' );

add_action(
	'init',
	function () {
		if ( ! wp_next_scheduled( 'vzo_setup_events_cleanup' ) ) {
			wp_schedule_event( time() + HOUR_IN_SECONDS, 'daily', 'vzo_setup_events_cleanup' );
		}
	}
);

// ── Admin: Tools → Setup builder stats ─────────────────────────────────────

/**
 * Selected period + language from the query string.
 *
 * @return array{days: int, lang: string, since: string, where: string, args: array}
 */
function vzo__setup_stats_filters() {
	$days = isset( $_GET['days'] ) ? absint( $_GET['days'] ) : 30; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$lang = isset( $_GET['lang'] ) ? sanitize_key( wp_unslash( $_GET['lang'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$days = in_array( $days, [ 7, 30, 90, 365, 0 ], true ) ? $days : 30;

	$where = [ '1=1' ];
	$args  = [];

	if ( $days ) {
		$where[] = 'created_at >= %s';
		$args[]  = gmdate( 'Y-m-d H:i:s', strtotime( "-{$days} days" ) );
	}

	if ( $lang ) {
		$where[] = 'lang = %s';
		$args[]  = $lang;
	}

	return [ 'days' => $days, 'lang' => $lang, 'where' => implode( ' AND ', $where ), 'args' => $args ];
}

/**
 * Run a stats query with the current filters.
 *
 * @param string $sql  SQL with {table} and {where} placeholders.
 * @param array  $args Extra prepare() args (after the filter args).
 * @return array
 */
function vzo__setup_stats_query( $sql, $args = [] ) {
	global $wpdb;

	$filters = vzo__setup_stats_filters();
	$sql     = str_replace( [ '{table}', '{where}' ], [ vzo__setup_events_table(), $filters['where'] ], $sql );
	$all     = array_merge( $filters['args'], $args );

	return $wpdb->get_results( $all ? $wpdb->prepare( $sql, $all ) : $sql, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
}

/**
 * Register the stats page.
 */
function vzo__setup_stats_menu() {
	add_management_page( __( 'Setup builder stats', 'viezo' ), __( 'Setup builder stats', 'viezo' ), 'edit_pages', 'vzo-setup-stats', 'vzo__setup_stats_page' );
}
add_action( 'admin_menu', 'vzo__setup_stats_menu' );

/**
 * CSV export of the raw events for the selected period / language.
 */
function vzo__setup_stats_export() {
	if ( ! current_user_can( 'edit_pages' ) ) {
		wp_die( esc_html__( 'Not allowed.', 'viezo' ) );
	}

	check_admin_referer( 'vzo_setup_stats_export' );
	vzo__setup_events_install();

	$rows = vzo__setup_stats_query( 'SELECT created_at, session, event, lang, step, question, answer, industry, equipment, challenge, machines, gateways, case_key, entry_id FROM {table} WHERE {where} ORDER BY id' );

	nocache_headers();
	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=setup-builder-events-' . gmdate( 'Y-m-d' ) . '.csv' );

	$out = fopen( 'php://output', 'w' );
	fputcsv( $out, [ 'created_at_utc', 'session', 'event', 'lang', 'step', 'question', 'answer', 'industry', 'equipment', 'challenge', 'machines', 'gateways', 'case', 'entry_id' ] );

	foreach ( $rows as $row ) {
		fputcsv( $out, $row );
	}

	fclose( $out ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose
	exit;
}
add_action( 'admin_post_vzo_setup_stats_export', 'vzo__setup_stats_export' );

/**
 * Render the stats page.
 */
function vzo__setup_stats_page() {
	vzo__setup_events_install();

	$filters = vzo__setup_stats_filters();
	$pct     = function ( $part, $whole ) {
		return $whole ? round( $part / $whole * 100 ) . '%' : '–';
	};

	// Funnel: distinct sessions per stage.
	$counts = [];
	foreach ( vzo__setup_stats_query( 'SELECT event, step, COUNT(DISTINCT session) n FROM {table} WHERE {where} GROUP BY event, step' ) as $row ) {
		$key            = 'setup_step_answered' === $row['event'] ? 'step_' . $row['step'] : $row['event'];
		$counts[ $key ] = (int) $row['n'];
	}

	$started = $counts['setup_started'] ?? 0;
	$stages  = [
		[ __( 'Started the builder', 'viezo' ), $started ],
		[ __( 'Answered: industry', 'viezo' ), $counts['step_1'] ?? 0 ],
		[ __( 'Answered: equipment', 'viezo' ), $counts['step_2'] ?? 0 ],
		[ __( 'Answered: challenge', 'viezo' ), $counts['step_3'] ?? 0 ],
		[ __( 'Answered: machines', 'viezo' ), $counts['step_4'] ?? 0 ],
		[ __( 'Saw the result', 'viezo' ), $counts['setup_result_viewed'] ?? 0 ],
		[ __( 'Clicked "Get my offer"', 'viezo' ), $counts['setup_offer_clicked'] ?? 0 ],
		[ __( 'Submitted the form', 'viezo' ), $counts['setup_form_submitted'] ?? 0 ],
	];

	// Breakdowns: sessions that saw a result vs. submitted, per answer (keys are language-independent).
	$breakdown = function ( $column ) {
		$data = [];

		foreach ( vzo__setup_stats_query( "SELECT event, {$column} v, COUNT(DISTINCT session) n FROM {table} WHERE {where} AND event IN ('setup_result_viewed','setup_form_submitted') AND {$column} <> '' GROUP BY event, {$column}" ) as $row ) {
			foreach ( array_filter( array_map( 'trim', explode( ',', $row['v'] ) ) ) as $value ) {
				$type                    = 'setup_form_submitted' === $row['event'] ? 'leads' : 'results';
				$data[ $value ][ $type ] = ( $data[ $value ][ $type ] ?? 0 ) + (int) $row['n'];
			}
		}

		uasort( $data, fn( $a, $b ) => ( $b['results'] ?? 0 ) <=> ( $a['results'] ?? 0 ) );

		return $data;
	};

	$leads = vzo__setup_stats_query( "SELECT created_at, lang, industry, equipment, challenge, machines, gateways, case_key, entry_id FROM {table} WHERE {where} AND event = 'setup_form_submitted' ORDER BY id DESC LIMIT 50" );
	$langs = array_column( vzo__setup_stats_query( "SELECT DISTINCT lang FROM {table} WHERE lang <> '' AND {where}" ), 'lang' );
	$base  = admin_url( 'tools.php?page=vzo-setup-stats' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Setup builder stats', 'viezo' ); ?></h1>
		<p class="description"><?php esc_html_e( 'Anonymous funnel events from the Pricing setup builder (no IP or contact details). Counts are unique visitor sessions. The same events also go to GA4 and Clarity.', 'viezo' ); ?></p>

		<form method="get" style="margin:16px 0;">
			<input type="hidden" name="page" value="vzo-setup-stats">
			<select name="days">
				<?php foreach ( [ 7 => __( 'Last 7 days', 'viezo' ), 30 => __( 'Last 30 days', 'viezo' ), 90 => __( 'Last 90 days', 'viezo' ), 365 => __( 'Last 12 months', 'viezo' ), 0 => __( 'All time', 'viezo' ) ] as $value => $label ) : ?>
					<option value="<?php echo (int) $value; ?>" <?php selected( $filters['days'], $value ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
			<select name="lang">
				<option value=""><?php esc_html_e( 'All languages', 'viezo' ); ?></option>
				<?php foreach ( array_unique( array_merge( [ 'en', 'pl' ], $langs ) ) as $lang ) : ?>
					<option value="<?php echo esc_attr( $lang ); ?>" <?php selected( $filters['lang'], $lang ); ?>><?php echo esc_html( strtoupper( $lang ) ); ?></option>
				<?php endforeach; ?>
			</select>
			<?php submit_button( __( 'Filter', 'viezo' ), 'secondary', '', false ); ?>
			<a class="button" href="<?php echo esc_url( wp_nonce_url( add_query_arg( [ 'action' => 'vzo_setup_stats_export', 'days' => $filters['days'], 'lang' => $filters['lang'] ], admin_url( 'admin-post.php' ) ), 'vzo_setup_stats_export' ) ); ?>"><?php esc_html_e( 'Export CSV', 'viezo' ); ?></a>
		</form>

		<h2><?php esc_html_e( 'Funnel', 'viezo' ); ?></h2>
		<table class="widefat striped" style="max-width:720px;">
			<thead><tr><th><?php esc_html_e( 'Stage', 'viezo' ); ?></th><th><?php esc_html_e( 'Sessions', 'viezo' ); ?></th><th><?php esc_html_e( 'of started', 'viezo' ); ?></th><th><?php esc_html_e( 'from previous', 'viezo' ); ?></th></tr></thead>
			<tbody>
				<?php foreach ( $stages as $i => [ $label, $count ] ) : ?>
					<tr>
						<td><?php echo esc_html( $label ); ?></td>
						<td><strong><?php echo (int) $count; ?></strong></td>
						<td>
							<?php echo esc_html( $pct( $count, $started ) ); ?>
							<div style="height:4px;margin-top:4px;background:#e6e6e6;"><div style="height:4px;width:<?php echo $started ? (int) round( $count / $started * 100 ) : 0; ?>%;max-width:100%;background:#2a6278;"></div></div>
						</td>
						<td><?php echo $i ? esc_html( $pct( $count, $stages[ $i - 1 ][1] ) ) : '–'; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php
		$labels = [];
		if ( function_exists( 'vzo__setup_builder_defaults' ) ) {
			foreach ( vzo__setup_builder_defaults()['options'] as $question => $options ) {
				$labels[ $question ] = wp_list_pluck( $options, 'label', 'key' );
			}
		}
		?>

		<div style="display:flex;flex-wrap:wrap;gap:24px;margin-top:24px;">
			<?php foreach ( [ 'industry' => __( 'Industry', 'viezo' ), 'equipment' => __( 'Equipment', 'viezo' ), 'challenge' => __( 'Main challenge', 'viezo' ), 'machines' => __( 'Machines', 'viezo' ), 'case_key' => __( 'Case study shown', 'viezo' ) ] as $column => $title ) : ?>
				<?php $rows = $breakdown( $column ); ?>
				<div style="flex:1 1 320px;max-width:480px;">
					<h2><?php echo esc_html( $title ); ?></h2>
					<table class="widefat striped">
						<thead><tr><th><?php esc_html_e( 'Answer', 'viezo' ); ?></th><th><?php esc_html_e( 'Saw result', 'viezo' ); ?></th><th><?php esc_html_e( 'Leads', 'viezo' ); ?></th><th><?php esc_html_e( 'Conversion', 'viezo' ); ?></th></tr></thead>
						<tbody>
							<?php if ( ! $rows ) : ?>
								<tr><td colspan="4"><em><?php esc_html_e( 'No data yet.', 'viezo' ); ?></em></td></tr>
							<?php endif; ?>
							<?php foreach ( $rows as $value => $row ) : ?>
								<tr>
									<td><?php echo esc_html( $labels[ $column ][ $value ] ?? $value ); ?></td>
									<td><?php echo (int) ( $row['results'] ?? 0 ); ?></td>
									<td><?php echo (int) ( $row['leads'] ?? 0 ); ?></td>
									<td><?php echo esc_html( $pct( $row['leads'] ?? 0, $row['results'] ?? 0 ) ); ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			<?php endforeach; ?>
		</div>

		<h2 style="margin-top:32px;"><?php esc_html_e( 'Latest leads', 'viezo' ); ?></h2>
		<table class="widefat striped">
			<thead><tr><th><?php esc_html_e( 'Date', 'viezo' ); ?></th><th><?php esc_html_e( 'Lang', 'viezo' ); ?></th><th><?php esc_html_e( 'Industry', 'viezo' ); ?></th><th><?php esc_html_e( 'Equipment', 'viezo' ); ?></th><th><?php esc_html_e( 'Challenge', 'viezo' ); ?></th><th><?php esc_html_e( 'Machines', 'viezo' ); ?></th><th><?php esc_html_e( 'Gateways', 'viezo' ); ?></th><th><?php esc_html_e( 'Case', 'viezo' ); ?></th><th></th></tr></thead>
			<tbody>
				<?php if ( ! $leads ) : ?>
					<tr><td colspan="9"><em><?php esc_html_e( 'No leads in this period.', 'viezo' ); ?></em></td></tr>
				<?php endif; ?>
				<?php foreach ( $leads as $lead ) : ?>
					<tr>
						<td><?php echo esc_html( get_date_from_gmt( $lead['created_at'], get_option( 'date_format' ) . ' H:i' ) ); ?></td>
						<td><?php echo esc_html( strtoupper( $lead['lang'] ) ); ?></td>
						<td><?php echo esc_html( $labels['industry'][ $lead['industry'] ] ?? $lead['industry'] ); ?></td>
						<td><?php echo esc_html( implode( ', ', array_map( fn( $k ) => $labels['equipment'][ $k ] ?? $k, array_filter( explode( ',', $lead['equipment'] ) ) ) ) ); ?></td>
						<td><?php echo esc_html( $labels['challenge'][ $lead['challenge'] ] ?? $lead['challenge'] ); ?></td>
						<td><?php echo esc_html( $lead['machines'] ); ?></td>
						<td><?php echo esc_html( $lead['gateways'] ); ?></td>
						<td><?php echo esc_html( $lead['case_key'] ); ?></td>
						<td>
							<?php if ( $lead['entry_id'] ) : ?>
								<a href="<?php echo esc_url( admin_url( 'admin.php?page=wpforms-entries&view=details&entry_id=' . (int) $lead['entry_id'] ) ); ?>"><?php esc_html_e( 'Entry', 'viezo' ); ?> →</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php
}
