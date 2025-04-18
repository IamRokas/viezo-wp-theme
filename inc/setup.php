<?php

/**
 * Theme setup.
 *
 * @package Viezo
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @author WebDevStudios
 */
function vzo__setup()
{
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Viezo, use a find and replace
	 * to change 'viezo' to the name of your theme in all the template files.
	 * You will also need to update the Gulpfile with the new text domain
	 * and matching destination POT file.
	 */
	load_theme_textdomain('viezo', get_template_directory() . '/build/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');
	add_image_size('full-width', 1920, 1080, false);
	add_image_size('case-study', 460, 380, array('center', 'center'));
	add_image_size('full-width', 1920, 1080, false);

	// Register navigation menus.
	register_nav_menus(
		[
			'primary' => esc_html__('Primary Menu', 'viezo'),
			'footer'  => esc_html__('Footer Menu', 'viezo'),
			'footer-second'  => esc_html__('Footer Menu Second', 'viezo'),
			'mobile'  => esc_html__('Mobile Menu', 'viezo'),
		]
	);

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		]
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'vzo__custom_background_args',
			[
				'default-color' => 'ffffff',
				'default-image' => '',
			]
		)
	);

	// Custom logo support.
	add_theme_support(
		'custom-logo',
		[
			'height'      => 250,
			'width'       => 500,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => ['site-title', 'site-description'],
		]
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	// Gutenberg support for full-width/wide alignment of supported blocks.
	add_theme_support('align-wide');

	// Gutenberg defaults for font sizes.
	add_theme_support(
		'editor-font-sizes',
		[
			[
				'name' => __('Small', 'viezo'),
				'size' => 12,
				'slug' => 'small',
			],
			[
				'name' => __('Normal', 'viezo'),
				'size' => 16,
				'slug' => 'normal',
			],
			[
				'name' => __('Large', 'viezo'),
				'size' => 36,
				'slug' => 'large',
			],
			[
				'name' => __('Huge', 'viezo'),
				'size' => 50,
				'slug' => 'huge',
			],
		]
	);

	// Gutenberg editor styles support.
	add_theme_support('editor-styles');
	add_editor_style('build/main.css');

	// Gutenberg responsive embed support.
	add_theme_support('responsive-embeds');
}

add_action('after_setup_theme', 'vzo__setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @author WebDevStudios
 */
function vzo__content_width()
{
	$GLOBALS['content_width'] = apply_filters('vzo__content_width', 640);
}

add_action('after_setup_theme', 'vzo__content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @author WebDevStudios
 */
function vzo__widgets_init()
{

	// Define sidebars.
	$sidebars = [
		'sidebar-1' => esc_html__('Sidebar 1', 'viezo'),
	];

	// Loop through each sidebar and register.
	foreach ($sidebars as $sidebar_id => $sidebar_name) {
		register_sidebar(
			[
				'name'          => $sidebar_name,
				'id'            => $sidebar_id,
				'description'   => /* translators: the sidebar name */ sprintf(esc_html__('Widget area for %s', 'viezo'), $sidebar_name),
				'before_widget' => '<aside class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);
	}
}

add_action('widgets_init', 'vzo__widgets_init');
