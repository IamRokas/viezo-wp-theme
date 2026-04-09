<?php

/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Viezo
 */

?>

<article <?php post_class('post-container'); ?>>

	<header class="entry-header py-32 md:py-56 pb-92 md:pb-140 bg-dark-grey">
		<div class="container flex flex-col md:gap-20 items-center text-center max-w-[900px]">

			<div class="rightside">
				<?php
				if ('post' === get_post_type()) :
				?>
					<div class="entry-meta text-sm text-white !pb-0">
						<?php vzo__post_date(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>

			</div>

			<div class="leftside">
				<?php
				if (is_single()) :
					the_title('<h1 class="entry-title !mb-0 text-white text-2xl desktop:text-3xl">', '</h1>');
				else :
					the_title('<h2 class="entry-title !mb-0 text-white text-2xl desktop:text-3xl"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
				endif;
				?>
			</div>

		</div>
	</header><!-- .entry-header -->

	<div class="bg-white">
		<div class="container max-w-[900px]">

			<?php if (has_post_thumbnail()) : ?>
				<div class="featured-image block ">
					<?php the_post_thumbnail('large', ['class' => 'w-full h-auto -mb-24 relative -top-68']); ?>
				</div>
			<?php endif; ?>

			<div class="entry-content  mt-24 top-text-heading-xs text-darkest-grey pb-40 desktop:pb-140 page-content">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. */
							esc_html__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'viezo'),
							[
								'span' => [
									'class' => [],
								],
							]
						),
						the_title('<span class="screen-reader-text">"', '"</span>', false)
					)
				);

				?>
			</div><!-- .entry-content -->
		</div>
	</div>

	<?php
	$related = get_posts(array(
		'category__in'   => wp_get_post_categories(get_the_ID()),
		'numberposts'    => 3,
		'post__not_in'   => array(get_the_ID()),
	));
	?>

	<?php if ($related) : ?>
		<div class="related-articles py-48 bg-dark-grey">
			<div class="container">
				<div class="relative">
					<h2 class="mb-48 text-white">Related Articles</h4>

						<div class="case-studies-grid desktop:grid grid-cols-3 gap-32">
							<?php foreach ($related as $post) :
								setup_postdata($post); ?>

								<?php get_template_part('partials/article-list-entry'); ?>

							<?php endforeach;
							wp_reset_postdata(); ?>
						</div>
				</div>
			</div>
		</div>
	<?php endif; ?>


</article><!-- #post-## -->