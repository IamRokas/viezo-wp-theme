<?php

/**
 * Case Studies Block Template
 * Displays featured case studies in a grid or alternative design
 */

// Get the case studies data
$cases = $args['block']['cases']; // Post IDs
$block_title = $args['block']['title'] ?? 'CASE STUDIES';
$read_more_text = $args['block']['read_more_text'] ?? 'SEE ALL';
$read_more_link = $args['block']['read_more_link'] ?? array('url' => get_post_type_archive_link('case-study'));
$read_more_link_text = $args['block']['read_more_link']['title'] ?? '';
$see_more_link = $args['block']['see_more'] ?? ''; // link
$alternative_design = $args['block']['alternative_design'] ?? false;

if ($cases && is_array($cases)) :
?>
<?php if ($alternative_design) : // Alternative Design 
	?>
<div class="case-studies-block-alt bg-white text-darkest-grey overflow-hidden">
    <div class="desktop:flex desktop:flex-row desktop:items-stretch w-full">
        <!-- Left Column - Title and See More -->
        <div class="desktop:w-1/2 desktop:flex desktop:flex-col desktop:justify-center py-40 md:py-80">
            <div class="container desktop:max-w-none desktop:px-56 text-center desktop:text-left">
                <h2 class="font-osp-din uppercase mb-0"><?= esc_html($block_title); ?></h2>

                <?php if (!empty($see_more_link)) : ?>
                <div class="see-more-link md:block hidden mt-20 desktop:mt-32">
                    <a href="<?= esc_url($see_more_link['url'] ?? '#'); ?>" class="button outline-black">
                        <?= esc_html($see_more_link['title'] ?? 'See More'); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Column - Case Studies -->
        <div class="desktop:block flex desktop:w-1/2 border-l border-white">
            <?php
					// Limit to maximum 2 cases for the alternative design
					$display_cases = array_slice($cases, 0, 2);

					foreach ($display_cases as $index => $case_id) :
						$post = get_post($case_id);
						if ($post) :
							setup_postdata($post);
							// Add a border between cases
							$border_class = ($index > 0) ? 'border-t border-white' : '';
					?>
            <div class="case-study-item flex <?= $border_class; ?>">
                <?php get_template_part('partials/case-study-card'); ?>
            </div>
            <?php
						endif;
					endforeach;
					wp_reset_postdata();
					?>
        </div>
    </div>

    <?php if (!empty($read_more_link) && !empty($read_more_text)) : ?>
    <div class="text-center flex gap-12 items-center py-28 border-t border-white justify-center">
        <p class="text-white mb-0"><?= esc_html($read_more_text); ?></p>
        <a href="<?= esc_url($read_more_link['url'] ?? get_post_type_archive_link('case-study')); ?>"
            class="button outline-black">
            <?= esc_html($read_more_link_text); ?>
        </a>
    </div>
    <?php endif; ?>
</div>

<?php if (!empty($see_more_link)) : ?>
<div class="see-more-link w-fill text-center md:hidden block mt-20 desktop:mt-32">
    <a href="<?= esc_url($see_more_link['url'] ?? '#'); ?>" class="button outline-black">
        <?= esc_html($see_more_link['title'] ?? 'See More'); ?>
    </a>
</div>
<?php endif; ?>

<?php else : // Original Design 
	?>
<div class="case-studies-block bg-dark-grey text-white pt-40 md:pt-80">
    <div class="container">
        <h2 class="font-osp-din uppercase mb-48"><?= esc_html($block_title); ?></h2>

        <div
            class="case-studies-scroll-container overflow-x-auto -mx-24 px-24 pb-8 md:mx-0 md:px-0 md:overflow-visible">
            <div class="case-studies-grid flex md:grid md:grid-cols-3 gap-24">
                <?php
						foreach ($cases as $case_id) :
							$post = get_post($case_id);
							if ($post) :
								setup_postdata($post);

								// Include the case study card partial 
								get_template_part('partials/case-study-card');

							endif;
						endforeach;

						wp_reset_postdata();
						?>
            </div>
        </div>
    </div>
    <?php if (!empty($read_more_link) && !empty($read_more_text)) : ?>
    <div class="text-center mt-32 flex gap-12 items-center py-28 border-t border-white justify-center">
        <p class="text-white mb-0"><?= esc_html($read_more_text); ?></p>
        <a href="<?= esc_url($read_more_link['url'] ?? get_post_type_archive_link('case-study')); ?>"
            class="button outline-white">
            <?= esc_html($read_more_link_text); ?>
        </a>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php endif; ?>


<script>
// Add this to src/js/index.js or create a new module

document.addEventListener('DOMContentLoaded', function() {
    // Initialize horizontal scroll for case studies
    initCaseStudiesScroll();
});

function initCaseStudiesScroll() {
    const scrollContainers = document.querySelectorAll('.case-studies-scroll-container');

    scrollContainers.forEach(container => {
        if (!container) return;

        // Only apply these behaviors on mobile
        if (window.innerWidth < 768) {
            // Smooth scrolling with mouse wheel
            container.addEventListener('wheel', (e) => {
                if (e.deltaY !== 0) {
                    e.preventDefault();
                    container.scrollLeft += e.deltaY;
                }
            }, {
                passive: false
            });

            // Track touch movements for smooth scrolling
            let isDown = false;
            let startX;
            let scrollLeft;

            container.addEventListener('mousedown', (e) => {
                isDown = true;
                container.classList.add('grabbing');
                startX = e.pageX - container.offsetLeft;
                scrollLeft = container.scrollLeft;
            });

            container.addEventListener('mouseleave', () => {
                isDown = false;
                container.classList.remove('grabbing');
            });

            container.addEventListener('mouseup', () => {
                isDown = false;
                container.classList.remove('grabbing');
            });

            container.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - container.offsetLeft;
                const walk = (x - startX) * 2; // Adjust scroll speed
                container.scrollLeft = scrollLeft - walk;
            });

            // Ensure we show a partial card at the start
            // Slight delay to ensure DOM is fully loaded
            setTimeout(() => {
                // Don't set initial scroll position if user has already scrolled
                if (container.scrollLeft === 0) {
                    const cardWidth = container.querySelector('.case-study-card').offsetWidth;
                    // Adjust this value to control how much of the next card is visible
                    const visibleAmount = 0.25; // Shows 25% of the next card
                    container.scrollLeft = -cardWidth * visibleAmount;
                }
            }, 100);
        }
    });
}
</script>