<?php
/**
 * Content seeds.
 *
 * Seeds are PHP files in /seeds that fill in content (ACF fields, options, …) after a
 * migration or on a fresh environment. Run them from Tools → Viezo seeds.
 *
 * Each seed file returns an array:
 *
 *   return [
 *       'title'       => 'Contact page: distributors & partners',
 *       'description' => 'What it does.',
 *       'run'         => function () { …; return 'Result message'; },
 *   ];
 *
 * The file name (without .php) is the seed ID. See docs/seeds.md.
 *
 * @package Viezo
 */

const VZO_SEEDS_OPTION = 'vzo__seeds_log';

/**
 * Get all seeds, keyed by ID.
 *
 * @return array
 */
function vzo__get_seeds() {
	$seeds = [];

	foreach ( glob( get_template_directory() . '/seeds/*.php' ) as $file ) {
		$seed = include $file;

		if ( is_array( $seed ) && isset( $seed['run'] ) && is_callable( $seed['run'] ) ) {
			$seeds[ basename( $file, '.php' ) ] = $seed;
		}
	}

	return $seeds;
}

/**
 * Register the Tools → Viezo seeds page.
 */
function vzo__seeds_admin_menu() {
	add_management_page( __( 'Viezo seeds', 'viezo' ), __( 'Viezo seeds', 'viezo' ), 'manage_options', 'vzo-seeds', 'vzo__seeds_page' );
}
add_action( 'admin_menu', 'vzo__seeds_admin_menu' );

/**
 * Run a seed (form submit handler).
 */
function vzo__seeds_handle_run() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Not allowed.', 'viezo' ) );
	}

	$id = isset( $_POST['seed'] ) ? sanitize_key( wp_unslash( $_POST['seed'] ) ) : '';
	check_admin_referer( 'vzo_run_seed_' . $id );

	$seeds = vzo__get_seeds();

	if ( ! isset( $seeds[ $id ] ) ) {
		wp_die( esc_html__( 'Unknown seed.', 'viezo' ) );
	}

	try {
		$message = (string) call_user_func( $seeds[ $id ]['run'] );
		$status  = 'success';
	} catch ( Throwable $e ) {
		$message = $e->getMessage();
		$status  = 'error';
	}

	$log        = get_option( VZO_SEEDS_OPTION, [] );
	$log[ $id ] = [
		'time'    => time(),
		'user'    => wp_get_current_user()->user_login,
		'status'  => $status,
		'message' => $message,
	];
	update_option( VZO_SEEDS_OPTION, $log, false );

	wp_safe_redirect( add_query_arg( [ 'page' => 'vzo-seeds', 'ran' => $id ], admin_url( 'tools.php' ) ) );
	exit;
}
add_action( 'admin_post_vzo_run_seed', 'vzo__seeds_handle_run' );

/**
 * Render the seeds admin page.
 */
