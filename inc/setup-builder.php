<?php
/**
 * Pricing "Setup builder" funnel (templates/pricing-setup.php).
 *
 * Content comes from the ACF group "Pricing: Setup builder" on the Pricing page
 * (acf-json/field-groups/pricing-setup-builder.json), per language. Empty fields on a
 * translation fall back to the English page (vzo__get_shared_field()), and then to the
 * English defaults below, so the builder always renders.
 *
 * Markup: partials/setup-builder.php. Behaviour + tracking: src/js/templates/setup-builder.js.
 * Initial content and the WPForms forms: seeds/pricing-setup.php.
 *
 * @package Viezo
 */

/**
 * WPForms form titles per language. Used as a fallback when the page's "Lead form"
 * field is empty, and by the seed.
 */
const VZO_SETUP_FORM_TITLES = [
	'en' => 'Pricing setup offer (EN)',
	'pl' => 'Pricing setup offer (PL)',
];

/**
 * The three choice questions, in order. The machines slider is the 4th step.
 */
const VZO_SETUP_QUESTIONS = [ 'industry', 'equipment', 'challenge' ];

/**
 * WPForms hidden field IDs, filled by JS. Same IDs in every language's form.
 * Must match the fields created in seeds/pricing-setup.php.
 *
 * @return array Key => field ID.
 */
function vzo__setup_builder_form_fields() {
	return [
		'industry'  => 5,
		'equipment' => 6,
		'challenge' => 7,
		'machines'  => 8,
		'points'    => 9,
		'gateways'  => 10,
		'case'      => 11,
		'session'   => 12,
		'lang'      => 13,
		'keys'      => 14,
	];
}

/**
 * Icon library for answer options: 24×24 line drawings, stroke = currentColor.
 * Keys are the choices of the ACF "Icon" field.
 *
 * @return array Key => [ label, SVG paths ].
 */
