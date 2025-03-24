<?php
/**
 * Custom scripts and styles.
 *
 * @package Viezo
 */

/**
 * Enqueue scripts and styles.
 *
 * @author WebDevStudios
 */
function vzo__scripts() {
	$asset_file_path = dirname( __DIR__ ) . '/build/index.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '1.0.82',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	// Register styles & scripts.
	wp_enqueue_style( 'wd_s', get_stylesheet_directory_uri() . '/build/main.css', [], $asset_file['version'] );
	wp_enqueue_script( 'wds-scripts', get_stylesheet_directory_uri() . '/build/index.js', $asset_file['dependencies'], $asset_file['version'], true );

	wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_deregister_style( 'contact-form-7' );
}
add_action( 'wp_enqueue_scripts', 'vzo__scripts' );

/**
 * Preload styles and scripts.
 *
 * @author WebDevStudios
 */
function vzo__preload_scripts() {
	$asset_file_path = dirname( __DIR__ ) . '/build/index.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '1.0.12',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	?>
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/build/main.css?ver=<?php echo esc_html( $asset_file['version'] ); ?>" as="style">
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/build/index.js?ver=<?php echo esc_html( $asset_file['version'] ); ?>" as="script">
	<?php
}
add_action( 'wp_head', 'vzo__preload_scripts', 1 );

/**
 * Preload assets.
 *
 * @author Corey Collins
 */
function vzo__preload_assets() {
	?>
	<?php if ( vzo__get_custom_logo_url() ) : ?>
		<link rel="preload" href="<?php echo esc_url( vzo__get_custom_logo_url() ); ?>" as="image">
	<?php endif; ?>
	<?php
}
add_action( 'wp_head', 'vzo__preload_assets', 1 );