function vzo__seeds_page() {
	$seeds = vzo__get_seeds();
	$log   = get_option( VZO_SEEDS_OPTION, [] );
	$ran   = isset( $_GET['ran'] ) ? sanitize_key( wp_unslash( $_GET['ran'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Viezo seeds', 'viezo' ); ?></h1>
		<p><?php esc_html_e( 'Fill in theme content after a migration or on a fresh environment. Seeds overwrite the fields they set, so re-running is safe but replaces manual edits to those fields.', 'viezo' ); ?></p>

		<?php if ( $ran && isset( $log[ $ran ] ) ) : ?>
			<div class="notice notice-<?php echo 'success' === $log[ $ran ]['status'] ? 'success' : 'error'; ?> is-dismissible">
				<p><strong><?php echo esc_html( $seeds[ $ran ]['title'] ?? $ran ); ?>:</strong> <?php echo esc_html( $log[ $ran ]['message'] ); ?></p>
			</div>
		<?php endif; ?>

		<table class="widefat striped" style="max-width: 1000px;">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Seed', 'viezo' ); ?></th>
					<th><?php esc_html_e( 'Last run', 'viezo' ); ?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( ! $seeds ) : ?>
					<tr><td colspan="3"><?php esc_html_e( 'No seeds found in /seeds.', 'viezo' ); ?></td></tr>
				<?php endif; ?>

				<?php foreach ( $seeds as $id => $seed ) : ?>
					<?php $entry = $log[ $id ] ?? null; ?>
					<tr>
						<td>
							<strong><?php echo esc_html( $seed['title'] ?? $id ); ?></strong>
							<code style="margin-left: 6px;"><?php echo esc_html( $id ); ?></code>
							<?php if ( ! empty( $seed['description'] ) ) : ?>
								<p class="description"><?php echo esc_html( $seed['description'] ); ?></p>
							<?php endif; ?>
						</td>
						<td>
							<?php if ( $entry ) : ?>
								<?php echo esc_html( wp_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $entry['time'] ) ); ?>
								<br><small><?php echo esc_html( $entry['user'] . ' · ' . $entry['status'] ); ?></small>
							<?php else : ?>
								<em><?php esc_html_e( 'Never', 'viezo' ); ?></em>
							<?php endif; ?>
						</td>
						<td style="text-align: right;">
							<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
								<?php if ( $entry ) : ?>
									onsubmit="return confirm('<?php echo esc_js( __( 'This seed already ran. Run it again and overwrite its fields?', 'viezo' ) ); ?>');"
								<?php endif; ?>
							>
								<input type="hidden" name="action" value="vzo_run_seed">
								<input type="hidden" name="seed" value="<?php echo esc_attr( $id ); ?>">
								<?php wp_nonce_field( 'vzo_run_seed_' . $id ); ?>
								<?php submit_button( $entry ? __( 'Run again', 'viezo' ) : __( 'Run', 'viezo' ), $entry ? 'secondary' : 'primary', 'submit', false ); ?>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php
}

/**
 * Find a page by its page template, in the default language when Polylang is active.
 *
 * @param string $template Template path, e.g. 'templates/contacts.php'.
 * @return int Page ID, or 0.
 */
function vzo__seed_find_page_by_template( $template ) {
	$args = [
		'post_type'      => 'page',
		'post_status'    => 'any',
		'posts_per_page' => 1,
		'fields'         => 'ids',
		'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		'meta_value'     => $template, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
	];

	if ( function_exists( 'pll_default_language' ) ) {
		$args['lang'] = pll_default_language();
	}

	$ids = get_posts( $args );

	return $ids ? (int) $ids[0] : 0;
}

/**
 * Import an image from /seeds/assets into the Media Library (once).
 *
 * Re-running returns the existing attachment instead of creating duplicates.
 *
 * @param string $filename File name inside /seeds/assets.
 * @return int Attachment ID, or 0 when the file doesn't exist.
 */
function vzo__seed_import_image( $filename ) {
	$path = get_template_directory() . '/seeds/assets/' . $filename;

	if ( ! $filename || ! is_readable( $path ) ) {
		return 0;
	}

	$existing = get_posts(
		[
			'post_type'      => 'attachment',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_vzo_seed_source', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => $filename, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		]
	);

	if ( $existing ) {
		return (int) $existing[0];
	}

	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/media.php'; // Video/audio metadata.

	// Write straight into the uploads folder (no PHP temp dir: some hosts don't allow moving
	// files out of it, which made media_handle_sideload() fail with "could not be moved").
	$uploads = wp_upload_dir();

	if ( ! empty( $uploads['error'] ) ) {
		throw new RuntimeException( sprintf( 'Could not import %s: %s', $filename, $uploads['error'] ) );
	}

	if ( ! wp_is_writable( $uploads['path'] ) ) {
		throw new RuntimeException( sprintf( 'Could not import %s: the uploads folder %s is not writable by PHP (check its permissions/owner).', $filename, $uploads['path'] ) );
	}

	$upload = wp_upload_bits( basename( $filename ), null, file_get_contents( $path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local theme file.

	if ( ! empty( $upload['error'] ) ) {
		throw new RuntimeException( sprintf( 'Could not import %s: %s', $filename, $upload['error'] ) );
	}

	$type = wp_check_filetype( $upload['file'] );
	$id   = wp_insert_attachment(
		[
			'post_mime_type' => $type['type'] ?: 'application/octet-stream',
			'post_title'     => sanitize_text_field( pathinfo( $filename, PATHINFO_FILENAME ) ),
			'post_status'    => 'inherit',
			'guid'           => $upload['url'],
		],
		$upload['file'],
		0,
		true
	);

	if ( is_wp_error( $id ) ) {
		wp_delete_file( $upload['file'] );
		throw new RuntimeException( sprintf( 'Could not import %s: %s', $filename, $id->get_error_message() ) );
	}

	// Thumbnails are optional: if the server can't resize this format, the full image still works.
	wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );
	update_post_meta( $id, '_vzo_seed_source', $filename );

	return (int) $id;
}
