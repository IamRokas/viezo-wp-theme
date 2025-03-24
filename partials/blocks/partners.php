<?php

/**
 * Partners Block Template
 * Displays partner logos in a horizontal scrolling list
 */

// Get the partners data
$partners = $args['block']['partners'] ?? []; // Post IDs relationship field
$block_title = $args['block'][''] ?? 'THEY TRUST US';
$block_id = 'partners-block-' . uniqid();

if ($partners && is_array($partners)) :
?>
    <div class="partners-block py-56 text-center">
        <div class="">
            <h2 class="font-osp-din uppercase mb-56 text-darkest-grey">
                <?= esc_html($block_title); ?></h2>

            <div id="<?= esc_attr($block_id); ?>" class="partners-wrapper overflow-x-hidden pb-8">
                <div class="partners-scroll-container flex items-center">
                    <?php
                    // Display partners twice to create seamless infinite scroll
                    for ($i = 0; $i < 2; $i++) :
                        foreach ($partners as $partner_id) :
                            $partner = get_post($partner_id);
                            if ($partner) :
                                $logo = get_post_thumbnail_id($partner_id);
                                $partner_title = get_the_title($partner_id);
                    ?>
                                <div class="partner-item flex-shrink-0 px-16 md:px-32">
                                    <?php if ($logo) : ?>
                                        <div class="partner-logo h-[97px] flex items-center justify-center">
                                            <?php echo wp_get_attachment_image($logo, 'full', false, [
                                                'class' => 'max-h-full w-auto',
                                                'alt' => esc_attr($partner_title)
                                            ]); ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="partner-title h-[97px] flex items-center justify-center text-xl font-medium">
                                            <?= esc_html($partner_title); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                    <?php
                            endif;
                        endforeach;
                    endfor;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const partnersContainer = document.getElementById('<?= esc_js($block_id); ?>');
            if (!partnersContainer) return;

            const scrollContainer = partnersContainer.querySelector('.partners-scroll-container');
            let scrollAmount = 0;
            let scrollSpeed = 1;
            let animationId = null;
            let isPaused = false;

            // Function to animate the scroll
            function autoScroll() {
                if (!isPaused) {
                    scrollAmount += scrollSpeed;

                    // Reset scroll position for infinite loop effect
                    if (scrollAmount >= scrollContainer.scrollWidth / 2) {
                        scrollAmount = 0;
                    }

                    scrollContainer.style.transform = `translateX(-${scrollAmount}px)`;
                }
                animationId = requestAnimationFrame(autoScroll);
            }

            // Start auto-scrolling
            animationId = requestAnimationFrame(autoScroll);

            // Pause on mouse enter or touch
            // partnersContainer.addEventListener('mouseenter', function() {
            //     isPaused = true;
            // });

            // partnersContainer.addEventListener('touchstart', function() {
            //     isPaused = true;
            // }, {
            //     passive: true
            // });

            // Resume on mouse leave or touch end
            partnersContainer.addEventListener('mouseleave', function() {
                isPaused = false;
            });

            partnersContainer.addEventListener('touchend', function() {
                isPaused = false;
            });

            // Cleanup on page unload
            window.addEventListener('beforeunload', function() {
                if (animationId) {
                    cancelAnimationFrame(animationId);
                }
            });
        });
    </script>
<?php endif; ?>