<?php
$pageId = (isset($args['pageId']) ? (int)$args['pageId'] : 0);
$headerSize = (isset($args['headerSize']) ? $args['headerSize'] : get_field('header_size', $pageId));
$headerFile = get_field('header_file', $pageId);
$title = get_field('header_title');
$subtitle_below = get_field('subtitle_below_image');
$side_image = get_field('side_image');

if ($title == '')
    $title = get_the_title($pageId);

$subtitle = nl2br(get_field('header_subtitle', $pageId));
$button = get_field('header_button', $pageId);
$background = get_field('header_background', $pageId) ?? ['url' => false, 'type' => 'image'];
if (empty($background)) {
    $background = [
        'type' => 'image',
        'url' => get_template_directory_uri() . '/build/images/default-header.jpg'
    ];
}
?>
<header class="page-header px-0 flex items-end justify-center header-<?= $headerSize; ?>">
    <?php if (!empty($background)): ?>
        <?php if ($background['type'] == 'video'): ?>
            <video class="bg video" autoplay muted loop playsinline>
                <source src="<?= $background['url']; ?>" type="video/mp4" />
            </video>
        <?php else: ?>
            <div class="bg image" style="background-image: url(<?= $background['url']; ?>);"></div>
        <?php endif; ?>
        <div class="bg-shadow"></div>
    <?php endif; ?>
    <div class="textblock container text-white">
        <?php $classes = is_front_page() ? 'text-center ' : ''; ?>
        <div class="inside <?= print $classes; ?>">
            <h1><?= $title; ?></h1>
            <?php if (!$subtitle_below && $subtitle): ?>
                <div class="subtitle mx-auto"><?= $subtitle; ?></div>

                <?php if (is_front_page()): ?>
                    <div
                        class="mt-68 text-center flex justify-center arrow-down transition-all hover:top-[5px] top-0 relative cursor-pointer">
                        <svg width="82" height="82" viewBox="0 0 82 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="41" cy="40.9899" r="40.3375" stroke="white" />
                            <path
                                d="M40.2928 55.4273C40.6833 55.8178 41.3165 55.8178 41.707 55.4273L48.0709 49.0634C48.4615 48.6728 48.4615 48.0397 48.0709 47.6491C47.6804 47.2586 47.0473 47.2586 46.6567 47.6491L40.9999 53.306L35.343 47.6491C34.9525 47.2586 34.3193 47.2586 33.9288 47.6491C33.5383 48.0397 33.5383 48.6728 33.9288 49.0634L40.2928 55.4273ZM39.9999 27.2598L39.9999 54.7202L41.9999 54.7202L41.9999 27.2598L39.9999 27.2598Z"
                                fill="white" />
                        </svg>
                    </div>
                <?php endif; ?>

                <?php if ($button): ?>
                    <a href="<?= $button['url']; ?>" class="button outline-white mt-28"><?= $button['title']; ?></a>
                <?php endif; ?>
            <?php endif; ?>



        </div>
    </div>
    <?php
    ?>
</header>
<?php if ($subtitle_below && $subtitle): ?>
    <div
        class="textblock header-btn-scroll container text-black py-58 flex flex-col-reverse md:flex-row justify-between items-center">
        <div class="subtitle font-body-1 md:col-span-3 max-w-lg">
            <div><?= $subtitle; ?></div>
            <?php if ($button): ?>
                <a href="<?= $button['url']; ?>" class="button header-btn outline-black mt-28"><?= $button['title']; ?></a>
            <?php endif; ?>
        </div>
        <?php if ($side_image): ?>
            <div class="image md:w-1/2 mb-24 md:mb-0 md:-mt-64">
                <?= wp_get_attachment_image($side_image, 'custom-image-style', false, ['class' => 'w-full h-auto']); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>