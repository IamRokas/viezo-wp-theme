<?php
/**
 * SEO and GEO (AI search) output that lives in the theme, so it ships with a theme upload.
 *
 * - robots.txt content (served by WordPress once the physical robots.txt is gone, see seeds/seo-server.php)
 * - hreflang x-default
 * - noindex for empty legal pages until they get content
 * - Polish meta description fallback for the case-study archive
 * - Yoast schema: Organization details, Sonora Product, Article on case studies
 *
 * WebP images are handled by the WebP Express plugin, not the theme.
 *
 * llms.txt lives in inc/llms.php. See docs/seo-geo/ for the why.
 *
 * @package Viezo
 */

/**
 * Company facts used by schema and llms.txt. Keep in sync with the footer.
 *
 * @return array
 */
function vzo__seo_company() {
	return [
		'name'        => 'Viezo',
		'legal_name'  => 'Viezo, UAB',
		'url'         => 'https://viezo.lt/',
		'email'       => 'info@viezo.lt',
		'telephone'   => '+370 675 56 247',
		'street'      => 'Lentvario g. 33',
		'city'        => 'Vilnius',
		'postal_code' => '02241',
		'country'     => 'LT',
		'linkedin'    => 'https://www.linkedin.com/company/viezo/',
		'description' => 'Viezo is an industrial technology company in Vilnius, Lithuania. Its product Sonora is a wireless vibration monitoring system for predictive maintenance that detects developing faults in rotating machinery before they cause unplanned downtime.',
	];
}

/**
 * Pages that use the Sonora product template.
 *
 * @return bool
 */
function vzo__seo_is_sonora_page() {
	return is_page() && 'templates/powertrack.php' === get_page_template_slug( get_queried_object_id() );
}

/*
 * robots.txt
 * ---------------------------------------------------------------------------------------------- */

/**
 * Full robots.txt content: everything crawlable (including /wp-content/uploads/ images),
 * AI assistants named explicitly, sitemap and llms.txt pointers.
 *
 * Only applies when WordPress serves robots.txt, i.e. there is no physical robots.txt file.
 *
 * @param string $output Default output.
 * @param bool   $public Whether the site is visible to search engines.
 * @return string
 */
function vzo__robots_txt( $output, $public ) {
	// Keep WordPress' "Disallow: /" on staging copies with "Discourage search engines" on.
	if ( ! $public ) {
		return $output;
	}

	$ai_bots = [
		'GPTBot',
		'OAI-SearchBot',
		'ChatGPT-User',
		'ClaudeBot',
		'Claude-SearchBot',
		'Claude-User',
		'PerplexityBot',
		'Perplexity-User',
		'Google-Extended',
		'Applebot-Extended',
		'CCBot',
	];

	$lines   = [];
	$lines[] = 'User-agent: *';
	$lines[] = 'Disallow: /wp-admin/';
	$lines[] = 'Allow: /wp-admin/admin-ajax.php';
	$lines[] = '';
	$lines[] = '# AI assistants may read and cite this site.';

	foreach ( $ai_bots as $bot ) {
		$lines[] = 'User-agent: ' . $bot;
	}

	$lines[] = 'Allow: /';
	$lines[] = 'Disallow: /wp-admin/';
	$lines[] = '';
	$lines[] = 'Sitemap: ' . home_url( '/sitemap_index.xml' );
	$lines[] = '';
	$lines[] = '# About Viezo for AI assistants: ' . home_url( '/llms.txt' );

	return implode( "\n", $lines ) . "\n";
}
// After Yoast (which appends its own block) so this is the whole file.
add_filter( 'robots_txt', 'vzo__robots_txt', PHP_INT_MAX, 2 );

/*
 * hreflang
 * ---------------------------------------------------------------------------------------------- */

/**
 * Add hreflang="x-default" pointing to the English version.
 *
 * Polylang only adds it on the front page, and not at all when the default language has no
 * URL prefix (our setup).
 *
 * @param array $hreflangs URLs keyed by language code.
 * @return array
 */
function vzo__hreflang_x_default( $hreflangs ) {
	if ( ! isset( $hreflangs['x-default'] ) && ! empty( $hreflangs['en'] ) ) {
		$hreflangs['x-default'] = $hreflangs['en'];
	}

	return $hreflangs;
}
add_filter( 'pll_rel_hreflang_attributes', 'vzo__hreflang_x_default' );

/*
 * Thin pages
 * ---------------------------------------------------------------------------------------------- */

/**
 * Legal pages kept out of the index while they are (almost) empty. Once someone fills them in,
 * they become indexable again without a code change.
 *
 * @return string[] Page slugs (all languages).
 */
function vzo__seo_thin_page_slugs() {
	return [ 'terms-of-use', 'warunki-korzystania-z-serwisu' ];
}

