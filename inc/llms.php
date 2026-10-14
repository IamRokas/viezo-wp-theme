<?php
/**
 * /llms.txt and /llms-full.txt: a plain-text summary of Viezo for AI assistants (llmstxt.org).
 *
 * Generated from the site's own content (pages, Yoast descriptions, case studies), so it stays
 * current without editing. Cached; the cache is cleared whenever a post is saved.
 *
 * llms.txt       Summary, key pages (EN + PL) and every case study with a one-line summary.
 * llms-full.txt  The same plus entity facts and the full text of every case study.
 *
 * @package Viezo
 */

const VZO_LLMS_CACHE_KEY = 'vzo__llms_txt_v1';

/**
 * Serve /llms.txt and /llms-full.txt before WordPress builds a query (no rewrite rules to flush).
 */
function vzo__llms_serve() {
	$path = wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput

	$home_path = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH );
	$path      = '/' . ltrim( substr( (string) $path, strlen( rtrim( $home_path, '/' ) ) ), '/' );

	if ( '/llms.txt' !== $path && '/llms-full.txt' !== $path ) {
		return;
	}

	$full = '/llms-full.txt' === $path;
	$text = vzo__llms_text( $full );

	status_header( 200 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	header( 'X-Robots-Tag: noindex' );
	header( 'Cache-Control: public, max-age=3600' );
	echo $text; // phpcs:ignore WordPress.Security.EscapeOutput -- plain text.
	exit;
}
add_action( 'parse_request', 'vzo__llms_serve', 0 );

/**
 * Clear the cache when content changes.
 */
function vzo__llms_flush() {
	delete_transient( VZO_LLMS_CACHE_KEY . '_short' );
	delete_transient( VZO_LLMS_CACHE_KEY . '_full' );
}
add_action( 'save_post', 'vzo__llms_flush' );
add_action( 'deleted_post', 'vzo__llms_flush' );
add_action( 'switch_theme', 'vzo__llms_flush' );

/**
 * Build (or read cached) llms text.
 *
 * @param bool $full Whether to build llms-full.txt.
 * @return string
 */
function vzo__llms_text( $full = false ) {
	$key    = VZO_LLMS_CACHE_KEY . ( $full ? '_full' : '_short' );
	$cached = get_transient( $key );

	if ( is_string( $cached ) && '' !== $cached ) {
		return $cached;
	}

	$text = vzo__llms_build( $full );
	set_transient( $key, $text, DAY_IN_SECONDS );

	return $text;
}

/**
 * Meta description for a post (Yoast, falling back to the excerpt).
 *
 * @param int $post_id Post ID.
 * @return string
 */
function vzo__llms_description( $post_id ) {
	$description = '';

	if ( function_exists( 'YoastSEO' ) ) {
		$meta        = YoastSEO()->meta->for_post( $post_id );
		$description = $meta ? (string) $meta->description : '';
	}

	if ( '' === $description ) {
		$description = wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post_id ) ), 30, '…' );
	}

	return trim( preg_replace( '/\s+/', ' ', $description ) );
}

/**
 * Published pages worth listing, in one language, skipping noindexed and thin pages.
 *
 * @param string $lang Polylang language slug.
 * @return WP_Post[]
 */
function vzo__llms_pages( $lang ) {
	$args = [
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'has_password'   => false,
	];

	if ( function_exists( 'pll_languages_list' ) ) {
		$args['lang'] = $lang;
	}

	$pages = [];

	foreach ( get_posts( $args ) as $page ) {
		if ( vzo__seo_is_thin_page( $page ) ) {
			continue;
		}

		if ( '1' === get_post_meta( $page->ID, '_yoast_wpseo_meta-robots-noindex', true ) ) {
			continue;
		}

		$pages[] = $page;
	}

	return $pages;
}

/**
 * Published case studies in one language, newest first.
 *
 * @param string $lang Polylang language slug.
 * @return WP_Post[]
 */
function vzo__llms_case_studies( $lang ) {
	$args = [
		'post_type'      => 'case-study',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	];

	if ( function_exists( 'pll_languages_list' ) ) {
		$args['lang'] = $lang;
	}

	return get_posts( $args );
}

/**
 * One Markdown list line: "- [Title](url): description".
 *
 * @param WP_Post $post Post.
 * @return string
 */
function vzo__llms_line( $post ) {
	$title       = trim( wp_strip_all_tags( get_the_title( $post ) ) );
	$description = vzo__llms_description( $post->ID );

	return '- [' . $title . '](' . get_permalink( $post ) . ')' . ( $description ? ': ' . $description : '' );
}

/**
 * Full plain text of a case study: key facts, sections and content.
 *
 * @param WP_Post $post Case study.
 * @return string
 */
