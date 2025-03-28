<?php
/**
 * Customizer panels.
 *
 * @package Viezo
 */

/**
 * Add a custom panels to attach sections too.
 *
 * @author WebDevStudios
 *
 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Class.
 */
function vzo__customize_panels( $wp_customize ) {
	// Register a new panel.
	$wp_customize->add_panel(
		'site-options',
		[
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Site Options', 'viezo' ),
			'description'    => esc_html__( 'Other theme options.', 'viezo' ),
		]
	);
}

add_action( 'customize_register', 'vzo__customize_panels' );
