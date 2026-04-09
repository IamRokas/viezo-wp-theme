<?php

/**
 * The template for displaying category archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Viezo
 */

get_header(); ?>

<main id="main" class="site-main text-white pb-56">

    <section class="pt-56 pb-32">
        <div class="container mx-auto">
            <h1 class="text-4xl font-osp-din uppercase mb-32">
                <?php single_cat_title(); ?>
            </h1>

            <?php
            // Get all categories
            $categories = get_categories([
                'hide_empty' => true,
                'exclude' => [get_cat_ID('Uncategorized')],
            ]);

            if (!empty($categories)) :
                $current_cat = get_queried_object_id();
            ?>
                <div class="case-study-filters flex gap-8 mb-32 md:mb-48">
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
                        class="p-8 text-sm border <?php echo (is_home() || is_archive() && !is_category()) ? 'border-white bg-white bg-opacity-10' : 'border-transparent hover:bg-white hover:bg-opacity-10'; ?>">
                        All news
                    </a>

                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                            class="p-8 text-sm border <?php echo ($current_cat == $category->term_id) ? 'border-white bg-white bg-opacity-10' : 'border-transparent hover:bg-white hover:bg-opacity-10'; ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if (have_posts()) : ?>
        <div class="container mx-auto">
            <div class="case-studies-grid md:grid grid-cols-2 desktop:grid-cols-3 gap-32">

                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('partials/article-list-entry');
                endwhile;
                ?>

            </div>

            <div class="pagination flex justify-center items-center mt-40">
                <?php
                vzo__display_numeric_pagination([
                    'before_page_number' => '<div class="w-40 h-40 text-center rounded-full px-12 py-8 mx-4 hover:bg-light-grey hover:text-darkest-grey">',
                    'after_page_number' => '</div>',
                    'next_text' => '<div class="text-center  mx-4 text-white">Next →</div>',
                    'prev_text' => '<div class="text-center  mx-4 text-white">← Previous</div>',
                ]);
                ?>
            </div>
        </div>

    <?php else :
        get_template_part('template-parts/content', 'none');
    endif; ?>

</main>

<?php get_footer(); ?>