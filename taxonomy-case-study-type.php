<?php

/**
 * The template for displaying case study archives.
 *
 * @package Viezo
 */

get_header();
$taxonomy = get_queried_object();
?>

<main id="main" class="site-main text-white pb-56">

	<section class="pt-56 pb-32">
		<div class="big-container mx-auto">
			<h1 class="text-4xl font-osp-din uppercase mb-32"><?php echo esc_html($taxonomy->name); ?> case studies</h1>

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
				<div class="case-study-filters flex gap-8 mb-40">
					<a href="<?php echo esc_url(get_post_type_archive_link('case-study')); ?>"
						class="p-8 text-sm border <?php echo $is_archive_page ? 'border-white bg-white bg-opacity-10' : 'border-transparent hover:bg-white hover:bg-opacity-10'; ?>">
						All case studies
					</a>

					<?php foreach ($study_types as $type) :
						$is_active = ($current_term && $current_term->term_id == $type->term_id);
					?>
						<a href="<?php echo esc_url(get_term_link($type)); ?>"
							class="p-8 text-sm  border <?php echo $is_active ? 'border-white bg-white bg-opacity-10' : 'border-transparent hover:bg-white hover:bg-opacity-10'; ?>">
							<?php echo esc_html($type->name); ?> case studies
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php if (have_posts()) : ?>
		<div class="big-container mx-auto">
			<div class="case-studies-grid desktop:grid grid-cols-3 gap-32">
				<?php
				while (have_posts()) :
					the_post();

					get_template_part('partials/case-study-card'); ?>
				<?php endwhile; ?>
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

	<?php else : ?>
		<div class="big-container">
			<?php get_template_part('template-parts/content', 'none'); ?>
		</div>
	<?php endif; ?>

</main><!-- #main -->

<?php get_footer(); ?>