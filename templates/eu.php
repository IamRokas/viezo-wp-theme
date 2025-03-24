<?php

/**
 * Template name: EU
 */


get_header();
the_post();
$blocks = get_field('blocks');
?>

<main id="main" class="site-main eu-page">

	<?php get_template_part('partials/page-header'); ?>

	<?php
	if (function_exists('yoast_breadcrumb')) {
		//yoast_breadcrumb( '<div class="big-container container pl-30 breadcrumbs pt-24">','</div>' );
	}
	?>

	<?php foreach ($blocks as $block): ?>
		<?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block]); ?>
	<?php endforeach; ?>

	<div class="eu-posts pt-58 bg-light-grey">
		<div class="container">
			<h2>Latest Articles</h2>
			<div class="posts-list desktop:grid grid-cols-3 gap-20 pt-56 pb-92">
				<?php
				$args = array('posts_per_page' => '300', 'cat' => 7);
				$recent_posts = new WP_Query($args);
				while ($recent_posts->have_posts()) :
					$recent_posts->the_post() ?>

					<?php get_template_part('partials/article-list-entry'); ?>

				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		</div>
	</div>

</main><!-- #main -->

<?php get_footer(); ?>