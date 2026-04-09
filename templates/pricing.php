<?php

/**
 * Template name: Pricing
 */


get_header();
the_post();
$blocks = get_field('blocks');
?>

<main id="main" class="site-main contacts-page bg-dark-grey">

    <?php //get_template_part('partials/page-header'); 
	?>

    <?php
	if (function_exists('yoast_breadcrumb')) {
		//yoast_breadcrumb( '<div class="big-container container pl-30 breadcrumbs pt-24">','</div>' );
	}
	?>


    <div class="container justify-center">
        <div class="desktop:flex mb-48 mt-32 border-white border">
            <div class="col-1 mb-48 desktop:mb-0 desktop:w-1/2 overflow-hidden">
                <div
                    class="  text-white h-full desktop:border-r rounded-xl desktop:rounded-r-none px-25 desktop:px-44 pt-32 desktop:pt-48 pb-32 desktop:pb-40 page-content text-base">
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
                </div>
            </div>
            <div class="col-2 desktop:w-1/2">
                <div
                    class="text-white z-10 bg-dark-grey py-32 desktop:py-48 px-24 desktop:px-44 rounded-xl desktop:rounded-l-none">
                    <h2>Get a Price Quote</h2>
                    <div class="flex w-full">
                        <?php echo do_shortcode('[wpforms id="3525"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="position:relative; overflow:hidden;">
        <div
            style="pointer-events:none;z-index:1000; position:absolute;top:0;left:0;right:0;background: linear-gradient(0deg, rgba(34, 34, 34, 0.00) 9.73%, rgba(34, 34, 34, 0.16) 38.17%, rgba(34, 34, 34, 0.38) 47.65%, rgba(34, 34, 34, 0.52) 55.32%, rgba(34, 34, 34, 0.71) 62.09%, #222 78.34%); height:150px;">
        </div>
        <div id="map" class="" style="height:450px"></div>
    </div>

    <?php if (!empty($blocks)): foreach ($blocks as $block): ?>
    <?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block]); ?>
    <?php endforeach;
	endif;  ?>


</main><!-- #main -->



<?php get_footer(); ?>

<!-- AIzaSyAxXxfomE-TlYsg1HbOOGHzh1eKLXZ19TI -->
