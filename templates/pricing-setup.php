<?php

/**
 * Template name: Pricing – Setup builder
 */

get_header();
the_post();
$blocks = get_field('blocks');
?>

<main id="main" class="site-main">

	<?php get_template_part('partials/page-header'); ?>

	<?php get_template_part('partials/setup-builder'); ?>

	<?php if (!empty($blocks)) : ?>
		<div class="page-content bg-light-grey">
			<?php foreach ($blocks as $block) : ?>
				<?php get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block]); ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

</main><!-- #main -->

<?php get_footer(); ?>
