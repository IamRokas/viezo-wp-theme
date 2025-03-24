<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Viezo
 */

get_header(); ?>

	<main id="main" class="site-main">

		<?php get_template_part( 'partials/page-header', null, ['pageId' => get_option('page_for_posts'), 'headerSize' => 'tiny'] ); ?>

		<?php
			if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<div class="big-container container breadcrumbs bg-white">','</div>' );
			}
		?>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			//the_post_navigation();


		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php get_footer(); ?>
