<?php

/**
 * Blocks Repeater Template
 * Supports two variants: half-width and full-width
 * Text position options: left, center, right
 */

// Get the blocks repeater field
$blocks = $args['block']['blocks'];

if ($blocks && is_array($blocks)) :
?>

	<div class="blocks-grid desktop:grid desktop:grid-cols-12 desktop:gap-0">
		<?php foreach ($blocks as $index => $block) :
			// Get block data
			$title = $block['data']['title'] ?? false;
			$text = $block['data']['text'] ?? '';
			$button = $block['data']['button'] ?? false;
			$image = $block['image'] ?? false;
			$variant = $block['data']['variant'] ?? 'half-width';
			$text_position = $block['data']['text_position'] ?? 'left';
			$counter = 'block-' . $index;

			// Define column span based on variant
			$col_span = ($variant === 'full-width') ? 'desktop:col-span-12' : 'desktop:col-span-6';

			// Define text alignment classes based on text_position
			$text_alignment = '';
			switch ($text_position) {
				case 'left':
					$text_alignment = 'text-left';
					$flex_alignment = 'justify-start';
					break;
				case 'center':
					$text_alignment = 'text-center';
					$flex_alignment = 'justify-center';
					break;
				case 'right':
					$text_alignment = 'text-right';
					$flex_alignment = 'justify-end';
					break;
				default:
					$text_alignment = 'text-left';
			}

			// Define the container class
			$block_classes = "block-item {$variant} {$counter} {$col_span} relative";
		?>

			<div class="<?= $block_classes; ?>">
				<?php if ($image && isset($image['ID'])) : ?>
					<div class="block-image relative w-full h-full">
						<?php if (isset($image['type']) && $image['type'] == 'video') : ?>
							<video autoplay muted loop playsinline class="w-full h-full object-cover">
								<source src="<?= esc_url($image['url']); ?>" type="video/mp4">
							</video>
						<?php else : ?>
							<?php echo wp_get_attachment_image($image['ID'], 'full', false, ['class' => 'w-full block h-full object-cover']); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div
					class="block-content absolute left-0 right-0 bottom-0 desktop:top-[300px] flex items-center <?= $flex_alignment; ?> p-24 desktop:p-104">
					<div class="content-inner max-w-lg <?= $text_alignment; ?> text-white">
						<?php if ($title) : ?>
							<h2 class="pb-20 font-osp-din uppercase"><?= $title; ?></h2>
						<?php endif; ?>

						<?php if ($text) : ?>
							<div class="text font-body-1 text-white">
								<?= $text; ?>
							</div>
						<?php endif; ?>

						<?php if (!empty($button)) :
							$target = (!empty($button['target']) ? 'target="' . esc_attr($button['target']) . '"' : '');
						?>
							<a href="<?= esc_url($button['url']); ?>" class="button blue-transparent mt-32" <?= $target; ?>>
								<?= esc_html($button['title']); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

		<?php endforeach; ?>
	</div>

<?php endif; ?>