function vzo__setup_builder_icons() {
	return [
		'layers'     => [ 'Layers / wood', '<path d="M3 8l9-4 9 4-9 4z"/><path d="M3 12l9 4 9-4M3 16l9 4 9-4"/>' ],
		'bottles'    => [ 'Bottles / food', '<path d="M6 3h3v3l1.5 2.5V21h-6V8.5L6 6z"/><path d="M13.5 10h7v11h-7zM13.5 10l1.5-3h4l1.5 3M4.5 13h6"/>' ],
		'box'        => [ 'Box / packaging', '<path d="M21 7.5l-9-4.5-9 4.5v9l9 4.5 9-4.5z"/><path d="M3 7.5l9 4.5 9-4.5M12 12v9M7.5 5.25l9 4.5"/>' ],
		'car'        => [ 'Car', '<path d="M5 11l2-5h10l2 5"/><rect x="3" y="11" width="18" height="6" rx="1.5"/><circle cx="7.5" cy="14" r="1"/><circle cx="16.5" cy="14" r="1"/><path d="M5.5 17v2M18.5 17v2"/>' ],
		'beam'       => [ 'Steel beam / metal', '<path d="M5 4h14v3h-5v10h5v3H5v-3h5V7H5z"/>' ],
		'factory'    => [ 'Factory', '<path d="M2 21h20M4 21V10l5 3.5V10l5 3.5V10l5 3.5V3h2v18"/><path d="M7 17h2M12 17h2M17 17h1"/>' ],
		'motor'      => [ 'Motor', '<rect x="4" y="7" width="12" height="10" rx="1.5"/><path d="M8 7V5h4v2M16 10h3v4h-3M19 12h3M7 17v2M13 17v2M8 10v4M12 10v4"/>' ],
		'fan'        => [ 'Fan', '<circle cx="12" cy="12" r="1.5"/><path d="M12 10.5C11 7 12 3.5 15 4s2 5-1.5 6.5M13.5 12c3.5-1 7 0 6.5 3s-5 2-6.5-1.5M10.5 12.5C7 13.5 3.5 12.5 4 9.5s5-2 6.5 1.5"/>' ],
		'pump'       => [ 'Pump', '<circle cx="10" cy="13" r="6"/><circle cx="10" cy="13" r="2"/><path d="M10 7V3h5M16 13h5M4 21h12"/>' ],
		'gear'       => [ 'Gear / gearbox', '<circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="7"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.9 4.9L7 7M17 17l2.1 2.1M4.9 19.1L7 17M17 7l2.1-2.1"/>' ],
		'compressor' => [ 'Compressor', '<rect x="3" y="8" width="18" height="10" rx="5"/><path d="M7 8V5h4v3M13 8V5h4v3M6 18v2M18 18v2"/>' ],
		'saw'        => [ 'Saw blade / cutter', '<circle cx="12" cy="12" r="2"/><path d="M12 3l2 2.5 3-1 .5 3 3 .5-1 3L21 12l-2.5 2 1 3-3 .5-.5 3-3-1L12 21l-2-2.5-3 1-.5-3-3-.5 1-3L3 12l2.5-2-1-3 3-.5.5-3 3 1z"/>' ],
		'warning'    => [ 'Warning', '<path d="M12 3L2 20h20z"/><path d="M12 9.5v4.5M12 16.8v.2"/>' ],
		'bearing'    => [ 'Bearing', '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="5.5" r="1.2"/><circle cx="12" cy="18.5" r="1.2"/><circle cx="5.5" cy="12" r="1.2"/><circle cx="18.5" cy="12" r="1.2"/>' ],
		'search'     => [ 'Magnifier', '<circle cx="10" cy="10" r="6"/><path d="M14.5 14.5L21 21"/>' ],
		'wave'       => [ 'Vibration wave', '<path d="M2 12h4l2-5 3 11 3-14 3 11 2-3h3"/>' ],
		'calendar'   => [ 'Calendar', '<rect x="3" y="5" width="18" height="16" rx="1.5"/><path d="M3 10h18M8 3v4M16 3v4M12 13v3.5l2 1.5"/>' ],
		'clock'      => [ 'Stopwatch / downtime', '<circle cx="12" cy="13.5" r="7.5"/><path d="M12 9.5v4l2.5 2M9.5 3h5M12 3v3M18.5 6.5l1.5-1.5"/>' ],
		'people'     => [ 'People / staff', '<circle cx="9" cy="8" r="3"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="17" cy="9" r="2.5"/><path d="M15.5 14.2c3 .2 5.5 2.6 5.5 5.8"/>' ],
		'hourglass'  => [ 'Hourglass / lifetime', '<path d="M6 3h12M6 21h12M7 3v2a5 5 0 0010 0V3M7 21v-2a5 5 0 0110 0v2"/>' ],
		'dots'       => [ 'Other (dots)', '<circle cx="12" cy="12" r="9"/><circle cx="8" cy="12" r=".6"/><circle cx="12" cy="12" r=".6"/><circle cx="16" cy="12" r=".6"/>' ],
	];
}

/**
 * English defaults: used when a field is empty on the page and its English translation,
 * and as the English seed content.
 *
 * @return array
 */
