<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Viezo
 */

get_header(); ?>

	<main id="main" class="site-main">

		<header class="page-header px-0 flex items-end justify-center header-small">
			<div class="bg image" style="background-image: url(<?=get_template_directory_uri().'/build/images/default-header.jpg';?>);"></div>
			<div class="bg-shadow"></div>
			<div class="textblock container text-white">
				<div class="inside">
					<h1><?php esc_html_e( "Sorry, this page doesn't exist.", 'viezo' ); ?></h1>
				</div>
			</div>
		</header>

		<section class="error-404 not-found py-32">



			<div class="page-content pb-68">


			<div class="meme timeline">
				<div class="track">
				</div>
				<div class="train"></div>

				<div class="code font-osp-din pr-32">404</div>
			</div>







			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php get_footer(); ?>