function vzo__llms_case_study_text( $post ) {
	$out = [];

	foreach ( vzo__case_study_facts( $post->ID ) as $title => $text ) {
		$out[] = '- ' . $title . ': ' . $text;
	}

	$sections = function_exists( 'get_field' ) ? (array) get_field( 'bottom_area', $post->ID ) : [];

	foreach ( $sections as $section ) {
		$title = trim( wp_strip_all_tags( $section['title'] ?? '' ) );
		$text  = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $section['text'] ?? '' ) ) );

		if ( '' !== $text ) {
			$out[] = '';
			$out[] = ( $title ? '#### ' . $title . "\n\n" : '' ) . $text;
		}
	}

	$content = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( strip_shortcodes( $post->post_content ) ) ) );

	if ( '' !== $content ) {
		$out[] = '';
		$out[] = $content;
	}

	return implode( "\n", $out );
}

/**
 * Build llms.txt / llms-full.txt.
 *
 * @param bool $full Whether to include entity facts and full case-study text.
 * @return string
 */
function vzo__llms_build( $full ) {
	$company = vzo__seo_company();
	$langs   = function_exists( 'pll_languages_list' ) ? pll_languages_list() : [ 'en' ];
	$default = function_exists( 'pll_default_language' ) ? pll_default_language() : 'en';
	$names   = [ 'en' => 'English', 'pl' => 'Polski' ];
	$l       = [];

	$l[] = '# Viezo';
	$l[] = '';
	$l[] = '> ' . $company['description'];
	$l[] = '';
	$l[] = sprintf(
		'%1$s (%2$s) is based at %3$s, %4$s %5$s, Lithuania. Website: %6$s (English and Polish). Contact: %7$s, %8$s.',
		$company['name'],
		$company['legal_name'],
		$company['street'],
		$company['postal_code'],
		$company['city'],
		home_url( '/' ),
		$company['email'],
		$company['telephone']
	);
	$l[] = '';
	$l[] = 'Viezo (viezo.lt) is not related to the website viezo.com or to other companies with similar names, such as Viezo Global Pvt Ltd or Viezo appliances.';

	if ( $full ) {
		$l[] = '';
		$l[] = '## Key facts';
		$l[] = '';
		$l[] = '- Company: ' . $company['legal_name'] . ', Vilnius, Lithuania. Brand name: Viezo.';
		$l[] = '- Product: Sonora, a wireless vibration monitoring system for predictive maintenance.';
		$l[] = '- How it works: wireless sensors mounted on rotating machinery (motors, fans, pumps, gearboxes and similar) send vibration data to the Sonora platform, which detects developing mechanical faults such as bearing wear, imbalance, misalignment and gear damage and alerts the maintenance team before a breakdown.';
		$l[] = '- Proof: ' . count( vzo__llms_case_studies( $default ) ) . ' published case studies from industrial sites, listed below with named clients where the client agreed.';
		$l[] = '- Pricing: a public setup builder on the pricing page gives a preliminary estimate for a Sonora setup.';
		$l[] = '- Markets: industrial plants in Europe, with content in English and Polish.';
		$l[] = '- LinkedIn: ' . $company['linkedin'];
	}

	foreach ( $langs as $lang ) {
		$pages = vzo__llms_pages( $lang );
		$cases = vzo__llms_case_studies( $lang );
		$label = $names[ $lang ] ?? strtoupper( $lang );

		if ( $lang === $default ) {
			$l[] = '';
			$l[] = '## Pages';
		} else {
			$l[] = '';
			$l[] = '## Pages (' . $label . ')';
		}

		$l[] = '';

		foreach ( $pages as $page ) {
			$l[] = vzo__llms_line( $page );
		}

		$archive = vzo__llms_archive_url( $lang );

		$l[] = '';
		$l[] = '## Case studies' . ( $lang === $default ? '' : ' (' . $label . ')' );
		$l[] = '';
		$l[] = 'All case studies: ' . $archive;
		$l[] = '';

		foreach ( $cases as $case ) {
			if ( $full ) {
				$l[] = '### [' . trim( wp_strip_all_tags( get_the_title( $case ) ) ) . '](' . get_permalink( $case ) . ')';
				$l[] = '';
				$l[] = vzo__llms_case_study_text( $case );
				$l[] = '';
			} else {
				$l[] = vzo__llms_line( $case );
			}
		}
	}

	if ( ! $full ) {
		$l[] = '';
		$l[] = '## Optional';
		$l[] = '';
		$l[] = '- [llms-full.txt](' . home_url( '/llms-full.txt' ) . '): key facts and the full text of every case study';
		$l[] = '- [Sitemap](' . home_url( '/sitemap_index.xml' ) . ')';
	}

	return implode( "\n", $l ) . "\n";
}

/**
 * Case-study archive URL in a language (Polylang translates the post type slug).
 *
 * @param string $lang Language slug.
 * @return string
 */
function vzo__llms_archive_url( $lang ) {
	if ( ! function_exists( 'PLL' ) || empty( PLL()->model ) ) {
		return (string) get_post_type_archive_link( 'case-study' );
	}

	$language = PLL()->model->get_language( $lang );

	if ( ! $language ) {
		return (string) get_post_type_archive_link( 'case-study' );
	}

	// Archive links (and Polylang Pro's translated slugs) follow the current language.
	$previous       = PLL()->curlang;
	PLL()->curlang  = $language;
	$url            = (string) get_post_type_archive_link( 'case-study' );
	PLL()->curlang  = $previous;

	return $url;
}
