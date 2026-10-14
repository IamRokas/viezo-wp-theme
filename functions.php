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
		'inc/scripts.php', // Load styles and scripts.
		'inc/analytics.php', // Google Analytics 4 + Consent Mode.
		'inc/template-tags.php', // Custom template tags for this theme.
		'inc/calculator.php', // Calculator form.
		'inc/setup-builder.php', // Pricing setup builder funnel.
		'inc/setup-builder-email.php', // Setup builder: confirmation email to the lead.
		'inc/setup-builder-stats.php', // Setup builder: funnel events log + Tools → Setup builder stats.
		'inc/acf.php', // ACF Local JSON (acf-json/).
		'inc/live-sonora.php', // Home: Live Sonora machine scene + admin dot editor.
		'inc/seeds.php', // Content seeds (Tools → Viezo seeds).
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
