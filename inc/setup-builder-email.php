<?php
/**
 * Pricing setup builder: confirmation email to the person who submitted the lead form.
 *
 * Sent after a successful WPForms submission of a setup builder lead form (EN / PL, or the
 * form chosen in the Pricing page's "Lead form" field). Texts come from the "Confirmation
 * email" tab of the "Pricing: Setup builder" field group, per language, with English
 * defaults in vzo__setup_builder_defaults(). The setup summary is built from the form's
 * hidden fields (see vzo__setup_builder_form_fields()).
 *
 * Template: templates/_setup_offer_email.php.
 *
 * @package Viezo
 */

/**
 * Default confirmation email texts per language. Used by the seed, to pre-fill empty fields
 * in the editor, and as the last fallback when sending.
 *
 * @param string $lang Language code ('en', 'pl').
 * @return array{subject: string, summary_title: string, body: string, footer: string}
 */
function vzo__setup_builder_email_defaults( $lang = 'en' ) {
	$texts = [
		'en' => [
			'subject'       => 'Your Sonora setup estimate',
			'summary_title' => 'Your estimated Sonora setup',
			'body'          => "Hi {name},\n\nThank you for your interest in Sonora!\n\nWe've received your request, and our team will review your requirements to prepare a tailored offer for your facility.\n\nYour estimated Sonora setup is included below for your reference.\n\n{summary}\n\nPlease note that this is a preliminary estimate. The final configuration and pricing will be confirmed based on your facility's specific requirements.\n\nWe'll be in touch shortly.\n\nBest regards,\nViezo Team\ninfo@viezo.lt\nwww.viezo.lt",
			'footer'        => 'VIEZO · info@viezo.lt · www.viezo.lt',
		],
		'pl' => [
			'subject'       => 'Twoja szacunkowa konfiguracja Sonora',
			'summary_title' => 'Twoja szacunkowa konfiguracja Sonora',
			'body'          => "Dzień dobry {name},\n\nDziękujemy za zainteresowanie Sonora!\n\nOtrzymaliśmy Twoje zapytanie. Nasz zespół przeanalizuje Twoje wymagania i przygotuje ofertę dopasowaną do Twojego zakładu.\n\nPoniżej znajdziesz szacunkową konfigurację Sonora do wglądu.\n\n{summary}\n\nPamiętaj, że jest to wstępna wycena. Ostateczna konfiguracja i cena zostaną potwierdzone na podstawie indywidualnych wymagań Twojego zakładu.\n\nWkrótce się z Tobą skontaktujemy.\n\nZ pozdrowieniami\nZespół Viezo\ninfo@viezo.lt\nwww.viezo.lt",
			'footer'        => 'VIEZO · info@viezo.lt · www.viezo.lt',
		],
	];

	return $texts[ $lang ] ?? $texts['en'];
}

/**
 * Editor: empty email fields show the default text of the page's language, so editors
 * always see (and edit) the real content. Saving the page stores it.
 */
