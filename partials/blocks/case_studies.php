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
							<div class="see-more-link mt-20 desktop:mt-32">
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

	<?php else : // Original Design 
	?>
		<div class="case-studies-block bg-dark-grey text-white pt-40 md:pt-80">
			<div class="container">
				<h2 class="font-osp-din uppercase mb-48"><?= esc_html($block_title); ?></h2>

				<div class="case-studies-grid desktop:grid desktop:grid-cols-3 gap-24 overflow-hidden">
					<?php
					foreach ($cases as $case_id) :
						// Setup the post data to make template tags work
						$post = get_post($case_id);
						if ($post) :
							setup_postdata($post);

							// Include the case study card partial
							get_template_part('partials/case-study-card');

						endif;
					endforeach;

					// Reset post data to the main query
					wp_reset_postdata();
					?>
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