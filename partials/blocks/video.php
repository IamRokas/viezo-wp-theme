<?php

/**
 * Video Block Template
 *
 * ACF flexible content layout: video
 * Fields: title, subtitle, video (group: video_file [file_id], video_embed [oembed], image_cover [image_id])
 */

$title          = $args['block']['title']    ?? false;
$subtitle       = $args['block']['subtitle'] ?? false;
$video_group    = $args['block']['video']    ?? [];
$video_file_id  = !empty($video_group['video_file'])  ? $video_group['video_file']  : false;
$video_embed    = !empty($video_group['video_embed'])  ? $video_group['video_embed']  : false;
$image_cover_id = !empty($video_group['image_cover']) ? $video_group['image_cover'] : false;

// Nothing to render without a video source.
if (! $video_file_id && ! $video_embed) {
	return;
}

$video_url   = $video_file_id  ? wp_get_attachment_url($video_file_id)               : false;
$cover_url   = $image_cover_id ? wp_get_attachment_image_url($image_cover_id, 'large') : false;
$cover_alt   = $image_cover_id ? get_post_meta($image_cover_id, '_wp_attachment_image_alt', true) : '';

// Build an embeddable URL from the oembed URL (YouTube / Vimeo).
$embed_src = false;
if ($video_embed && ! $video_file_id) {
	if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $video_embed, $m)) {
		$embed_src = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0&playsinline=1';
	} elseif (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $video_embed, $m)) {
		$embed_src = 'https://player.vimeo.com/video/' . $m[1] . '?dnt=1';
	}
}

// Bail if we could not resolve an embed URL.
if (! $video_url && ! $embed_src) {
	return;
}

$has_cover = (bool) $cover_url;

$settings      = $args['block']['settings'] ?? [];
$border_top    = $settings['border_top']    ?? false;
$border_bottom = $settings['border_bottom'] ?? false;

$section_classes = 'video-block py-80';
if ($border_top)    $section_classes .= ' border-t border-black';
if ($border_bottom) $section_classes .= ' border-b border-black';
?>

<section class="<?= esc_attr($section_classes); ?>">
    <div class="container">

        <?php if ($title) : ?>
        <h2 class="video-block__title mb-20"><?= esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($subtitle) : ?>
        <p class="video-block__subtitle text-center font-extralight mb-40"><?= esc_html($subtitle); ?></p>
        <?php endif; ?>

        <div class="video-block__wrap" data-video-block>

            <?php if ($has_cover) : ?>
            <div class="video-block__cover" data-video-cover>
                <img src="<?= esc_url($cover_url); ?>" alt="<?= esc_attr($cover_alt); ?>" class="video-block__cover-img"
                    loading="lazy">
                <button class="video-block__play" data-video-play aria-label="<?= esc_attr__('Play video', 'viezo'); ?>"
                    type="button">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                        aria-hidden="true" focusable="false">
                        <path d="M8 5.14v13.72L19 12 8 5.14z" fill="currentColor" />
                    </svg>
                </button>
            </div>
            <?php endif; ?>

            <?php if ($video_url) : ?>
            <video class="video-block__video<?= $has_cover ? ' video-block__video--hidden' : ''; ?>" playsinline
                preload="<?= $has_cover ? 'none' : 'metadata'; ?>"
                <?= $cover_url ? 'poster="' . esc_url($cover_url) . '"' : ''; ?>>
                <source src="<?= esc_url($video_url); ?>" type="video/mp4">
            </video>

            <?php if (! $has_cover) : ?>
            <div class="video-block__initial-play" data-video-initial-play>
                <button class="video-block__play" data-video-play type="button"
                    aria-label="<?= esc_attr__('Play video', 'viezo'); ?>">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                        aria-hidden="true" focusable="false">
                        <path d="M8 5.14v13.72L19 12 8 5.14z" fill="currentColor" />
                    </svg>
                </button>
            </div>
            <?php endif; ?>

            <div class="video-block__controls<?= $has_cover ? ' video-block__controls--hidden' : ''; ?>" data-video-controls>
                <button class="video-block__toggle" data-video-toggle
                    aria-label="<?= esc_attr__('Pause video', 'viezo'); ?>" type="button">
                    <span class="video-block__toggle-play" aria-hidden="true"></span>
                    <span class="video-block__toggle-pause" aria-hidden="true"></span>
                </button>
                <div class="video-block__progress-wrap">
                    <input type="range" class="video-block__progress" data-video-progress
                        min="0" max="100" value="0" step="0.1"
                        aria-label="<?= esc_attr__('Video progress', 'viezo'); ?>">
                </div>
                <span class="video-block__time" data-video-time>0:00</span>
                <div class="video-block__volume-wrap">
                    <button class="video-block__mute" data-video-mute type="button"
                        aria-label="<?= esc_attr__('Mute video', 'viezo'); ?>">
                        <svg class="video-block__icon-unmuted" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" width="18" height="18" aria-hidden="true" focusable="false">
                            <path d="M11 5L6 9H2v6h4l5 4V5z" fill="currentColor"/>
                            <path d="M15.54 8.46a5 5 0 0 1 0 7.07" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                            <path d="M18.36 5.64a9 9 0 0 1 0 12.73" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                        </svg>
                        <svg class="video-block__icon-muted" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" width="18" height="18" aria-hidden="true" focusable="false">
                            <path d="M11 5L6 9H2v6h4l5 4V5z" fill="currentColor"/>
                            <line x1="23" y1="9" x2="17" y2="15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="17" y1="9" x2="23" y2="15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <input type="range" class="video-block__volume" data-video-volume
                        min="0" max="1" step="0.02" value="1"
                        aria-label="<?= esc_attr__('Volume', 'viezo'); ?>">
                </div>
                <button class="video-block__fullscreen" data-video-fullscreen type="button"
                    aria-label="<?= esc_attr__('Fullscreen', 'viezo'); ?>">
                    <svg class="video-block__icon-expand" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" aria-hidden="true" focusable="false">
                        <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"
                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg class="video-block__icon-collapse" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" aria-hidden="true" focusable="false">
                        <path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"
                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <?php elseif ($embed_src) : ?>
            <div class="video-block__embed<?= $has_cover ? ' video-block__embed--hidden' : ''; ?>" data-video-embed
                data-video-src="<?= esc_url($embed_src); ?>">
                <?php if (! $has_cover) : ?>
                <iframe src="<?= esc_url($embed_src); ?>" allow="fullscreen; picture-in-picture" allowfullscreen
                    loading="lazy" class="video-block__iframe"></iframe>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
