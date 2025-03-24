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
			<section class="text-white">
				<div class="big-container mx-auto md:flex items-center">
					<div class="md:w-1/2 py-56 pr-32">
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

						<?php if ($client) : ?>
							<div class="mb-20">
								<div class="text-sm uppercase font-osp-din mb-8">CLIENT</div>
								<div class="text-lg"><?php echo esc_html($client); ?></div>
							</div>
						<?php endif; ?>

						<?php if ($company_operations) : ?>
							<div class="mb-20">
								<div class="text-sm uppercase font-osp-din mb-8">COMPANY OPERATIONS</div>
								<div class="text-lg"><?php echo esc_html($company_operations); ?></div>
							</div>
						<?php endif; ?>

						<?php if ($monitored_components) : ?>
							<div class="mb-20">
								<div class="text-sm uppercase font-osp-din mb-8">MONITORED COMPONENTS</div>
								<div class="text-lg"><?php echo esc_html($monitored_components); ?></div>
							</div>
						<?php endif; ?>

						<?php if ($equipment_type) : ?>
							<div class="mb-20">
								<div class="text-sm uppercase font-osp-din mb-8">EQUIPMENT TYPE</div>
								<div class="text-lg"><?php echo esc_html($equipment_type); ?></div>
							</div>
						<?php endif; ?>
					</div>
					<div class="md:w-1/2 desktop:mx-0 -mx-24">
						<?php if (has_post_thumbnail()) : ?>
							<div class="featured-image">
								<?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'w-full h-auto']); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>

			<!-- Diagnosed Issue section -->
			<?php if ($diagnosed_issue) : ?>
				<section class="py-56 md:py-92 border-b border-dark-grey bg-white">
					<div class="big-container mx-auto">
						<div class="md:flex">
							<div class="md:w-1/3">
								<h2 class="text-2xl font-osp-din uppercase mb-32">DIAGNOSED ISSUE</h2>
							</div>
							<div class="md:w-2/3 text-darkest-grey">
								<?php echo $diagnosed_issue; ?>
							</div>
						</div>
					</div>
				</section>
			<?php endif; ?>

			<!-- Savings section -->
			<?php if ($savings) : ?>
				<section class="py-56 md:py-92 bg-white">
					<div class="big-container mx-auto">
						<div class="md:flex">
							<div class="md:w-1/3">
								<h2 class="text-2xl font-osp-din uppercase mb-32">SAVINGS</h2>
							</div>
							<div class="md:w-2/3 text-darkest-grey">
								<?php echo $savings; ?>
							</div>
						</div>
					</div>
				</section>
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