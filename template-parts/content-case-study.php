<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Viezo
 */

?>

	<article <?php post_class( 'post-container' ); ?>>

		<header class="entry-header pb-24 mb-32 desktop:pb-56 desktop:mb-58 shadow-mano-card">
			<div class="container md:flex md:gap-20 items-center">

				<div class="rightside md:order-2 md:w-1/2">
					<?php the_post_thumbnail('large'); ?>
				</div>

				<div class="leftside md:w-1/2">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title mb-16 text-2xl desktop:text-3xl">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title mb-16 text-2xl desktop:text-3xl"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta text-subtitle1">
						<?php vzo__post_date(); ?>

						<div class="share flex gap-8 text-center md:pt-20">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?=get_permalink();?>" target="_blank" class="block w-40 h-40 leading-10"><i class="vicon-Facebook align-middle leading-none"></i></a>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=get_permalink();?>" target="_blank" class="block w-40 h-40 leading-10"><i class="vicon-LinkedIn align-middle leading-none"></i></a>
						</div>
					</div><!-- .entry-meta -->
				<?php endif; ?>


				</div>

			</div>
		</header><!-- .entry-header -->

		<div class="desktop:flex desktop:gap-32 container">
			<div class="entry-content text-heading-xs text-darkest-grey desktop:w-7/12 pb-40 desktop:pb-140 page-content">
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


			<div class="sidebar hidden desktop:block desktop:pr-32 desktop:pl-56 desktop:w-4/12 desktopLarge:pl-92 py-58 pb-16 bg-light-grey">
				<div class="relative">
					<h4 class="mb-48">Related Articles</h4>

					<div class="related-list text-darkest-grey">
						<?php
						$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 5, 'post__not_in' => array($post->ID) ) );
						if( $related ) foreach( $related as $post ) {
						setup_postdata($post); ?>
						<ul>
								<li class="mb-48">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="block mb-16">
										<h5 class="font-medium text-lg"><?php the_title(); ?></h5>
									</a>
									<div class="entry-meta font-body-2 font-light">
										<?php vzo__post_date(); ?>
									</div>
								</li>
							</ul>
						<?php }
						wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>


	</article><!-- #post-## -->