foreach ( [ 'subject', 'summary_title', 'body', 'footer' ] as $vzo_email_field ) {
	add_filter(
		'acf/prepare_field/key=field_setup_email_' . $vzo_email_field,
		function ( $field ) use ( $vzo_email_field ) {
			if ( '' === trim( (string) $field['value'] ) ) {
				$post_id = (int) ( $_GET['post'] ?? 0 ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$lang    = $post_id && function_exists( 'pll_get_post_language' ) ? (string) pll_get_post_language( $post_id ) : 'en';

				$field['value'] = vzo__setup_builder_email_defaults( $lang ?: 'en' )[ $vzo_email_field ];
			}

			return $field;
		}
	);
}

/**
 * Pricing pages using the setup builder, keyed by their lead form ID.
 *
 * @return array Form ID => page ID.
 */
function vzo__setup_builder_forms_map() {
	$map   = [];
	$pages = get_posts(
		[
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'lang'           => '', // All languages (Polylang).
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => 'templates/pricing-setup.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		]
	);

	foreach ( $pages as $page_id ) {
		$form_id = vzo__setup_builder_form_id( $page_id );

		if ( $form_id ) {
			$map[ $form_id ] = $page_id;
		}
	}

	return $map;
}

/**
 * Setup summary rows from a submission, labelled in the page's language.
 *
 * @param array $fields WPForms fields (id => [ 'value' => … ]).
 * @param array $texts  Setup builder texts of the page.
 * @return array{rows: array, case: array|null}
 */
function vzo__setup_builder_email_summary( $fields, $texts ) {
	$ids   = vzo__setup_builder_form_fields();
	$value = function ( $key ) use ( $fields, $ids ) {
		return trim( (string) ( $fields[ $ids[ $key ] ]['value'] ?? '' ) );
	};

	$rows = array_filter(
		[
			$texts['industry_summary']  => $value( 'industry' ),
			$texts['equipment_summary'] => $value( 'equipment' ),
			$texts['challenge_summary'] => $value( 'challenge' ),
			$texts['machines_summary']  => $value( 'machines' ),
		],
		'strlen'
	);

	$points   = $value( 'points' );
	$gateways = $value( 'gateways' );

	if ( '' !== $points || '' !== $gateways ) {
		$rows[ $texts['estimate_label'] ] = trim(
			implode(
				' · ',
				array_filter(
					[
						'' !== $points ? $points . ' ' . $texts['points_label'] : '',
						'' !== $gateways ? $gateways . ' ' . $texts['gateways_label'] : '',
					]
				)
			)
		);
	}

	// Case study: "Title (https://…)".
	$case = null;
	if ( preg_match( '/^(.*)\s+\((https?:\/\/[^)\s]+)\)$/', $value( 'case' ), $match ) ) {
		$case = [
			'label' => $texts['summary_case_label'],
			'title' => $match[1],
			'url'   => $match[2],
			'link'  => $texts['summary_case_link'],
		];
	}

	return [ 'rows' => $rows, 'case' => $case ];
}

/**
 * Send the confirmation email after a setup builder form submission.
 *
 * @param array $fields    Sanitized fields.
 * @param array $entry     Raw entry.
 * @param array $form_data Form data.
 */
function vzo__setup_builder_send_confirmation( $fields, $entry, $form_data ) {
	$form_id = (int) ( $form_data['id'] ?? 0 );
	$map     = vzo__setup_builder_forms_map();

	// Fallback: a seeded form (by title) not chosen on any page → that language's Pricing page.
	if ( ! isset( $map[ $form_id ] ) && $map && in_array( $form_data['settings']['form_title'] ?? '', VZO_SETUP_FORM_TITLES, true ) ) {
		$lang = array_search( $form_data['settings']['form_title'], VZO_SETUP_FORM_TITLES, true );
		$any  = (int) reset( $map );

		$map[ $form_id ] = function_exists( 'pll_get_post' ) ? ( (int) pll_get_post( $any, $lang ) ?: $any ) : $any;
	}

	if ( empty( $map[ $form_id ] ) ) {
		return;
	}

	$page_id = $map[ $form_id ];
	$source  = function_exists( 'pll_get_post' ) && function_exists( 'pll_default_language' ) ? ( (int) pll_get_post( $page_id, pll_default_language() ) ?: $page_id ) : $page_id;
	$enabled = get_field( 'field_setup_email_enabled', $source, false ); // Synced setting: read it from English.

	// Default on: only an explicit "off" disables it.
	if ( '0' === (string) $enabled ) {
		return;
	}

	// Recipient: the form's first email field.
	$to   = '';
	$name = '';
	foreach ( $fields as $field ) {
		if ( ! $to && 'email' === ( $field['type'] ?? '' ) && is_email( $field['value'] ?? '' ) ) {
			$to = $field['value'];
		}

		if ( ! $name && in_array( $field['type'] ?? '', [ 'name', 'text' ], true ) && '' !== trim( (string) ( $field['value'] ?? '' ) ) ) {
			$name = (string) $field['value']; // First text/name field = "Name" in the seeded forms.
		}
	}

	if ( ! $to ) {
		return;
	}

	$config     = vzo__setup_builder_config( $page_id );
	$texts      = $config['texts'];
	$first_name = trim( strtok( trim( $name ), ' ' ) ?: '' );
	$summary    = vzo__setup_builder_email_summary( $fields, $texts );
	$lang       = $config['lang'] ?: 'en';

	$args = [
		'lang'          => $lang,
		'subject'       => $texts['email_subject'],
		'summary_title' => $texts['email_summary_title'],
		'body'          => $texts['email_body'],
		'first_name'    => $first_name,
		'summary'       => $summary,
		'site_url'      => home_url( '/' ),
		'footer'        => (string) ( $texts['email_footer'] ?? '' ),
	];

	ob_start();
	get_template_part( 'templates/_setup_offer_email', null, $args );
	$html = ob_get_clean();

	// Plain-text version for clients that don't show HTML (and better deliverability).
	$plain = vzo__setup_builder_email_plain( $args );
	$alt   = function ( $phpmailer ) use ( $plain ) {
		$phpmailer->AltBody = $plain; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
	};

	add_action( 'phpmailer_init', $alt );

	wp_mail(
		$to,
		$args['subject'],
		$html,
		[
			'Content-Type: text/html; charset=UTF-8',
			'Reply-To: Viezo <' . get_option( 'admin_email' ) . '>',
		]
	);

	remove_action( 'phpmailer_init', $alt );
}
add_action( 'wpforms_process_complete', 'vzo__setup_builder_send_confirmation', 20, 3 );

/**
 * Paragraphs of the email text: blank lines separate paragraphs, "{summary}" stands alone.
 *
 * @param string $body       Email text.
 * @param string $first_name First name ('' removes the placeholder and the space before it).
 * @return string[]
 */
function vzo__setup_builder_email_paragraphs( $body, $first_name ) {
	$body = $first_name ? str_replace( '{name}', $first_name, $body ) : preg_replace( '/\s*\{name\}/', '', $body );
	$body = str_replace( "\r\n", "\n", $body );

	return array_values( array_filter( array_map( 'trim', preg_split( "/\n\s*\n/", $body ) ), 'strlen' ) );
}

/**
 * Plain-text version of the email.
 *
 * @param array $args Template arguments.
 * @return string
 */
function vzo__setup_builder_email_plain( $args ) {
	$lines = [];

	foreach ( vzo__setup_builder_email_paragraphs( $args['body'], $args['first_name'] ) as $paragraph ) {
		if ( '{summary}' === $paragraph ) {
			$lines[] = strtoupper( $args['summary_title'] );

			foreach ( $args['summary']['rows'] as $label => $value ) {
				$lines[] = $label . ': ' . $value;
			}

			if ( $args['summary']['case'] ) {
				$lines[] = $args['summary']['case']['label'] . ': ' . $args['summary']['case']['title'] . ' – ' . $args['summary']['case']['url'];
			}
		} else {
			$lines[] = $paragraph;
		}

		$lines[] = '';
	}

	if ( ! empty( $args['footer'] ) ) {
		$lines[] = '--';
		$lines[] = $args['footer'];
	}

	return trim( implode( "\n", $lines ) );
}
