<?php

/**
 * Template name: Powerail
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
			//yoast_breadcrumb('<div class="big-container container breadcrumbs pt-20">', '</div>');
		}
		?>
        <?php foreach ($blocks as $counter => $block):
			// if ($block['acf_fc_layout'] == 'image_grid') {
			// 	$machinesBlock = $block;
			// 	continue;
			// } 
		?>
        <?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block, 'counter' => $counter]);
			if ($counter === 4 && function_exists('get_field') && !empty(get_field('Element'))) {
				require_once get_template_directory() . '/templates/powerail_timeline.php';
			}
			?>
        <?php endforeach; ?>
    </div>

    <?php //echo get_template_part('partials/blocks/images_grid', null, ['block' => $machinesBlock]);
	?>

    <div class="container hidden px-8 desktop:px-16" id="calculator">
        <?php $showCalc = get_field('show_calculator', 'option');
		if ($showCalc):
		?>
        <div
            class="calculator bg-light-grey text-darkest-grey border-primary-green border-2 rounded-4 rounded-2xl pt-40 desktop:pt-56 mb-48">


            <?php //echo do_shortcode('[contact-form-7 id="266" title="calculator" id="calculator-form"]'); 
				?>
            <!--<form method="GET" action="<?= get_permalink(); ?>" id="calculator-form">


			</form>-->

        </div>
        <?php endif; ?>
    </div>




</main><!-- #main -->
<?php get_footer(); ?>