/**
 * Whether a page is one of the thin legal pages and still has (almost) no text.
 *
 * @param WP_Post|int|null $post Post.
 * @return bool
 */
function vzo__seo_is_thin_page( $post ) {
	$post = get_post( $post );

	if ( ! $post || 'page' !== $post->post_type || ! in_array( $post->post_name, vzo__seo_thin_page_slugs(), true ) ) {
		return false;
	}

	return str_word_count( wp_strip_all_tags( $post->post_content ) ) < 100;
}

/**
 * Noindex thin legal pages.
 *
 * @param string $robots Yoast robots value.
 * @return string
 */
function vzo__seo_noindex_thin_pages( $robots ) {
	if ( is_page() && vzo__seo_is_thin_page( get_queried_object() ) ) {
		return 'noindex, follow';
	}

	return $robots;
}
add_filter( 'wpseo_robots', 'vzo__seo_noindex_thin_pages' );

/**
 * Leave thin legal pages out of the XML sitemap.
 *
 * @param int[] $ids Excluded post IDs.
 * @return int[]
 */
function vzo__seo_sitemap_exclude_thin_pages( $ids ) {
	$pages = get_posts(
		[
			'post_type'      => 'page',
			'post_name__in'  => vzo__seo_thin_page_slugs(),
			'posts_per_page' => -1,
			'lang'           => '',
		]
	);

	foreach ( $pages as $page ) {
		if ( vzo__seo_is_thin_page( $page ) ) {
			$ids[] = $page->ID;
		}
	}

	return $ids;
}
add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', 'vzo__seo_sitemap_exclude_thin_pages' );

/*
 * Meta descriptions
 * ---------------------------------------------------------------------------------------------- */

/**
 * Polish description for the case-study archive.
 *
 * Yoast's archive description is a single string, so /pl/studia-przypadkow/ showed the English
 * one. Used only while the Polish string translation is missing (i.e. Yoast returns the English text).
 *
 * @param string $description Meta description.
 * @return string
 */
function vzo__seo_pl_case_study_archive_description( $description ) {
	if ( ! is_post_type_archive( 'case-study' ) || ! function_exists( 'pll_current_language' ) || 'pl' !== pll_current_language() ) {
		return $description;
	}

	$titles  = get_option( 'wpseo_titles', [] );
	$english = $titles['metadesc-ptarchive-case-study'] ?? '';

	if ( '' === $description || $description === $english ) {
		return 'Przykłady monitorowania drgań w przemyśle: jak Sonora wykryła rozwijające się usterki silników, wentylatorów, pomp, przekładni i innych maszyn, zanim doszło do awarii.';
	}

	return $description;
}
add_filter( 'wpseo_metadesc', 'vzo__seo_pl_case_study_archive_description' );
add_filter( 'wpseo_opengraph_desc', 'vzo__seo_pl_case_study_archive_description' );

/*
 * Schema (Yoast graph)
 * ---------------------------------------------------------------------------------------------- */

/**
 * Organization: legal name, address, contacts and what Viezo does, so search engines and AI
 * assistants can tell UAB Viezo (viezo.lt) apart from unrelated companies with similar names.
 *
 * Yoast only outputs the Organization when Yoast → Settings → Site representation has a company
 * name and logo (set by seeds/seo-organization.php).
 *
 * @param array $data Organization schema.
 * @return array
 */
function vzo__schema_organization( $data ) {
	$company = vzo__seo_company();

	$data['legalName']     = $company['legal_name'];
	$data['alternateName'] = 'UAB Viezo';
	$data['description']   = $company['description'];
	$data['email']         = $company['email'];
	$data['telephone']     = $company['telephone'];
	$data['address']       = [
		'@type'           => 'PostalAddress',
		'streetAddress'   => $company['street'],
		'addressLocality' => $company['city'],
		'postalCode'      => $company['postal_code'],
		'addressCountry'  => $company['country'],
	];
	$data['areaServed']    = 'Europe';
	$data['knowsAbout']    = [
		'Vibration monitoring',
		'Predictive maintenance',
		'Condition monitoring',
		'Industrial IoT',
		'Bearing fault detection',
	];

	$same_as         = (array) ( $data['sameAs'] ?? [] );
	$same_as[]       = $company['linkedin'];
	$data['sameAs']  = array_values( array_unique( $same_as ) );

	return $data;
}
add_filter( 'wpseo_schema_organization', 'vzo__schema_organization' );

/**
 * Add a Product piece for Sonora on the Sonora pages (EN and PL).
 *
 * No offers or ratings yet: prices need Viezo's approval (backlog C-14), and ratings must only
 * appear once there are real reviews.
 *
 * @param array                            $graph   Schema graph.
 * @param Yoast\WP\SEO\Context\Meta_Tags_Context $context Yoast context.
 * @return array
 */
