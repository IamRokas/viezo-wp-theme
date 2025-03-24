<?php

/**
 * Product Comparison Block
 * Displays a 3-column comparison of product specifications
 * With horizontal scrolling on mobile devices
 */

$rows = $args['block']['rows'] ?? []; // repeater with fields - 1st_col_data || 2nd_col_data || 3rd_col_data
$header_settings = $args['block']['header_settings'] ?? [];
$first_col_title = $header_settings['1_col_title'] ?? '';
$second_col_title = $header_settings['2_col_title'] ?? '';
$third_col_title = $header_settings['3_col_title'] ?? '';
$second_col_image = $header_settings['2_col_image'] ?? ''; // Image id
$third_col_image = $header_settings['3_col_image'] ?? ''; // Image id

// Determine how many columns to display
$column_count = 1; // Always show at least the first column
if (!empty($second_col_title)) $column_count++;
if (!empty($third_col_title)) $column_count++;

// Define minimum column width
$min_column_width = 'min-w-[180px]';

if (!empty($rows)) :
?>
    <div class="product-comparison-block py-40 md:py-80">
        <div class="container overflow-x-auto pb-8">
            <div class="comparison-table min-w-max md:min-w-0">
                <!-- Header Row -->
                <div class="comparison-header flex border-b border-border-gray">
                    <!-- First Column Header -->
                    <div
                        class="comparison-header-cell <?= $min_column_width; ?> text-lg md:text-xl w-1/3 p-12 md:p-16 font-osp-din uppercase text-darkest-grey text-sm md:text-base flex items-end">
                        <?= esc_html($first_col_title); ?>
                    </div>

                    <!-- Second Column Header -->
                    <?php if (!empty($second_col_title)) : ?>
                        <div
                            class="comparison-header-cell <?= $min_column_width; ?> w-1/3 p-12 md:p-16 border-border-gray text-center">
                            <?php if (!empty($second_col_image)) : ?>
                                <div class="header-image mb-12 md:mb-16 flex justify-center">
                                    <?= wp_get_attachment_image($second_col_image, 'medium', false, ['class' => '']); ?>
                                </div>
                            <?php endif; ?>
                            <h3 class="font-osp-din uppercase text-darkest-grey text-lg md:text-xl">
                                <?= esc_html($second_col_title); ?></h3>
                        </div>
                    <?php endif; ?>

                    <!-- Third Column Header -->
                    <?php if (!empty($third_col_title)) : ?>
                        <div
                            class="comparison-header-cell <?= $min_column_width; ?> w-1/3 p-12 md:p-16 border-border-gray text-center">
                            <?php if (!empty($third_col_image)) : ?>
                                <div class="header-image mb-12 md:mb-16 flex justify-center">
                                    <?= wp_get_attachment_image($third_col_image, 'medium', false, ['class' => '']); ?>
                                </div>
                            <?php endif; ?>
                            <h3 class="font-osp-din uppercase text-darkest-grey text-lg md:text-xl">
                                <?= esc_html($third_col_title); ?></h3>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Data Rows -->
                <?php foreach ($rows as $index => $row) :
                    $first_col = $row['1st_col_data'] ?? '';
                    $second_col = $row['2nd_col_data'] ?? '';
                    $third_col = $row['3rd_col_data'] ?? '';
                ?>
                    <div class="comparison-row flex border-b border-border-gray">
                        <!-- First Column Data -->
                        <div
                            class="comparison-cell <?= $min_column_width; ?> w-1/3 p-12 md:p-16 text-darkest-grey text-sm md:text-base">
                            <?= esc_html($first_col); ?>
                        </div>

                        <!-- Second Column Data -->
                        <?php if (!empty($second_col_title)) : ?>
                            <div
                                class="comparison-cell <?= $min_column_width; ?> w-1/3 p-12 md:p-16  text-center text-sm md:text-base">
                                <?php echo $second_col; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Third Column Data -->
                        <?php if (!empty($third_col_title)) : ?>
                            <div
                                class="comparison-cell <?= $min_column_width; ?> w-1/3 p-12 md:p-16  text-center text-sm md:text-base">
                                <?php echo $third_col; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>