function vzo__setup_builder_defaults() {
	return [
		'texts'     => [
			'eyebrow'            => 'Sonora setup builder',
			'step_label'         => 'Step {current} of {total}',
			'next_label'         => 'Next step',
			'back_label'         => 'Back',
			'industry_title'     => 'What do you manufacture?',
			'industry_subtitle'  => 'Select the industry that best describes your production.',
			'industry_summary'   => 'Industry',
			'equipment_title'    => 'What equipment do you want to monitor?',
			'equipment_subtitle' => 'Select all that apply.',
			'equipment_summary'  => 'Equipment',
			'challenge_title'    => 'What is your main maintenance challenge?',
			'challenge_subtitle' => 'Select the biggest challenge for your team.',
			'challenge_summary'  => 'Main challenge',
			'machines_title'     => 'How many machines would you like to monitor?',
			'machines_subtitle'  => 'Select an approximate number. You can adjust this later.',
			'machines_unit'      => 'machines / measuring points',
			'machines_summary'   => 'Machines / measuring points',
			'machines_note'      => 'On average, one gateway supports up to {sensors} sensors. We’ll suggest the optimal setup for your environment.',
			'show_result_label'  => 'Show my result',
			'result_counter'     => 'Your setup',
			'result_title'       => 'Your Sonora setup',
			'result_subtitle'    => 'Based on your answers, here’s an estimated setup for your factory and a real example from a similar environment.',
			'points_label'       => 'measuring points',
			'gateways_label'     => 'gateways',
			'case_eyebrow'       => 'Real case from a similar environment',
			'detected_label'     => 'Detected',
			'outcome_label'      => 'Outcome',
			'case_link_label'    => 'View full case study',
			'cta_title'          => 'Want the actual price for this setup?',
			'cta_text'           => 'Get a tailored offer from our team.',
			'cta_button'         => 'Get my offer',
			'offer_counter'      => 'Final step',
			'offer_eyebrow'      => 'Get your offer',
			'offer_title'        => 'Almost there!',
			'offer_subtitle'     => 'Leave your details and we’ll get back to you with a tailored offer based on your setup. No commitment, just a conversation.',
			'privacy_note'       => 'We’ll only use your information to contact you about Sonora.',
			'summary_title'      => 'Your setup summary',
			'edit_label'         => 'Edit',
			'estimate_label'     => 'Estimated setup',
			'summary_case_label' => 'Relevant case study',
			'summary_case_link'  => 'View case study',
			// Confirmation email to the person who submitted the form (inc/setup-builder-email.php).
			'email_subject'       => vzo__setup_builder_email_defaults( 'en' )['subject'],
			'email_summary_title' => vzo__setup_builder_email_defaults( 'en' )['summary_title'],
			'email_body'          => vzo__setup_builder_email_defaults( 'en' )['body'],
			'email_footer'        => vzo__setup_builder_email_defaults( 'en' )['footer'],
		],
		'multiple'  => [
			'industry'  => false,
			'equipment' => true,
			'challenge' => false,
		],
		'options'   => [
			'industry'  => [
				[ 'key' => 'furniture', 'label' => 'Furniture & wood', 'icon' => 'layers' ],
				[ 'key' => 'food', 'label' => 'Food & beverage', 'icon' => 'bottles' ],
				[ 'key' => 'packaging', 'label' => 'Packaging', 'icon' => 'box' ],
				[ 'key' => 'automotive', 'label' => 'Automotive', 'icon' => 'car' ],
				[ 'key' => 'metal', 'label' => 'Metal processing', 'icon' => 'beam' ],
				[ 'key' => 'other', 'label' => 'Other manufacturing', 'icon' => 'factory' ],
			],
			'equipment' => [
				[ 'key' => 'motors', 'label' => 'Motors', 'icon' => 'motor' ],
				[ 'key' => 'fans', 'label' => 'Fans', 'icon' => 'fan' ],
				[ 'key' => 'pumps', 'label' => 'Pumps', 'icon' => 'pump' ],
				[ 'key' => 'gearboxes', 'label' => 'Gearboxes', 'icon' => 'gear' ],
				[ 'key' => 'compressors', 'label' => 'Compressors', 'icon' => 'compressor' ],
				[ 'key' => 'spindles', 'label' => 'Spindles & cutters', 'icon' => 'saw' ],
			],
			'challenge' => [
				[ 'key' => 'manual', 'label' => 'Too frequent manual vibration monitoring', 'icon' => 'wave' ],
				[ 'key' => 'unexpected', 'label' => 'Unexpected failures', 'icon' => 'warning' ],
				[ 'key' => 'downtime', 'label' => 'Expensive downtime', 'icon' => 'clock' ],
				[ 'key' => 'staff', 'label' => 'Not enough maintenance staff', 'icon' => 'people' ],
				[ 'key' => 'lifetime', 'label' => 'Too short lifetime of the assets', 'icon' => 'hourglass' ],
				[ 'key' => 'other', 'label' => 'Other', 'icon' => 'dots' ],
			],
		],
		'stops'     => '1, 10, 50, 100, 250',
		'default'   => 40,
		'sensors'   => 20,
		// Most generic first: it wins ties. `slug` = English case-study slug.
		'cases'     => [
			[ 'slug' => 'bearing-fault', 'industry' => [ 'furniture' ], 'equipment' => [ 'motors' ], 'challenge' => [ 'unexpected', 'downtime' ], 'tag' => 'Furniture industry', 'machine' => 'IMA KFA corner rounding unit', 'detected' => 'Developing bearing wear, before any visible or audible signs', 'outcome' => 'Maintenance acted in time, avoiding unplanned downtime and damage to surrounding parts' ],
			[ 'slug' => 'pump-failure', 'industry' => [ 'packaging' ], 'equipment' => [ 'pumps' ], 'challenge' => [ 'unexpected', 'downtime' ], 'tag' => 'Packaging industry', 'machine' => 'Bosch Rexroth H14 pump', 'detected' => 'Growing shaft misalignment on a pump circulating 2 tons of oil', 'outcome' => 'Proactive replacement avoided system contamination and a two-week stop, saving over €46,000' ],
			[ 'slug' => 'circulation-pump-bearing-failure', 'industry' => [ 'other' ], 'equipment' => [ 'pumps' ], 'challenge' => [ 'lifetime', 'unexpected' ], 'tag' => 'Construction materials', 'machine' => 'Circulation pump', 'detected' => 'Shaft misalignment and early bearing wear', 'outcome' => 'Bearing deterioration confirmed and handled before a catastrophic failure' ],
			[ 'slug' => 'fan-fault', 'industry' => [ 'furniture' ], 'equipment' => [ 'fans' ], 'challenge' => [ 'unexpected', 'manual' ], 'tag' => 'Furniture industry', 'machine' => 'Industrial fan', 'detected' => 'Sharp rise in vibration levels pointing to impeller damage', 'outcome' => 'Fan replaced in a controlled way, before the impeller was critically damaged' ],
			[ 'slug' => 'exhaust-fan-motor-bearing-fault', 'industry' => [ 'furniture' ], 'equipment' => [ 'fans', 'motors' ], 'challenge' => [ 'manual', 'downtime' ], 'tag' => 'Furniture industry', 'machine' => 'Extraction system exhaust fan', 'detected' => 'Unusual noise level; the impeller was found touching the housing', 'outcome' => 'Planned maintenance instead of an extraction system failure' ],
			[ 'slug' => 'blower-bearing-wear', 'industry' => [ 'metal', 'automotive' ], 'equipment' => [ 'fans', 'motors' ], 'challenge' => [ 'lifetime', 'unexpected' ], 'tag' => 'Metal processing', 'machine' => 'Air-injection blower', 'detected' => 'Developing bearing wear (worn bearing seats)', 'outcome' => 'Motor replaced in a planned way before the issue escalated' ],
			[ 'slug' => 'kekava-ammonia-compressor-fault', 'industry' => [ 'food' ], 'equipment' => [ 'compressors', 'motors' ], 'challenge' => [ 'unexpected', 'lifetime' ], 'tag' => 'Food industry', 'machine' => 'Ammonia compressor', 'detected' => 'Bearing issue on the compressor motor, on the day the sensors were installed', 'outcome' => 'Maintained before the bearing reached critical failure' ],
			[ 'slug' => 'gear-fault-detection', 'industry' => [ 'furniture' ], 'equipment' => [ 'gearboxes' ], 'challenge' => [ 'downtime', 'unexpected' ], 'tag' => 'Furniture industry', 'machine' => 'Cut-off system sluice gear', 'detected' => 'Gear fault 10 days after installation, with 2–4 weeks of gear life left', 'outcome' => 'Repaired on a Sunday in 4 hours, avoiding about €3,000 of downtime' ],
			[ 'slug' => 'spindle-imbalance', 'industry' => [ 'furniture' ], 'equipment' => [ 'spindles' ], 'challenge' => [ 'lifetime', 'downtime' ], 'tag' => 'Furniture industry', 'machine' => 'Drilling machine spindle, 13 kW', 'detected' => 'Tool imbalance behind repeated spindle bearing failures', 'outcome' => 'Root cause removed, avoiding about €7,500 per spindle replacement' ],
			[ 'slug' => 'diamond-cutter-fault', 'industry' => [ 'furniture' ], 'equipment' => [ 'spindles' ], 'challenge' => [ 'downtime', 'unexpected' ], 'tag' => 'Furniture industry', 'machine' => 'Diamond cutter', 'detected' => 'Shaft imbalance, confirmed during inspection', 'outcome' => 'Tool replaced during scheduled maintenance, no stop on a 24/7 line' ],
			[ 'slug' => 'planer-bearing-fault', 'industry' => [ 'furniture' ], 'equipment' => [ 'spindles', 'motors' ], 'challenge' => [ 'downtime', 'manual' ], 'tag' => 'Furniture industry', 'machine' => 'Six-head planer', 'detected' => 'Initial wear on a planer head bearing', 'outcome' => 'Repair scheduled outside working hours, avoiding about €1,200 of downtime' ],
			[ 'slug' => 'shredder-failure', 'industry' => [ 'furniture' ], 'equipment' => [ 'motors' ], 'challenge' => [ 'staff', 'manual' ], 'tag' => 'Furniture industry', 'machine' => 'Shredding system', 'detected' => 'Rapid rise in vibration revealing a multi-layered fault', 'outcome' => 'Root causes found step by step and the shredder fully stabilised' ],
			[ 'slug' => 'shredder-engine-fault', 'industry' => [ 'furniture' ], 'equipment' => [ 'spindles' ], 'challenge' => [ 'downtime', 'staff' ], 'tag' => 'Furniture industry', 'machine' => 'Shredding system shaft', 'detected' => 'Tool wear / imbalance on the shaft', 'outcome' => 'Repaired during planned maintenance on a 24/7 line' ],
		],
	];
}

