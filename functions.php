<?php
/**
 * Viezo functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Viezo
 */

/**
 * Get all the include files for the theme.
 *
 * @author WebDevStudios
 */
function vzo__get_theme_include_files() {
	return [
		'inc/setup.php', // Theme set up. Should be included first.
		'inc/compat.php', // Backwards Compatibility.
		'inc/customizer/customizer.php', // Customizer additions.
		'inc/extras.php', // Custom functions that act independently of the theme templates.
		'inc/hooks.php', // Load custom filters and hooks.
		'inc/security.php', // WordPress hardening.
		'inc/scaffolding.php', // Scaffolding.
		'inc/scripts.php', // Load styles and scripts.
		'inc/template-tags.php', // Custom template tags for this theme.
		'inc/calculator.php'
	];
}

foreach ( vzo__get_theme_include_files() as $include ) {
	require trailingslashit( get_template_directory() ) . $include;
}
