<?php

/**
 * Template name: Home
 */

get_header();
the_post();
$blocks = get_field('blocks');

?>

<main id="main" class="site-main">

	<?php get_template_part('partials/page-header'); ?>

	<div class="page-content">
		<?php foreach ($blocks as $block): ?>
			<?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block]); ?>
		<?php endforeach; ?>
	</div>

	<div class="cblock posts-list hidden">
		<h2 class="text-center pt-56 pb-48 desktop:pt-92 desktop:pb-48">News</h2>
		<div class="container desktop:grid grid-cols-3 gap-20">
			<?php
			$args = array('posts_per_page' => '3');
			$recent_posts = new WP_Query($args);
			while ($recent_posts->have_posts()) :
				$recent_posts->the_post() ?>

				<?php get_template_part('partials/article-list-entry'); ?>

			<?php endwhile;
			wp_reset_postdata(); ?>
		</div>

		<div class="pt-24 pb-92 text-center">
			<a class="button uppercase blue-transparent" href="<?= get_permalink(get_option('page_for_posts')); ?>">See
				All Articles</a>
		</div>

	</div>

</main><!-- #main -->

<?php get_footer(); ?>