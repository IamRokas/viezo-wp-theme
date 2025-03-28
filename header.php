<?php

/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Viezo
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">


	<link rel="apple-touch-icon" sizes="180x180"
		href="/wp-content/themes/viezo/build/images/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32"
		href="/wp-content/themes/viezo/build/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16"
		href="/wp-content/themes/viezo/build/images/favicons/favicon-16x16.png">

	<link rel="mask-icon" href="/wp-content/themes/viezo/build/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="/wp-content/themes/viezo/build/images/favicons/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="/wp-content/themes/viezo/build/images/favicons/browserconfig.xml">
	<meta name="theme-color" content="#333333">


	<!-- Google Analytics -->
	<script>
		(function(i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function() {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-130576283-1', 'auto');
		ga('send', 'pageview');
	</script>
	<!-- End Google Analytics -->


	<?php wp_head(); ?>


	<style>
		.cli-style-v2 .cli-bar-btn_container .cli-plugin-button {
			font-size: 14px;
			padding-left: 16px;
			padding-right: 16px;
			width: 140px;
			border-radius: 4px;
			box-shadow: 0 3px 1px -2px rgb(0 0 0 / 20%), 0 2px 2px rgb(0 0 0 / 14%), 0 1px 5px rgb(0 0 0 / 12%);
		}

		.cli-bar-btn_container {
			gap: 10px;
		}
	</style>

</head>

<body <?php body_class('site-wrapper text-base'); ?>>

	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'viezo'); ?></a>

	<header class="site-header backdrop-blur-md sticky top-0 z-50 px-30 py-8 tablet-landscape:py-16 text-sm"
		style="border-bottom: 1px solid white;">

		<div class=" big-container h-full flex items-center justify-center tablet-landscape:justify-between mx-auto">

			<div class="site-branding order-2 tablet-landscape:order-1 ">

				<?php the_custom_logo(); ?>

				<a href="<?= get_home_url(); ?>" class="logo"><img
						src="<?= get_template_directory_uri(); ?>/build/images/logo.svg" alt="Viezo" width="103"
						height="24"></a>


			</div><!-- .site-branding -->

			<?php if (has_nav_menu('primary') || has_nav_menu('mobile')) : ?>
				<button type="button" class="off-canvas-open" aria-expanded="false"
					aria-label="<?php esc_attr_e('Open Menu', 'viezo'); ?>"></button>
			<?php endif; ?>

			<div class="order-3 tablet-landscape:hidden mobile-right-menu flex absolute">
				<!-- <a href="<?= get_field('customer_portal_link', 'option'); ?>" class="block client-area mr-8 w-44 h-44 "><i class="w-full h-full inline-block"></i></a> -->
				<a href="<?= get_field('contact_us_link', 'option'); ?>" class="block contacts w-44 h-44 "><i
						class="w-full h-full inline-block"></i></a>
			</div>

			<nav id="site-navigation" class="main-navigation navigation-menu font-hiragino-sans order-3"
				aria-label="<?php esc_attr_e('Main Navigation', 'viezo'); ?>">
				<?php
				wp_nav_menu(
					[
						'fallback_cb'    => false,
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'menu dropdown  my-0 text-white grow flex items-center text-sm',
						'container'      => false,
					]
				);
				?>
			</nav><!-- #site-navigation-->

			<?php
			// Get the header CTA link from ACF options
			$header_cta = get_field('header_cta', 'option');

			// Only display if the link is defined
			if (!empty($header_cta) && !empty($header_cta['url'])) :
				$link_url = $header_cta['url'];
				$link_title = $header_cta['title'] ?? 'Contact Us';
				$link_target = $header_cta['target'] ? $header_cta['target'] : '_self';
			?>
				<div class="header-cta hidden tablet-landscape:block order-4">
					<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"
						class="button outline-white">
						<?php echo esc_html($link_title); ?>
					</a>
				</div>
			<?php endif; ?>

		</div><!-- .container -->



	</header><!-- .site-header-->