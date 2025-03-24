<?php

/**
 * The template for displaying case study archives.
 *
 * @package Viezo
 */

get_header(); ?>

<main id="main" class="site-main text-white pb-56">

	<section class="pt-56 pb-32">
		<div class="big-container mx-auto">
			<h1 class="text-4xl font-osp-din uppercase mb-32">CASE STUDIES</h1>

			<?php
			// Get all case study type terms
			$study_types = get_terms([
				'taxonomy' => 'case-study-type',
				'hide_empty' => true,
			]);

			if (!empty($study_types) && !is_wp_error($study_types)) :
				$current_term = get_queried_object();
				$is_archive_page = is_post_type_archive('case-study');
			?>
				<div class="case-study-filters flex gap-8 mb-32 md:mb-48">
					<a href="<?php echo esc_url(get_post_type_archive_link('case-study')); ?>"
						class="p-8 text-sm border <?php echo $is_archive_page ? 'border-white bg-white bg-opacity-10' : 'border-transparent hover:bg-white hover:bg-opacity-10'; ?>">
						All case studies
					</a>

					<?php foreach ($study_types as $type) :
						$is_active = ($current_term && isset($current_term->term_id) && $current_term->term_id == $type->term_id);
					?>
						<a href="<?php echo esc_url(get_term_link($type)); ?>"
							class="p-8 text-sm border <?php echo $is_active ? 'border-white bg-white bg-opacity-10' : 'border-transparent hover:bg-white hover:bg-opacity-10'; ?>">
							<?php echo esc_html($type->name); ?> case studies
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
	// Display case studies grouped by taxonomy
	if (!empty($study_types) && !is_wp_error($study_types)) :
		foreach ($study_types as $type) :
			// Query posts for this taxonomy
			$args = array(
				'post_type' => 'case-study',
				'posts_per_page' => -1, // Get all posts for this taxonomy
				'tax_query' => array(
					array(
						'taxonomy' => 'case-study-type',
						'field' => 'term_id',
						'terms' => $type->term_id,
					),
				),
			);
			$type_query = new WP_Query($args);

			// Only display section if there are posts
			if ($type_query->have_posts()) :
	?>
				<div class="taxonomy-section pb-56">
					<div class="big-container mx-auto">
						<h2 class="text-2xl font-osp-din uppercase mb-32"><?php echo esc_html($type->name); ?></h2>

						<div class="case-studies-grid desktop:grid grid-cols-3 gap-32">
							<?php
							while ($type_query->have_posts()) :
								$type_query->the_post();
								get_template_part('partials/case-study-card');
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			<?php
			endif;
		endforeach;
	else :
		// If no taxonomies are found, display all case studies
		if (have_posts()) :
			?>
			<div class="big-container mx-auto">
				<div class="case-studies-grid desktop:grid grid-cols-3 gap-32">
					<?php
					while (have_posts()) :
						the_post();
						get_template_part('partials/case-study-card');
					endwhile;
					?>
				</div>

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
	<?php
		else :
			get_template_part('template-parts/content', 'none');
		endif;
	endif;
	?>

</main><!-- #main -->

<?php get_footer(); ?>