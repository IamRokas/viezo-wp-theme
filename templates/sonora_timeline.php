<?php

/**
 * Function to display the timeline component
 * 
 * @param array $elements Array of timeline elements
 * @return void Outputs HTML directly
 */
function display_timeline($elements = null)
{
	// If no elements are passed, try to get them from ACF
	if (empty($elements) && function_exists('get_field')) {
		$elements = get_field('Element');
	}

	// Return early if no elements found
	if (empty($elements) || !is_array($elements)) {
		return;
	}

?>
	<div class="powerail py-48">
		<h2 class="text-center">Powerail</h2>

		<div class="mobile-device text-center desktop:hidden">

			<!-- 				old : <img src="<?= get_template_directory_uri() . '/build/images/full-powerrail.png'; ?>" class="mx-auto" /> -->
			<img src="https://viezo.lt/wp-content/uploads/2023/06/full-sensor.png" class="mx-auto" />
			<div class="icon-play mx-auto icon-play animate-bounce flex items-end h-92">
				<svg width="59" height="59" viewBox="0 0 59 59" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M0 29.5C0 23.6655 1.73014 17.9619 4.97164 13.1107C8.21314 8.25944 12.8204 4.47836 18.2108 2.24557C23.6013 0.0127857 29.5327 -0.571418 35.2551 0.566846C40.9776 1.70511 46.234 4.51472 50.3596 8.64036C54.4853 12.766 57.2949 18.0224 58.4332 23.7448C59.5714 29.4673 58.9872 35.3988 56.7544 40.7892C54.5217 46.1796 50.7406 50.7869 45.8893 54.0284C41.0381 57.2699 35.3345 59 29.5 59C21.6789 58.991 14.1807 55.88 8.65034 50.3497C3.11998 44.8193 0.00905187 37.3211 0 29.5ZM54.6496 29.5C54.6491 24.526 53.1737 19.6638 50.41 15.5283C47.6462 11.3928 43.7183 8.16964 39.1227 6.26648C34.5272 4.36331 29.4706 3.86559 24.5922 4.83625C19.7138 5.80691 15.2328 8.20236 11.7158 11.7197C8.19876 15.237 5.80374 19.7182 4.83352 24.5967C3.8633 29.4752 4.36148 34.5318 6.26506 39.1271C8.16863 43.7225 11.3921 47.6502 15.5279 50.4135C19.6637 53.1769 24.526 54.6518 29.5 54.6518C36.1683 54.6446 42.5613 51.9923 47.2762 47.2769C51.9912 42.5615 54.6429 36.1683 54.6496 29.5Z"
						fill="white" fill-opacity="0.6" />
					<path
						d="M29.5003 49.704L12.7324 29.3882H19.2421V14.2004L39.7562 14.2004V29.3882H46.2682L29.5003 49.704Z"
						fill="white" fill-opacity="0.6" />
				</svg>
			</div>

		</div>
		<div class="container bg-gray-200 mx-auto w-full h-full">
			<div class="relative wrap mb-32 pb-64 h-full timeline" id="gsap">
				<div class="topin w-8 absolute h-full" style="left: 50%"></div>
				<?php
				foreach ($elements as $key => $el):
					$leftSide = ($key % 2 == 0);
					$title = $el['title'] ?? '';
					$text = $el['description'] ?? '';
					$image = $el['image'] ?? [];
					$image_url = isset($image['url']) ? $image['url'] : '';
				?>
					<div class="mb-8 flex gap-20 justify-between <?= ($key > 0) ? 'animme' : ''; ?> <?= ($leftSide ? 'desktop:flex-row-reverse left-side' : 'right-side'); ?> items-center relative w-full panel"
						data-key="<?= $key; ?>" id="panel-<?= $key; ?>">
						<div class="order-1 w-4/12 hidden desktop:block"></div>
						<div class="order-1 self-center mt-0 w-6/12 desktop:w-4/12 rounded-full the-stop"
							id="the-stop-<?= $key; ?>">
							<?php if ($image_url): ?>
								<img src="<?= esc_url($image_url); ?>" alt="" class="image mx-auto relative" />
							<?php endif; ?>
						</div>

						<div
							class="order-1 w-6/12 desktop:w-4/12 px-6 py-48 desktop:py-64 desktop:pt-20 relative <?= ($leftSide ? 'text-left desktop:text-right' : 'text-left desktop:text-left'); ?>">
							<div class="text-wrap">
								<h3 class="my-20 inline-block relative">
									<span class="text"><?= esc_html($title); ?></span>
									<div class="green-line green-line-<?= $key; ?> absolute"></div>
								</h3>
								<p class="font-body-2"><?= wp_kses_post($text); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php
}
