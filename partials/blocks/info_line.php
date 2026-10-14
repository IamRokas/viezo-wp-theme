<?php

/**
 * Info Line Block Template
 * Displays a text label and a link button in a horizontal row.
 */

$info_line_text = $args['block']['info_line_text'] ?? 'Testsas';
$info_line_link = $args['block']['info_line_link'] ?? array();
$settings       = $args['block']['settings'] ?? [];
$border_top     = $settings['border_top']  ?? false;
$border_bottom  = $settings['border_bottom'] ?? false;
$spacing        = $settings['spacing']     ?? false;
$dark_mode      = $settings['dark_mode']   ?? false;

if (empty($info_line_text) && empty($info_line_link)) {
    return;
}

$wrapper_classes = 'flex gap-12 items-center py-28 justify-center';

if ($dark_mode) {
    $wrapper_classes .= ' bg-dark-grey';
}

if ($border_top) {
    $wrapper_classes .= $dark_mode ? ' border-t border-white' : ' border-t border-black';
}

if ($border_bottom) {
    $wrapper_classes .= $dark_mode ? ' border-b border-white' : ' border-b border-black';
}

if ($spacing) {
    $wrapper_classes .= ' mt-32';
}

$text_class   = $dark_mode ? 'text-white mb-0 font-body-1' : 'text-black mb-0 font-body-1';
$button_class = $dark_mode ? 'button outline-white' : 'button outline-black';
?>

<div class="<?= esc_attr($wrapper_classes); ?>">
    <?php if (!empty($info_line_text)) : ?>
    <p class="<?= $text_class; ?>"><?= esc_html($info_line_text); ?></p>
    <?php endif; ?>

    <?php if (!empty($info_line_link['url'])) : ?>
    <a href="<?= esc_url($info_line_link['url']); ?>" class="<?= $button_class; ?>"
        <?= !empty($info_line_link['target']) ? 'target="' . esc_attr($info_line_link['target']) . '"' : ''; ?>>
        <?= esc_html($info_line_link['title'] ?? ''); ?>
    </a>
    <?php endif; ?>
</div>