/**
 * Read a setup builder field by key, with the English page as fallback.
 *
 * @param string   $name    Field name without the `setup_` prefix.
 * @param int|null $post_id Page ID.
 * @return mixed
 */
function vzo__setup_builder_field( $name, $post_id = null ) {
	return vzo__get_shared_field( 'field_setup_' . $name, $post_id );
}

/**
 * Answer options of one question for a page.
 *
 * @param string   $question Question key.
 * @param int|null $post_id  Page ID.
 * @return array[] Rows of key, label, icon.
 */
function vzo__setup_builder_options( $question, $post_id = null ) {
	$rows    = vzo__setup_builder_field( $question . '_options', $post_id );
	$options = [];

	foreach ( is_array( $rows ) ? $rows : [] as $row ) {
		$key = sanitize_title( $row['key'] ?? '' );

		if ( $key && ! empty( $row['label'] ) ) {
			$options[] = [
				'key'   => $key,
				'label' => $row['label'],
				'icon'  => $row['icon'] ?? '',
			];
		}
	}

	return $options ?: vzo__setup_builder_defaults()['options'][ $question ];
}

/**
 * Lead form for the current language: the page's "Lead form" field, otherwise the form
 * titled for this language. 0 if none exists.
 *
 * @param int|null $post_id Page ID.
 * @return int
 */
