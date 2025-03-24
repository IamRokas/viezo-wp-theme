<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Viezo
 */

get_header(); ?>

<main id="main" class="site-main text-white pb-56">

    <section class="pt-56 pb-32">
        <div class="big-container mx-auto">
            <h1 class="text-4xl font-osp-din uppercase mb-32">News</h1>

            <?php
            // Get all categories
            $categories = get_categories(array(
                'hide_empty' => true,
                'exclude' => array(get_cat_ID('Uncategorized')), // Exclude Uncategorized
            ));

            if (!empty($categories)) :
                $current_cat = get_query_var('cat');
            ?>
                <div class="case-study-filters flex gap-8 mb-32 md:mb-48">
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                        class="p-8 text-sm border <?php echo (is_home() && !is_category()) ? 'border-white bg-white bg-opacity-10' : 'border-transparent hover:bg-white hover:bg-opacity-10'; ?>">
                        All news
                    </a>

                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                            class="p-8 text-sm  border <?php echo ($current_cat == $category->term_id) ? 'border-white bg-white bg-opacity-10' : 'border-transparent hover:bg-white hover:bg-opacity-10'; ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>


    <?php
    if (have_posts()) :
        /* Start the Loop */
    ?>
        <div class="big-container mx-auto">
            <div class="case-studies-grid desktop:grid grid-cols-3 gap-32">

                <?php
                while (have_posts()) :
                    the_post();

                ?>
                    <?php get_template_part('partials/article-list-entry'); ?>
                <?php

                endwhile;
                ?>
                <div class="pagination flex justify-center items-center mt-40">
                    <?php
                    vzo__display_numeric_pagination([
                        'before_page_number' => '<div class="w-40 h-40 text-center rounded-full px-12 py-8 mx-4 hover:bg-light-grey hover:text-darkest-grey">',
                        'after_page_number' => '</div>',
                        'next_text' => '<div class="w-40 h-40 text-center px-12 py-8 mx-4 hover:bg-light-grey hover:text-darkest-grey"><i class="vicon-ChevronRight"></i></div>',
                        'prev_text' => '<div class="w-40 h-40 text-center px-12 py-8 mx-4 hover:bg-light-grey hover:text-darkest-grey"><i class="vicon-ChevronLeft"></i></div>',
                    ]);
                    ?>
                </div>
            </div>

        <?php else :
        get_template_part('template-parts/content', 'none');
    endif;
        ?>

</main><!-- #main -->

<?php get_footer(); ?>