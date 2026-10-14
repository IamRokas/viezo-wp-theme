<?php
$sonora_title       = get_field('sonora_title', 'option');
$sonora_content     = get_field('sonora_content', 'option');
$sonora_bottom_text = get_field('sonora_bottom_text', 'option');
$sonora_bottom_link = get_field('sonora_bottom_link', 'option');

$grid_positions = [
    'desktop:col-start-1 desktop:col-span-3 desktop:row-start-1 desktop:row-span-3',
    'desktop:col-start-1 desktop:col-span-3 desktop:row-start-5 desktop:row-span-3',
    'desktop:col-start-6 desktop:col-span-3 desktop:row-start-1 desktop:row-span-3',
    'desktop:col-start-6 desktop:col-span-3 desktop:row-start-5 desktop:row-span-3',
];
?>
<div class="bg-dark-grey pt-20">
    <div class="container text-white">
        <div id="sonora-animation-container" class="h-[600vh] desktop:h-[500vh] relative">
            <?php if ($sonora_title) : ?>
            <h2 class="text-center py-48"><?php echo esc_html($sonora_title); ?></h2>
            <?php endif; ?>
            <div class="sticky top-0">
                <div class="relative h-screen pb-48 pt-104 desktop:flex desktop:items-center">
                    <div
                        class="h-full desktop:h-auto grid grid-cols-2 desktop:grid-cols-8 desktop:grid-rows-8 gap-10 desktop:gap-48">
                        <?php if ($sonora_content) :
                            $index = 0;
                            foreach (array_slice($sonora_content, 0, 4) as $block) :
                                $pos = $grid_positions[$index] ?? '';
                        ?>
                        <div
                            class="sonora-text-block col-start-1 col-span-2 row-start-1 <?php echo esc_attr($pos); ?> opacity-0 transition-all duration-1000">
                            <?php if (!empty($block['title'])) : ?>
                            <h3 class="text-xl desktop:text-2xl mb-20"><?php echo esc_html($block['title']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($block['content'])) : ?>
                            <p class="text-[16px] font-hiragino-sans"><?php echo wp_kses_post($block['content']); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php $index++;
                            endforeach;
                        endif; ?>
                        <div
                            class="col-span-2 row-start-2 row-span-3 desktop:col-start-4 desktop:col-span-2 desktop:row-start-1 desktop:row-span-8 flex justify-center desktop:justify-normal desktop:grid items-center h-full">
                            <div id="sonora-sprite-container" class="sonara-image w-1/2 desktop:w-full">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($sonora_bottom_text || $sonora_bottom_link) : ?>
    <div
        class="text-center mt-32 flex gap-12 px-8 md:px-0 items-center py-28 border-t border-white justify-center font-body-1">
        <?php if ($sonora_bottom_text) : ?>
        <p class="text-white mb-0"><?php echo esc_html($sonora_bottom_text); ?></p>
        <?php endif; ?>
        <?php if ($sonora_bottom_link) :
                $link_url    = $sonora_bottom_link['url'] ?? '';
                $link_title  = $sonora_bottom_link['title'] ?? '';
                $link_target = !empty($sonora_bottom_link['target']) ? ' target="' . esc_attr($sonora_bottom_link['target']) . '"' : '';
            ?>
        <a href="<?php echo esc_url($link_url); ?>" <?php echo $link_target; ?> class="button outline-white">
            <?php echo esc_html($link_title); ?>
        </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<style>
.sonara-image {
    background-image: url('<?php echo get_template_directory_uri(); ?>/anim-assets/spritesheet.png');
    background-size: cover;
    background-repeat: no-repeat;
    aspect-ratio: 0.5046923;
}
</style>