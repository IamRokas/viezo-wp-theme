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
function vzo__get_theme_include_files()
{
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

foreach (vzo__get_theme_include_files() as $include) {
	require trailingslashit(get_template_directory()) . $include;
}

function fix_case_study_menu_classes($classes, $item)
{
	// URL of your case studies archive
	$case_study_archive_url = site_url('/case-studies/');
	$news_url = site_url('/news');

	// Fix on single case studies
	if (is_singular('case-study')) {
		// Add current class to the archive menu item
		if ($item->url === $case_study_archive_url) {
			$classes[] = 'current-menu-item';
		}

		// Remove incorrect highlight from the blog page
		if ($item->url === $news_url) {
			$classes = array_diff($classes, ['current-menu-item', 'current_page_parent']);
		}
	}

	return $classes;
}
add_filter('nav_menu_css_class', 'fix_case_study_menu_classes', 10, 2);
