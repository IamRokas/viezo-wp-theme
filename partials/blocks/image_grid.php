<?php

/**
 * Blocks Repeater Template
 * Supports two variants: half-width and full-width
 * Text position options: left, center, right
 */

// Get the blocks repeater field
$blocks = $args['block']['blocks'];
$title = $args['block']['title'];

if ($blocks && is_array($blocks)) :
?>
	<div class="container py-64 desktop:py-104">
		<h2 class=" pb-20 font-osp-din uppercase"><?= $title; ?></h2>
		<div class="blocks-grid desktop:grid desktop:grid-cols-3 desktop:gap-24 gap-20">
			<?php foreach ($blocks as $index => $block) :
				// Get block data
				$title = $block['title'] ?? false;
				$image = $block['image'] ?? false;
				$counter = 'block-' . $index;

				// Define the container class
				$block_classes = "block-item relative";
			?>

				<div class="<?= $block_classes; ?>">
					<?php if (!empty($image)) : ?>
						<div class="block-image relative w-full ">
							<?php if (wp_attachment_is('video', $image)) : ?>
								<?php
								$video_url = wp_get_attachment_url($image);
								if ($video_url) :
								?>
									<video autoplay muted loop playsinline class="w-full h-full object-cover">
										<source src="<?= esc_url($video_url); ?>" type="video/mp4">
									</video>
								<?php endif; ?>
							<?php else : ?>
								<?php echo wp_get_attachment_image($image, 'full', false, ['class' => 'w-full block h-full object-cover']); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="block-content">
						<?php if ($title) : ?>
							<h3 class="pb-30 mt-20 font-osp-din uppercase text-black"><?= $title; ?></h3>
						<?php endif; ?>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>