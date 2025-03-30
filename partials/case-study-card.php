<?php

/**
 * Partial template for displaying case study cards
 *
 * @package Viezo
 */

// Get the case study type
$study_type_terms = get_the_terms(get_the_ID(), 'case-study-type');
$study_type = '';
if (!empty($study_type_terms) && !is_wp_error($study_type_terms)) {
    $study_type = strtoupper($study_type_terms[0]->name);
}

// Get excerpt
$excerpt = get_the_excerpt();
if (empty($excerpt)) {
    $excerpt = wp_trim_words(get_the_content(), 20);
}
?>

<div class="case-study-card embla__slide mb-32">
    <a href="<?php the_permalink(); ?>" class="block">
        <div class="case-study-thumbnail aspect-square mb-24">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('case-study', ['class' => 'w-full h-full object-cover']); ?>
            <?php else : ?>
                <div class="bg-dark-grey h-64"></div>
            <?php endif; ?>
        </div>
        <div class="card-content">
            <?php if (!empty($study_type)) : ?>
                <div class="study-type text-sm uppercase font-osp-din mb-8 text-white"><?php echo esc_html($study_type); ?>
                </div>
            <?php endif; ?>

            <h3 class="text-xl font-osp-din uppercase mb-16 text-white"><?php the_title(); ?></h3>

            <div class="study-excerpt font-body-1 text-light-grey mb-16">
                <?php echo esc_html($excerpt); ?>
            </div>
        </div>
    </a>
</div>