function vzo__setup_builder_form_id( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	$form_id = (int) get_field( 'field_setup_form', $post_id );

	if ( $form_id && 'publish' === get_post_status( $form_id ) ) {
		return $form_id;
	}

	$lang = function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $post_id ) : '';

	return vzo__setup_builder_find_form( VZO_SETUP_FORM_TITLES[ $lang ] ?? VZO_SETUP_FORM_TITLES['en'] );
}

/**
 * WPForms form ID by title, or 0.
 *
 * @param string $title Form title.
 * @return int
 */
function vzo__setup_builder_find_form( $title ) {
	$ids = get_posts(
		[
			'post_type'      => 'wpforms',
			'post_status'    => 'publish',
			'title'          => $title,
			'posts_per_page' => 1,
			'fields'         => 'ids',
		]
	);

	return $ids ? (int) $ids[0] : 0;
}

/**
 * Case studies the result can show, in the current language. Rows whose case study is
 * missing or unpublished are skipped.
 *
 * @param int|null $post_id Page ID.
 * @return array[]
 */
function vzo__setup_builder_cases( $post_id = null ) {
	$rows = vzo__setup_builder_field( 'cases', $post_id );

	if ( ! is_array( $rows ) || ! $rows ) {
		$rows = array_map(
			function ( $row ) {
				$post              = get_page_by_path( $row['slug'], OBJECT, 'case-study' );
				$row['case_study'] = $post ? $post->ID : 0;

				return $row;
			},
			vzo__setup_builder_defaults()['cases']
		);
	}

	$cases = [];

	foreach ( $rows as $row ) {
		$id = (int) ( $row['case_study'] ?? 0 );

		// Rows may point to the English post: open the visitor's language.
		if ( $id && function_exists( 'pll_get_post' ) ) {
			$id = pll_get_post( $id ) ?: $id;
		}

		if ( ! $id || 'publish' !== get_post_status( $id ) ) {
			continue;
		}

		// Analytics key: the default-language slug, identical across languages.
		$source = function_exists( 'pll_get_post' ) ? ( pll_get_post( $id, pll_default_language() ) ?: $id ) : $id;

		$cases[] = [
			'key'       => get_post_field( 'post_name', $source ),
			'title'     => get_the_title( $id ),
			'url'       => get_permalink( $id ),
			'image'     => (string) get_the_post_thumbnail_url( $id, 'case-study' ),
			'industry'  => array_values( (array) ( $row['industry'] ?? [] ) ),
			'equipment' => array_values( (array) ( $row['equipment'] ?? [] ) ),
			'challenge' => array_values( (array) ( $row['challenge'] ?? [] ) ),
			'tag'       => (string) ( $row['tag'] ?? '' ),
			'machine'   => (string) ( $row['machine'] ?? '' ) ?: get_the_title( $id ),
			'detected'  => (string) ( $row['detected'] ?? '' ),
			'outcome'   => (string) ( $row['outcome'] ?? '' ),
		];
	}

	return $cases;
}

