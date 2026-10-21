<?php

/**
 * FAQ Block
 *
 * ACF flexible content layout: faq
 * Fields: title, subtitle, items (repeater: question, answer), settings (border_top, border_bottom, schema)
 *
 * Questions are native <details> elements: no JS, keyboard accessible, and the answers stay in
 * the HTML for search engines. FAQ structured data comes from vzo__schema_faq() in inc/seo.php.
 */

$title    = $args['block']['title']    ?? '';
$subtitle = $args['block']['subtitle'] ?? '';
$items    = array_filter(
	(array) ($args['block']['items'] ?? []),
	function ($item) {
		return !empty($item['question']) && !empty($item['answer']);
	}
);

if (!$items) {
	return;
}

$settings      = $args['block']['settings'] ?? [];
$border_top    = $settings['border_top']    ?? false;
$border_bottom = $settings['border_bottom'] ?? false;

$section_classes = 'faq-block py-40 md:py-80';
if ($border_top)    $section_classes .= ' border-t border-black';
if ($border_bottom) $section_classes .= ' border-b border-black';
?>

<section class="<?= esc_attr($section_classes); ?>">
    <div class="container max-w-[880px]">

        <?php if ($title) : ?>
        <h2 class="faq-block__title mb-20"><?= esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($subtitle) : ?>
        <p class="faq-block__subtitle text-center font-extralight mb-40"><?= esc_html($subtitle); ?></p>
        <?php endif; ?>

        <div class="faq-block__list">
            <?php foreach ($items as $item) : ?>
            <details class="faq-block__item">
                <summary class="faq-block__question">
                    <span><?= esc_html($item['question']); ?></span>
                    <span class="faq-block__icon" aria-hidden="true"></span>
                </summary>
                <div class="faq-block__answer">
                    <?= wp_kses_post($item['answer']); ?>
                </div>
            </details>
            <?php endforeach; ?>
        </div>

    </div>
</section>
