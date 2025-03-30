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
					$container_class = '';
					break;
				case 'center':
					$text_alignment = 'text-center';
					$flex_alignment = 'justify-center desktop:top-0';
					$container_class = ' max-w-2xl';
					break;
				case 'right':
					$text_alignment = 'text-left desktop:text-right';
					$flex_alignment = 'justify-end';
					$container_class = '';
					break;
				default:
					$text_alignment = 'text-left';
			}

			// Define the container class
			$block_classes = "block-item flex {$variant} {$counter} {$col_span} relative min-h-[350px] desktop:min-h-[60vh]";
		?>

			<div class="<?= $block_classes; ?>">
				<?php if ($image && isset($image['ID'])) : ?>
					<div class="block-image absolute w-full inset-0">
						<?php if (isset($image['type']) && $image['type'] == 'video') : ?>
							<video autoplay muted loop playsinline class="w-full h-full object-cover">
								<source src="<?= esc_url($image['url']); ?>" type="video/mp4">
							</video>
						<?php else : ?>
							<?php echo wp_get_attachment_image($image['ID'], 'full', false, ['class' => 'w-full block h-full object-cover']); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="block-content relative md:p-24 desktop:px-104 desktop:py-56 w-full flex">
					<div class="content-inner container flex items-center <?= $flex_alignment; ?>">
						<div class="max-w-xl <?= $text_alignment;
												print $container_class; ?> text-white">
							<?php if ($title) : ?>
								<h2 class=" pb-20 font-osp-din uppercase"><?= $title; ?></h2>
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
			</div>

		<?php endforeach; ?>
	</div>

<?php endif; ?>