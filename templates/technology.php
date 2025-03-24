<?php

/**
 * Template name: Technology
 */


get_header();
the_post();
$blocks = get_field('blocks');
$softwareBlock = null;
?>

<main id="main" class="site-main page-technology">

	<?php get_template_part('partials/page-header'); ?>



	<div class="page-content bg-white">
		<?php
		if (function_exists('yoast_breadcrumb')) {
			// yoast_breadcrumb( '<div class="big-container container pl-30 breadcrumbs  pt-24">','</div>' );
		}
		?>

		<!-- <div class="cnt-block block-a pb-40 desktop:pb-16 desktop:overflow-hidden">
			<div class="container desktop:flex items-center">
				<div class="desktop:w-5/12 desktop:order-2 image-column relative text-center">
					<div class="image-wrap inline-block mx-auto desktop:pl-84 left-16 lg:left-auto relative">
						<?php echo wp_get_attachment_image(get_field('right_image')['ID'], 'full'); ?>
					</div>
				</div>

				<div class="desktop:w-7/12 desktop:order-1 text-column pt-6 text-body1">
					<?= get_field('left_side'); ?>
				</div>
			</div>
		</div> -->


		<?php foreach ($blocks as $key => $block):
			//if($block['acf_fc_layout'] == 'software'){ $softwareBlock = $block; continue; } 
		?>
			<?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block, 'counter' => $key]); ?>
		<?php endforeach; ?>
	</div>

</main><!-- #main -->




<?php get_footer(); ?>