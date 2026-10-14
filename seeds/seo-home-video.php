<?php
/**
 * Seed: Home hero video, compressed.
 *
 * The home page header played a 50 MB 4K video (Indutrial-Web-video-main-page-1-1.mp4). This
 * imports a 4.8 MB 720p version without audio (seeds/assets/seo/home-hero-720.mp4, same
 * footage, 25 fps) plus a poster image, and switches the "Header background" of the English
 * and Polish home pages to it. partials/page-header.php shows the poster while the video loads.
 *
 * The old video stays in the Media Library, so switching back is one field change.
 *
 * Re-encode command (from the original):
 *   ffmpeg -i original.mp4 -an -vf "scale=1280:-2,fps=25" -c:v libx264 -preset slower -crf 31 \
 *     -profile:v high -pix_fmt yuv420p -movflags +faststart home-hero-720.mp4
 *
 * @package Viezo
 */

defined( 'ABSPATH' ) || exit;

return [
	'title'       => 'SEO: compressed home hero video',
	'description' => 'Replaces the 50 MB home page header video with a 4.8 MB version and adds a poster image (English and Polish home pages).',
	'run'         => function () {
		$video_id  = vzo__seed_import_image( 'seo/home-hero-720.mp4' );
		$poster_id = vzo__seed_import_image( 'seo/home-hero-poster.webp' );

		if ( ! $video_id || ! $poster_id ) {
			throw new RuntimeException( 'seeds/assets/seo/home-hero-720.mp4 or home-hero-poster.webp is missing.' );
		}

		update_post_meta( $video_id, '_vzo_poster_id', $poster_id );
		update_post_meta( $poster_id, '_wp_attachment_image_alt', 'Industrial machine in operation' );

		$front = (int) get_option( 'page_on_front' );

		if ( ! $front ) {
			throw new RuntimeException( 'No static front page is set (Settings → Reading).' );
		}

		$pages = [ $front ];

		if ( function_exists( 'pll_get_post_translations' ) ) {
			$pages = array_values( array_unique( array_map( 'intval', pll_get_post_translations( $front ) ?: [ $front ] ) ) );
		}

		// Write each translation separately; Polylang's custom-field sync would otherwise copy
		// values across languages for scripted writes (see docs/seeds.md).
		$no_sync  = '__return_empty_array';
		$acf_sync = [ 'WP_Syntex\\Polylang_Pro\\Integrations\\ACF\\Dispatcher', 'update' ];
		$had_acf  = has_filter( 'acf/update_value', $acf_sync );
		add_filter( 'pll_copy_post_metas', $no_sync, 999 );
		remove_filter( 'acf/update_value', $acf_sync, 5 );

		$changed = [];
		$skipped = [];

		try {
			foreach ( $pages as $page_id ) {
				$current = (int) get_post_meta( $page_id, 'header_background', true );

				if ( $current === $video_id ) {
					$skipped[] = $page_id . ' (already set)';
					continue;
				}

				// Only replace a video background; leave pages with an image header alone.
				if ( $current && 0 !== strpos( (string) get_post_mime_type( $current ), 'video/' ) ) {
					$skipped[] = $page_id . ' (has an image header)';
					continue;
				}

				update_field( 'header_background', $video_id, $page_id );
				$changed[] = $page_id . ( $current ? ' (was #' . $current . ')' : '' );
			}
		} finally {
			remove_filter( 'pll_copy_post_metas', $no_sync, 999 );

			if ( false !== $had_acf ) {
				add_filter( 'acf/update_value', $acf_sync, 5, 3 );
			}
		}

		if ( function_exists( 'vzo__llms_flush' ) ) {
			vzo__llms_flush();
		}

		return sprintf(
			'Video #%d (poster #%d). Updated home pages: %s. Skipped: %s.',
			$video_id,
			$poster_id,
			$changed ? implode( ', ', $changed ) : 'none',
			$skipped ? implode( ', ', $skipped ) : 'none'
		);
	},
];
