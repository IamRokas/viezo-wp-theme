<?php
/**
 * Custom scripts and styles.
 *
 * @package Viezo
 */

/**
 * Get the Vite dev server URL when `npm run dev` is running.
 *
 * @return string|false Dev server URL, or false in production.
 */
function vzo__vite_dev_server() {
	$hot_file = get_template_directory() . '/build/hot';

	return is_readable( $hot_file ) ? untrailingslashit( trim( file_get_contents( $hot_file ) ) ) : false; // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
}

/**
 * Get the version string for a built asset (its modification time).
 *
 * Keeps enqueue and preload URLs identical and busts caches after every build.
 *
 * @param string $file File path relative to the build directory.
 * @return string Asset version.
 */
function vzo__asset_version( $file ) {
	$path = get_template_directory() . '/build/' . $file;

	return is_readable( $path ) ? (string) filemtime( $path ) : wp_get_theme()->get( 'Version' );
}

/**
 * Enqueue scripts and styles.
 *
 * @author WebDevStudios
 */
function vzo__scripts() {
	$dev_server = vzo__vite_dev_server();

	if ( $dev_server ) {
		// Vite serves JS and injects CSS with hot module replacement.
		wp_enqueue_script( 'vite-client', $dev_server . '/@vite/client', [], null, false ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_script( 'wds-scripts', $dev_server . '/src/index.js', [ 'vite-client' ], null, true ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	} else {
		wp_enqueue_style( 'wd_s', get_stylesheet_directory_uri() . '/build/main.css', [], vzo__asset_version( 'main.css' ) );
		wp_enqueue_script( 'wds-scripts', get_stylesheet_directory_uri() . '/build/index.js', [], vzo__asset_version( 'index.js' ), true );
	}

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
 * Load dev server scripts as ES modules.
 *
 * @param string $tag    Script tag.
 * @param string $handle Script handle.
 * @return string
 */
function vzo__vite_module_scripts( $tag, $handle ) {
	if ( vzo__vite_dev_server() && in_array( $handle, [ 'vite-client', 'wds-scripts' ], true ) ) {
		$tag = str_replace( '<script ', '<script type="module" ', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'vzo__vite_module_scripts', 10, 2 );

/**
 * Preload styles and scripts.
 *
 * @author WebDevStudios
 */
function vzo__preload_scripts() {
	if ( vzo__vite_dev_server() ) {
		return;
	}
	?>
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/build/main.css?ver=<?php echo esc_attr( vzo__asset_version( 'main.css' ) ); ?>" as="style">
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/build/index.js?ver=<?php echo esc_attr( vzo__asset_version( 'index.js' ) ); ?>" as="script">
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
