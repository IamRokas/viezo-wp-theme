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
                <div class="flex justify-between items-end mb-48">
                    <h2 class="font-osp-din uppercase "><?= esc_html($block_title); ?></h2>
                    <div class="embla-nav w-[100px] gap-10 justify-end hidden md:flex">
                        <div class="embla-nav-back cursor-pointer">
                            <svg class="w-[30px] h-auto" width="800px" height="800px" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    sketch:type="MSPage">
                                    <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-412.000000, -983.000000)"
                                        fill="#ffffff">
                                        <path
                                            d="M434,998 L423.414,998 L427.535,993.879 C427.926,993.488 427.926,992.855 427.535,992.465 C427.145,992.074 426.512,992.074 426.121,992.465 L420.465,998.121 C420.225,998.361 420.15,998.689 420.205,999 C420.15,999.311 420.225,999.639 420.465,999.879 L426.121,1005.54 C426.512,1005.93 427.145,1005.93 427.535,1005.54 C427.926,1005.15 427.926,1004.51 427.535,1004.12 L423.414,1000 L434,1000 C434.553,1000 435,999.553 435,999 C435,998.448 434.553,998 434,998 L434,998 Z M442,1011 C442,1012.1 441.104,1013 440,1013 L416,1013 C414.896,1013 414,1012.1 414,1011 L414,987 C414,985.896 414.896,985 416,985 L440,985 C441.104,985 442,985.896 442,987 L442,1011 L442,1011 Z M440,983 L416,983 C413.791,983 412,984.791 412,987 L412,1011 C412,1013.21 413.791,1015 416,1015 L440,1015 C442.209,1015 444,1013.21 444,1011 L444,987 C444,984.791 442.209,983 440,983 L440,983 Z"
                                            id="arrow-left-square" sketch:type="MSShapeGroup">

                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="embla-nav-next cursor-pointer">
                            <svg class="w-[30px] h-auto" width="800px" height="800px" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    sketch:type="MSPage">
                                    <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-464.000000, -983.000000)"
                                        fill="#ffffff">
                                        <path
                                            d="M494,1011 C494,1012.1 493.104,1013 492,1013 L468,1013 C466.896,1013 466,1012.1 466,1011 L466,987 C466,985.896 466.896,985 468,985 L492,985 C493.104,985 494,985.896 494,987 L494,1011 L494,1011 Z M492,983 L468,983 C465.791,983 464,984.791 464,987 L464,1011 C464,1013.21 465.791,1015 468,1015 L492,1015 C494.209,1015 496,1013.21 496,1011 L496,987 C496,984.791 494.209,983 492,983 L492,983 Z M487.535,998.121 L481.879,992.465 C481.488,992.074 480.855,992.074 480.465,992.465 C480.074,992.854 480.074,993.488 480.465,993.879 L484.586,998 L474,998 C473.447,998 473,998.447 473,999 C473,999.552 473.447,1000 474,1000 L484.586,1000 L480.465,1004.12 C480.074,1004.51 480.074,1005.14 480.465,1005.54 C480.855,1005.93 481.488,1005.93 481.879,1005.54 L487.535,999.879 C487.775,999.639 487.85,999.311 487.795,999 C487.85,998.689 487.775,998.361 487.535,998.121 L487.535,998.121 Z"
                                            id="arrow-right-square" sketch:type="MSShapeGroup">

                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>



                <div class="embla">
                    <div class="embla__viewport overflow-hidden">
                        <div class="case-studies-grid  embla__container">
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
            </div>
            <?php if (!empty($read_more_link) && !empty($read_more_text)) : ?>
                <div class="text-center mt-32 flex gap-12 items-center py-28 border-t border-white justify-center">
                    <p class="text-white mb-0 font-body-1"><?= esc_html($read_more_text); ?></p>
                    <a href="<?= esc_url($read_more_link['url'] ?? get_post_type_archive_link('case-study')); ?>"
                        class="button outline-white">
                        <?= esc_html($read_more_link_text); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>