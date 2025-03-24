<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Viezo
 */

get_header(); the_post();
$blocks = get_field('blocks');
?>

	<main id="main" class="site-main default-page">

		<?php get_template_part( 'partials/page-header' ); ?>

			<article <?php post_class( 'post-container' ); ?>>



				<div class="desktop:flex desktop:gap-32 container px-24 pt-24 desktop:pt-32 mb-16">
					<div class="entry-content text-heading-xs text-darkest-grey desktop:w-7/12 pb-40 desktop:pb-140 bg-white page-content">
						<?php
							the_content(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. */
										esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'viezo' ),
										[
											'span' => [
												'class' => [],
											],
										]
									),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								)
							);

							?>
					</div><!-- .entry-content -->
				</div>


			</article><!-- #post-## -->



			<div class="page-content bg-light-grey">
				<?php if(!empty($blocks)):
					foreach($blocks as $block): ?>
						<?php echo get_template_part( 'partials/blocks/'.$block['acf_fc_layout'], null, ['block' => $block] ); ?>
					<?php endforeach;
				endif; ?>
			</div>




	</main><!-- #main -->

<?php get_footer(); ?>
