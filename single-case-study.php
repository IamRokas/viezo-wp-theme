<?php

/**
 * Template for displaying single case studies
 *
 * @package Viezo
 */

get_header(); ?>

<main id="main" class="site-main">

	<!-- <?php
			if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<div class="big-container container breadcrumbs bg-white">', '</div>');
			}
			?> -->

	<?php
	while (have_posts()) :
		the_post();

		// Get the ACF fields
		$client = get_field('client');
		$company_operations = get_field('company_operations');
		$monitored_components = get_field('monitored_components');
		$equipment_type = get_field('equipment_type');
		$diagnosed_issue = get_field('diagnosed_issue');
		$savings = get_field('savings');
	?>

		<article <?php post_class('case-study-container'); ?>>
			<!-- Hero section with dark background and featured image -->
			<section class="text-white relative overflow-hidden">
				<div class="big-container mx-auto md:flex items-center">
					<div class="md:w-1/2 py-56 pr-32 md:aspect-square flex flex-col justify-center">
						<?php if (get_the_title()) : ?>
							<?php
							// Get study type terms
							$study_types = get_the_terms(get_the_ID(), 'case_study_type');
							if ($study_types && !is_wp_error($study_types)) {
								$study_type = $study_types[0]->name;
								echo '<div class="text-xl font-osp-din uppercase mb-24">' . esc_html($study_type) . '</div>';
							}
							?>
							<header>
								<h1 class="text-3xl font-osp-din uppercase mb-48"><?php the_title(); ?></h1>
							</header>
						<?php endif; ?>

						<?php if (have_rows('top_area')) : ?>
							<?php while (have_rows('top_area')) : the_row(); ?>
								<?php
								$title = get_sub_field('title');
								$text = get_sub_field('text');
								?>
								<?php if ($text) : ?>
									<div class="mb-20">
										<div class="text-sm uppercase font-osp-din mb-8"><?php echo esc_html($title); ?></div>
										<div class="text-lg"><?php echo esc_html($text); ?></div>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
					<div class="md:w-1/2 desktop:mx-0 -mx-24 md:absolute md:left-50 md:right-0 md:top-0 md:bottom-0">
						<?php if (has_post_thumbnail()) : ?>
							<div class="featured-image w-full h-full">
								<?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'w-full h-full object-cover']); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>

			<?php if (have_rows('bottom_area')) : ?>
				<?php
				$row_count = count(get_field('bottom_area'));
				$index = 0;
				?>
				<?php while (have_rows('bottom_area')) : the_row(); ?>
					<?php
					$title = get_sub_field('title');
					$text = get_sub_field('text');
					$index++;
					$is_last = ($index === $row_count);
					?>
					<section class="py-56 md:py-92 bg-white <?php echo !$is_last ? 'border-b border-dark-grey' : ''; ?>">
						<div class="big-container mx-auto">
							<div class="md:flex">
								<div class="md:w-1/3">
									<?php if ($title): ?>
										<h2 class="text-2xl font-osp-din uppercase mb-32"><?php echo esc_html($title); ?></h2>
									<?php endif; ?>
								</div>
								<div class="md:w-2/3 text-darkest-grey">
									<?php echo $text;
									?>
								</div>
							</div>
						</div>
					</section>
				<?php endwhile; ?>
			<?php endif; ?>

			<!-- Content section for any additional content -->
			<?php if (get_the_content()) : ?>
				<section class="py-56 md:py-92">
					<div class="big-container">
						<div class="entry-content text-darkest-grey">
							<?php the_content(); ?>
						</div>
					</div>
				</section>
			<?php endif; ?>
		</article>

	<?php endwhile; ?>

</main><!-- #main -->

<?php get_footer(); ?>