function vzo__schema_sonora_product( $graph, $context ) {
	if ( ! vzo__seo_is_sonora_page() ) {
		return $graph;
	}

	$url         = get_permalink( get_queried_object_id() );
	$org_id      = home_url( '/#organization' );
	$description = ( function_exists( 'YoastSEO' ) ? YoastSEO()->meta->for_current_page()->description : '' );

	$product = [
		'@type'        => 'Product',
		'@id'          => $url . '#product',
		'name'         => 'Sonora',
		'alternateName' => 'Sonora wireless vibration monitoring system',
		'description'  => $description ?: 'Sonora is a wireless vibration monitoring system for predictive maintenance of industrial rotating equipment.',
		'url'          => $url,
		'category'     => 'Wireless vibration monitoring system',
		'brand'        => [ '@type' => 'Brand', 'name' => 'Viezo' ],
		'manufacturer' => [ '@id' => $org_id ],
	];

	if ( has_post_thumbnail( get_queried_object_id() ) ) {
		$product['image'] = get_the_post_thumbnail_url( get_queried_object_id(), 'large' );
	}

	$graph[] = $product;

	// Point the WebPage at the product so the relationship is explicit.
	foreach ( $graph as &$piece ) {
		if ( isset( $piece['@type'] ) && 'WebPage' === $piece['@type'] ) {
			$piece['about'] = [ '@id' => $product['@id'] ];
		}
	}
	unset( $piece );

	return $graph;
}
add_filter( 'wpseo_schema_graph', 'vzo__schema_sonora_product', 10, 2 );

/**
 * Case studies get Article schema. Yoast needs author support on the post type for that.
 */
function vzo__seo_case_study_author_support() {
	add_post_type_support( 'case-study', 'author' );
}
add_action( 'init', 'vzo__seo_case_study_author_support', 20 );

/**
 * Article type for case studies (Yoast's default for custom post types is "None").
 *
 * @param string|string[]               $type      Article type.
 * @param Yoast\WP\SEO\Models\Indexable $indexable Indexable.
 * @return string|string[]
 */
function vzo__schema_case_study_article_type( $type, $indexable ) {
	if ( 'case-study' === $indexable->object_sub_type && 'None' === $type ) {
		return 'Article';
	}

	return $type;
}
add_filter( 'wpseo_schema_article_type', 'vzo__schema_case_study_article_type', 10, 2 );

/**
 * Get a case study's key facts (the top_area repeater: Client, Industry, Equipment, …).
 *
 * @param int $post_id Case study ID.
 * @return array Title => text.
 */
function vzo__case_study_facts( $post_id ) {
	$facts = [];
	$rows  = function_exists( 'get_field' ) ? get_field( 'top_area', $post_id ) : [];

	foreach ( (array) $rows as $row ) {
		$title = trim( wp_strip_all_tags( $row['title'] ?? '' ) );
		$text  = trim( wp_strip_all_tags( $row['text'] ?? '' ) );

		if ( '' !== $title && '' !== $text ) {
			$facts[ $title ] = $text;
		}
	}

	return $facts;
}

/**
 * Case-study Article: published by Viezo (not the WordPress user), about vibration monitoring,
 * mentions the client, product and industry.
 *
 * @param array $data Article schema.
 * @return array
 */
function vzo__schema_case_study_article( $data ) {
	if ( ! is_singular( 'case-study' ) ) {
		return $data;
	}

	$post_id = get_queried_object_id();
	$org     = [ '@id' => home_url( '/#organization' ) ];

	$data['author']        = $org;
	$data['articleSection'] = 'Case study';
	$data['about']         = [
		[ '@type' => 'Thing', 'name' => 'Vibration monitoring' ],
		[ '@type' => 'Thing', 'name' => 'Predictive maintenance' ],
	];

	$mentions = [ [ '@type' => 'Product', 'name' => 'Sonora', 'brand' => [ '@type' => 'Brand', 'name' => 'Viezo' ] ] ];

	foreach ( vzo__case_study_facts( $post_id ) as $title => $text ) {
		if ( preg_match( '/^(client|klient)/i', $title ) ) {
			$mentions[] = [ '@type' => 'Organization', 'name' => $text ];
		}
	}

	$terms = get_the_terms( $post_id, 'case-study-type' );

	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$data['about'][] = [ '@type' => 'Thing', 'name' => $term->name ];
		}
	}

	$data['mentions'] = $mentions;

	return $data;
}
add_filter( 'wpseo_schema_article', 'vzo__schema_case_study_article' );

/**
 * No Person piece for the WordPress user on case studies: Viezo is the author.
 *
 * @param array|false $data Author schema.
 * @return array|false
 */
function vzo__schema_case_study_no_person( $data ) {
	return is_singular( 'case-study' ) ? false : $data;
}
add_filter( 'wpseo_schema_author', 'vzo__schema_case_study_no_person' );
