<?php

/**
 * Template name: Pricing
 */

get_header();
the_post();
$blocks = get_field('blocks');
?>

<main id="main" class="site-main default-page">

    <?php get_template_part('partials/page-header'); ?>

    <article <?php post_class('post-container'); ?>>



        <?php
		ob_start();
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
		$page_main_content = ob_get_clean();

		if ('' !== trim(wp_strip_all_tags($page_main_content))) :
		?>
        <div class="desktop:flex desktop:gap-32 container px-24 pt-24 desktop:pt-32 mb-16">
            <div
                class="entry-content text-heading-xs text-darkest-grey desktop:w-7/12 pb-40 desktop:pb-140 bg-white page-content">
                <?php echo $page_main_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- KSES/filtered via the_content. 
					?>
            </div><!-- .entry-content -->
        </div>
        <?php endif; ?>


    </article><!-- #post-## -->



    <div class="page-content bg-light-grey">
        <?php if (!empty($blocks)):
			foreach ($blocks as $block): ?>
        <?php get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block]); ?>
        <?php endforeach;
		endif; ?>
    </div>




</main><!-- #main -->

<?php get_footer(); ?>