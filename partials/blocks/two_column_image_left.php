<?php

/**
 * Two Columns Block Template
 * Supports two variants: regular-size and full-screen-size
 */

$title = $args['block']['data']['title'] ?? false;
$text = $args['block']['data']['text'];
$button = $args['block']['data']['button'] ?? false;
$variant = $args['block']['data']['variant'];
$counter = (isset($args['counter']) ? 'block-' . $args['counter'] : null);

// Define classes based on variant
$block_classes = "two-columns-block two-column-image-left {$variant} {$counter}";
$container_classes = "px-0 items-center desktop:flex desktop:gap-18 mx-auto";
$image_column_classes = "desktop:col-span-6 relative image-column desktop:py-0 relative";
$image_wrap_classes = "image-wrap relative";

// Add specific classes for full-screen-size variant
if ($variant === 'full-screen-size') {
	$block_classes .= " min-h-screen flex items-center relative";
	$container_classes .= " big-container justify-end";
	$image_column_classes .= " h-full desktop:h-screen desktop:absolute desktop:right-[50%] desktop:left-0 -mx-[1.5rem] desktop:mx-0";
	$image_wrap_classes .= " desktop:h-full";
	$content_wrap_classes = "desktop:w-1/2 text-column px-24 desktop:pl-140 py-44 desktop:py-0 text-left desktop:text-right";
} elseif ($variant === 'classic-two-col') {
	$block_classes .= "desktop:overflow-hidden";
	$container_classes .= " container";
	$image_wrap_classes .= " desktop:relative px-24 desktop:px-0  py-44 desktop:py-0";
	$content_wrap_classes = "desktop:col-span-6 text-column px-24 desktop:px-0 py-44 desktop:py-140 text-left desktop:text-right";
} else {
	// regular-size variant
	$block_classes .= "desktop:overflow-hidden";
	$image_wrap_classes .= " desktop:absolute desktop:right-0";
	$content_wrap_classes = "desktop:col-span-6 text-column px-24 desktop:px-140 py-44 desktop:py-140 text-left desktop:text-right";
}
?>

<div class="<?= $block_classes; ?>">
	<div class="<?= $container_classes; ?>">
		<div class="<?= $image_column_classes; ?>">
			<div class="<?= $image_wrap_classes; ?>">
				<?php if (isset($args['block']['image']['type']) && $args['block']['image']['type'] == 'video'): ?>
					<video autoplay muted loop playsinline
						class="w-full h-full object-cover <?= ($variant === 'full-screen-size' ? 'desktop:h-screen' : ''); ?>">
						<source src="<?= esc_url($args['block']['image']['url']); ?>" type="video/mp4">
					</video>
				<?php else: ?>
					<?php
					$img_classes = ($variant === 'full-screen-size') ? 'w-full h-full object-cover desktop:h-screen' : 'w-full';
					echo wp_get_attachment_image($args['block']['image']['ID'], 'full', false, ['class' => $img_classes]);
					?>
				<?php endif; ?>
			</div>
		</div>

		<div class="<?= $content_wrap_classes ?>">
			<?php if ($title): ?>
				<h2 class="pb-20"><?= $title; ?></h2>
			<?php endif; ?>

			<div class="text font-body-1">
				<?= $text; ?>
			</div>

			<?php if (!empty($button)):
				$target = (!empty($button['target']) ? 'target="' . esc_attr($button['target']) . '"' : '');
			?>
				<a href="<?= esc_url($button['url']); ?>" class="button outline-black mt-32" <?= $target; ?>>
					<?= esc_html($button['title']); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>