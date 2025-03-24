<?php

/**
 * Template name: Powertrack
 */


get_header();
the_post();
$blocks = get_field('blocks');
$softwareBlock = null;
?>

<main id="main" class="site-main">

	<?php get_template_part('partials/page-header'); ?>



	<?php //get_template_part( 'template-parts/content', get_post_format() ); 
	?>

	<div class="page-content bg-white">

		<?php
		if (function_exists('yoast_breadcrumb')) {
			//yoast_breadcrumb( '<div class="big-container container breadcrumbs ">','</div>' );
		}
		?>

		<?php foreach ($blocks as $counter => $block):
			// if ($block['acf_fc_layout'] == 'image_grid') {
			// 	$machinesBlock = $block;
			// 	continue;
			// } 
		?>
			<?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block, 'counter' => $counter]);
			if ($counter === 1) {
				require_once get_template_directory() . '/templates/sonora_timeline.php';
			}
			?>
		<?php endforeach; ?>
	</div>


	<?php //echo get_template_part('partials/blocks/image_grid', null, ['block' => $machinesBlock]);
	?>




</main><!-- #main -->




<?php get_footer(); ?>