/**
 * Everything the builder needs for a page.
 *
 * @param int|null $post_id Page ID.
 * @return array
 */
function vzo__setup_builder_config( $post_id = null ) {
	$post_id  = $post_id ?: get_the_ID();
	$defaults = vzo__setup_builder_defaults();

	$texts = [];
	foreach ( $defaults['texts'] as $name => $default ) {
		$value          = vzo__setup_builder_field( $name, $post_id );
		$texts[ $name ] = is_string( $value ) && '' !== trim( $value ) ? $value : $default;
	}

	$questions = [];
	foreach ( VZO_SETUP_QUESTIONS as $key ) {
		// Raw value: '' / null = never saved (use the default), '0' = explicitly single choice.
		$multiple = get_field( 'field_setup_' . $key . '_multiple', $post_id, false );
		if ( ( null === $multiple || '' === $multiple ) && function_exists( 'pll_get_post' ) ) {
			$source   = pll_get_post( $post_id, pll_default_language() );
			$multiple = $source ? get_field( 'field_setup_' . $key . '_multiple', $source, false ) : null;
		}

		$questions[] = [
			'key'      => $key,
			'title'    => $texts[ $key . '_title' ],
			'subtitle' => $texts[ $key . '_subtitle' ],
			'summary'  => $texts[ $key . '_summary' ],
			'multiple' => null === $multiple || '' === $multiple ? $defaults['multiple'][ $key ] : (bool) $multiple,
			'options'  => vzo__setup_builder_options( $key, $post_id ),
		];
	}

	// Slider stops: ascending positive numbers, at least two.
	$stops = array_map( 'intval', preg_split( '/[^0-9]+/', (string) vzo__setup_builder_field( 'stops', $post_id ), -1, PREG_SPLIT_NO_EMPTY ) );
	$stops = array_values( array_unique( array_filter( $stops ) ) );
	sort( $stops );
	if ( count( $stops ) < 2 ) {
		$stops = array_map( 'intval', explode( ',', $defaults['stops'] ) );
	}

	$default = (int) vzo__setup_builder_field( 'default_machines', $post_id ) ?: $defaults['default'];
	$sensors = (int) vzo__setup_builder_field( 'sensors_per_gateway', $post_id ) ?: $defaults['sensors'];

	return [
		'lang'      => function_exists( 'pll_get_post_language' ) ? (string) pll_get_post_language( $post_id ) : '',
		'texts'     => $texts,
		'questions' => $questions,
		'stops'     => $stops,
		'default'   => max( $stops[0], min( end( $stops ), $default ) ),
		'sensors'   => $sensors,
		'cases'     => vzo__setup_builder_cases( $post_id ),
		'form_id'   => vzo__setup_builder_form_id( $post_id ),
	];
}

