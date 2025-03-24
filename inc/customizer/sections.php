<?php
/**
 * Customizer sections.
 *
 * @package Viezo
 */

/**
 * Register the section sections.
 *
 * @author WebDevStudios
 * @param object $wp_customize Instance of WP_Customize_Class.
 */
function vzo__customize_sections( $wp_customize ) {

	// Register additional scripts section.
	$wp_customize->add_section(
		'vzo__additional_scripts_section',
		[
			'title'    => esc_html__( 'Additional Scripts', 'viezo' ),
			'priority' => 10,
			'panel'    => 'site-options',
		]
	);

	// Register a social links section.
	$wp_customize->add_section(
		'vzo__social_links_section',
		[
			'title'       => esc_html__( 'Social Media', 'viezo' ),
			'description' => esc_html__( 'Links here power the display_social_network_links() template tag.', 'viezo' ),
			'priority'    => 90,
			'panel'       => 'site-options',
		]
	);

	// Register a header section.
	$wp_customize->add_section(
		'vzo__header_section',
		[
			'title'    => esc_html__( 'Header Customizations', 'viezo' ),
			'priority' => 90,
			'panel'    => 'site-options',
		]
	);

	// Register a footer section.
	$wp_customize->add_section(
		'vzo__footer_section',
		[
			'title'    => esc_html__( 'Footer Customizations', 'viezo' ),
			'priority' => 90,
			'panel'    => 'site-options',
		]
	);
}
add_action( 'customize_register', 'vzo__customize_sections' );
