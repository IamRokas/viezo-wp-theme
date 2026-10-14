<?php
/**
 * Live Sonora network section (Home template): machine scene data + admin dot editor.
 *
 * The scene image, point positions and point values are language-independent: they always
 * come from the default-language (English) home page, so replacing the photo or moving a
 * dot never breaks a translation. Translations only provide texts (machine name, last
 * measurement, detected issue, link label), matched to the English points by row order.
 *
 * Markup: partials/live-sonora.php. Front-end JS: src/js/blocks/live-sonora.js.
 * Admin dot editor: src/admin/live-sonora-editor.js.
 *
 * @package Viezo
 */

/**
 * The default-language (English) version of a post, or the post itself.
 *
 * @param int $post_id Post ID.
 * @return int
 */
function vzo__live_sonora_source_id( $post_id ) {
	if ( function_exists( 'pll_get_post' ) && function_exists( 'pll_default_language' ) ) {
		return (int) ( pll_get_post( $post_id, pll_default_language() ) ?: $post_id );
	}

	return (int) $post_id;
}

/**
 * Scene image ID (from the English page).
 *
 * @param int $post_id Current page ID.
 * @return int Attachment ID, or 0.
 */
function vzo__live_sonora_scene_image( $post_id ) {
	$image = get_field( 'field_live_sonora_scene_image', vzo__live_sonora_source_id( $post_id ) );

	if ( ! $image ) {
		$image = get_field( 'field_live_sonora_scene_image', $post_id );
	}

	return (int) $image;
}

/**
 * Bundled default scene photo, used when no image is chosen (e.g. the seed couldn't import it).
 * The default point positions match this photo.
 *
 * @return array{url: string, width: int, height: int}
 */
function vzo__live_sonora_default_image() {
	return [
		'url'    => get_template_directory_uri() . '/seeds/assets/home/machine-line.webp',
		'width'  => 1672,
		'height' => 941,
	];
}

/**
 * Measuring points ready for the template.
 *
 * Positions, values, fault flag and case study come from the English page; texts from the
 * current language (same row order), falling back to English.
 *
 * Each point also gets a card placement:
 * - `side`:  'right' (card starts at the dot) or 'left' (card ends at the dot, near the right edge);
 * - `below`: true when the dot is near the top, so the card hangs under it instead of above.
 *
 * @param int $post_id Current page ID.
 * @return array[]
 */
function vzo__live_sonora_points( $post_id ) {
	$source_id = vzo__live_sonora_source_id( $post_id );
	$source    = get_field( 'field_live_sonora_points', $source_id ) ?: [];
	$local     = $source_id !== (int) $post_id ? ( get_field( 'field_live_sonora_points', $post_id ) ?: [] ) : [];
	$texts     = [ 'name', 'last_measurement', 'fault_issue', 'fault_link_label' ];
	$points    = [];

	foreach ( array_values( $source ) as $i => $row ) {
		if ( '' === (string) ( $row['x'] ?? '' ) || '' === (string) ( $row['y'] ?? '' ) ) {
			continue;
		}

		foreach ( $texts as $key ) {
			if ( ! empty( $local[ $i ][ $key ] ) ) {
				$row[ $key ] = $local[ $i ][ $key ];
			}
		}

		$x     = max( 0, min( 100, (float) $row['x'] ) );
		$y     = max( 0, min( 100, (float) $row['y'] ) );
		$fault = ! empty( $row['fault'] );
		$rms   = (float) ( $row['rms'] ?? 0 );
		$temp  = (float) ( $row['temperature'] ?? 0 );

		$points[] = [
			'name'             => (string) ( $row['name'] ?? '' ),
			'x'                => $x,
			'y'                => $y,
			'side'             => $x > 72 ? 'left' : 'right',
			'below'            => $y < 38,
			'rms'              => $rms,
			'temperature'      => $temp,
			'harmonics'        => ! empty( $row['harmonics'] ),
			'last_measurement' => (string) ( $row['last_measurement'] ?? '' ),
			'fault'            => $fault,
			'fault_rms'        => $fault && '' !== (string) ( $row['fault_rms'] ?? '' ) ? (float) $row['fault_rms'] : $rms,
			'fault_temperature'=> $fault && '' !== (string) ( $row['fault_temperature'] ?? '' ) ? (float) $row['fault_temperature'] : $temp,
			'fault_issue'      => (string) ( $row['fault_issue'] ?? '' ),
			'fault_link_label' => (string) ( $row['fault_link_label'] ?? '' ),
			'fault_case_study' => (int) ( $row['fault_case_study'] ?? 0 ),
		];
	}

	return $points;
}

/**
 * Admin: visual dot editor on pages using the Home template.
 */
function vzo__live_sonora_admin_scripts() {
	$screen  = get_current_screen();
	$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( ! $screen || 'page' !== $screen->post_type || ! $post_id || 'templates/home.php' !== get_page_template_slug( $post_id ) ) {
		return;
	}

	$source_id = vzo__live_sonora_source_id( $post_id );
	$file      = '/src/admin/live-sonora-editor.js';

	wp_enqueue_script( 'vzo-live-sonora-editor', get_template_directory_uri() . $file, [ 'acf-input' ], (string) filemtime( get_template_directory() . $file ), true );
	wp_localize_script(
		'vzo-live-sonora-editor',
		'vzoLiveSonoraEditor',
		[
			'isTranslation' => $source_id !== $post_id,
			'sourceEditUrl' => $source_id !== $post_id ? get_edit_post_link( $source_id, 'raw' ) : '',
			'sourceImage'   => $source_id !== $post_id ? (string) ( wp_get_attachment_image_url( vzo__live_sonora_scene_image( $post_id ), 'large' ) ?: vzo__live_sonora_default_image()['url'] ) : '',
			'defaultImage'  => vzo__live_sonora_default_image()['url'],
			'sourcePoints'  => $source_id !== $post_id ? array_map(
				function ( $point ) {
					return [ 'x' => $point['x'], 'y' => $point['y'], 'fault' => $point['fault'] ];
				},
				vzo__live_sonora_points( $source_id )
			) : [],
			'i18n'          => [
				'title'       => __( 'Point positions', 'viezo' ),
				'help'        => __( 'Drag the dots onto the machines. Positions are saved as % of the photo, so they stay put when the photo is resized.', 'viezo' ),
				'noImage'     => __( 'No image chosen: showing the default photo (also used on the page).', 'viezo' ),
				'translation' => __( 'The photo, dot positions and values are shared: they come from the English page. Here you only translate the texts.', 'viezo' ),
				'editSource'  => __( 'Edit positions on the English page', 'viezo' ),
			],
		]
	);
}
add_action( 'acf/input/admin_enqueue_scripts', 'vzo__live_sonora_admin_scripts' );