/**
 * Replace {placeholders} in a text.
 *
 * @param string $text Text.
 * @param array  $vars Placeholder => value.
 * @return string
 */
function vzo__setup_builder_format( $text, $vars ) {
	return strtr(
		$text,
		array_combine(
			array_map(
				function ( $key ) {
					return '{' . $key . '}';
				},
				array_keys( $vars )
			),
			array_values( $vars )
		)
	);
}

/**
 * Admin: fill select / checkbox choices that come from code or from the page itself.
 *
 * - Option "Icon": the icon library.
 * - Case "Industry / Equipment / Challenge": the answer options of the page being edited.
 * - "Lead form": all WPForms forms.
 *
 * Uses prepare_field (render time only), so dynamic choices never end up in the JSON.
 */
add_filter(
	'acf/prepare_field/name=icon',
	function ( $field ) {
		if ( 0 === strpos( $field['key'], 'field_setup_' ) ) {
			$field['choices'] = wp_list_pluck( vzo__setup_builder_icons(), 0 );
		}

		return $field;
	}
);

foreach ( VZO_SETUP_QUESTIONS as $vzo_question ) {
	add_filter(
		'acf/prepare_field/key=field_setup_case_' . $vzo_question,
		function ( $field ) use ( $vzo_question ) {
			$post_id = (int) ( $_GET['post'] ?? get_the_ID() ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$choices = [];

			foreach ( vzo__setup_builder_options( $vzo_question, $post_id ) as $option ) {
				$choices[ $option['key'] ] = $option['label'];
			}

			// Keep saved keys that no longer exist visible, so they aren't silently dropped.
			foreach ( (array) $field['value'] as $key ) {
				if ( $key && ! isset( $choices[ $key ] ) ) {
					$choices[ $key ] = $key . ' (missing option)';
				}
			}

			$field['choices'] = $choices;

			return $field;
		}
	);
}

add_filter(
	'acf/prepare_field/key=field_setup_form',
	function ( $field ) {
		$choices = [];

		foreach ( get_posts( [ 'post_type' => 'wpforms', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC' ] ) as $form ) {
			$choices[ $form->ID ] = $form->post_title;
		}

		$field['choices'] = $choices;

		return $field;
	}
);
