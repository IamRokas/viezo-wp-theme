<?php

/**
 * Blocks Repeater Template
 * Supports two variants: half-width and full-width
 * Text position options: left, center, right
 */

// Get the blocks repeater field
$blocks = $args['block']['blocks'];
$title = $args['block']['title'];
$read_more_text = $args['block']['read_more_text'] ?? 'SEE ALL';
$read_more_link = $args['block']['read_more_link'] ?? array('url' => get_post_type_archive_link('case-study'));
$read_more_link_text = $args['block']['read_more_link']['title'] ?? '';

if ($blocks && is_array($blocks)) :
?>
	<div class="pt-40 desktop:pt-80 image-grid-with-logos">
		<h2 class=" pb-56 font-osp-din text-center uppercase"><?= $title; ?></h2>
		<div class="border-t border-black">
			<div
				class="blocks-grid-logos flex flex-nowrap desktop:grid desktop:grid-cols-3 desktop:gap-24 gap-20 container overflow-x-scroll desktop:overflow-hidden">
				<?php foreach ($blocks as $index => $block) :
					// Get block data
					$title = $block['title'] ?? false;
					$text = $block['text'] ?? false;
					$logo = $block['logo'] ?? false;
					$image = $block['image'] ?? false;
					$counter = 'block-' . $index;

					// Define the container class
					$block_classes = "block-item relative p-20 md:p-64 min-w-[260px]";
				?>

					<div class=" <?= $block_classes; ?>">
						<?php if (!empty($logo)) : ?>
							<div class="block-logo device-image relative w-full ">
								<?php echo wp_get_attachment_image($logo, 'full', false, ['class' => 'w-full block']); ?>
							</div>
						<?php endif; ?>
						<?php if (!empty($image)) : ?>
							<div class="block-image device-image relative w-full ">
								<?php echo wp_get_attachment_image($image, 'full', false, ['class' => 'block']); ?>
							</div>
						<?php endif; ?>
						<div class="block-content">
							<?php if ($title) : ?>
								<h3 class="pb-24 mt-20 font-osp-din uppercase text-black"><?= $title; ?></h3>
							<?php endif; ?>
							<?php if ($text) : ?>
								<span class="font-body-1"><?= $text; ?>
								<?php endif; ?>
								</span>
						</div>
					</div>

				<?php endforeach; ?>
			</div>
		</div>

		<?php if (!empty($read_more_link) && !empty($read_more_text)) : ?>
			<div class="text-center flex gap-12 items-center py-28 border-t border-white justify-center bg-dark-grey">
				<p class="text-white mb-0 font-body-1"><?= esc_html($read_more_text); ?></p>
				<a href="<?= esc_url($read_more_link['url'] ?? get_post_type_archive_link('case-study')); ?>"
					class="button outline-white">
					<?= esc_html($read_more_link_text); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>