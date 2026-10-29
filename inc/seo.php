<?php
/**
 * SEO and GEO (AI search) output that lives in the theme, so it ships with a theme upload.
 *
 * - robots.txt content (served by WordPress once the physical robots.txt is gone, see seeds/seo-server.php)
 * - hreflang x-default
 * - noindex for empty legal pages until they get content
 * - Polish meta description fallback for the case-study archive
 * - Yoast schema: Organization details, Sonora Service (not Product: no prices or reviews), Article on case studies
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
		'legal_name'  => 'UAB Viezo',
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

/**
 * Case-study title in Google: "<title> | Viezo case study" (PL: "| Studium przypadku Viezo").
 *
 * Replaces Yoast's "<title> - Viezo" so results say what the page is. A title set by hand in the
 * Yoast box of a case study still wins.
 *
 * @param string $title Title.
 * @return string
 */
function vzo__seo_case_study_title( $title ) {
	if ( ! is_singular( 'case-study' ) ) {
		return $title;
	}

	$post_id = get_queried_object_id();

	if ( '' !== (string) get_post_meta( $post_id, '_yoast_wpseo_title', true ) ) {
		return $title;
	}

	$suffix = ( function_exists( 'pll_get_post_language' ) && 'pl' === pll_get_post_language( $post_id ) ) ? 'Studium przypadku Viezo' : 'Viezo case study';

	// Raw title: Yoast escapes the output itself, get_the_title() would double-encode apostrophes.
	return wp_strip_all_tags( (string) get_post_field( 'post_title', $post_id ) ) . ' | ' . $suffix;
}
add_filter( 'wpseo_title', 'vzo__seo_case_study_title' );
add_filter( 'wpseo_opengraph_title', 'vzo__seo_case_study_title' );

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
	$data['alternateName'] = 'Viezo, UAB';
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
 * Sonora facts approved by Viezo (2026-10-21): the spec table on the Sonora page plus answers to
 * common buyer questions. Used in llms-full.txt. Prices, client numbers,
 * data ownership, integrations and contract terms are not public: don't add them here.
 *
 * @return array{specs: array<string,string>, facts: string[]}
 */
function vzo__seo_sonora_facts() {
	return [
		'specs' => [
			'Sensor data transfer'          => 'Bluetooth',
			'Sensor power'                  => 'Battery',
			'Sensor lifetime'               => '5 years',
			'Sensor operating temperature'  => '-30 °C to +80 °C',
			'Sensor ingress protection'     => 'IP66',
			'Accelerometer'                 => 'Up to 25 kHz',
			'Measurement frequency'         => 'Hourly',
			'Temperature measurement'       => 'Yes',
			'Sensor installation'           => 'Glue and magnet, about 1 minute',
			'Gateway data transfer'         => 'Bluetooth / 4G',
			'Gateway power'                 => '220 V',
			'Gateway operating temperature' => '-20 °C to +65 °C',
			'Gateway ingress protection'    => 'IP22 (outdoor casing possible)',
			'Machine speed range'           => '100 to 15,000 RPM',
		],
		'facts' => [
			'Installing a Sonora sensor takes about 1 minute and needs no IT support; connecting the gateway may need IT help depending on the factory network.',
			'Sonora monitors rotating industrial machinery between 100 and 15,000 RPM: motors, pumps, compressors, fans, gearboxes, spindles and conveyors. Machines outside this range or with unsuitable mounting conditions are assessed individually.',
			'Typically 1–2 sensors per machine are enough, usually near the front and rear bearings; it depends on the machine and the components monitored.',
			'Analysis is semi-automated: algorithms analyse the raw vibration data automatically, Viezo\'s analytics team reviews potential anomalies, and validated defects appear in the Sonora dashboard with maintenance recommendations.',
			'Sonora identifies vibration patterns of bearing wear and developing bearing defects, shaft and coupling misalignment, mechanical looseness, imbalance of rotating components, gearbox and gear defects, belt and pulley problems, and other abnormal vibration. Detection depends on the machine, sensor placement, operating conditions and available data.',
		],
	];
}

/**
 * URL of the Sonora page in a language (the page using templates/powertrack.php).
 *
 * @param string $lang Polylang language slug; '' for the current/default language.
 * @return string
 */
function vzo__seo_sonora_url( $lang = '' ) {
	static $cache = [];

	if ( isset( $cache[ $lang ] ) ) {
		return $cache[ $lang ];
	}

	$args = [
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'fields'         => 'ids',
		'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		'meta_value'     => 'templates/powertrack.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
	];

	if ( function_exists( 'pll_default_language' ) ) {
		$args['lang'] = $lang ?: pll_default_language();
	}

	$ids = get_posts( $args );

	return $cache[ $lang ] = $ids ? (string) get_permalink( $ids[0] ) : '';
}

/**
 * Sonora as a Service on the Sonora pages (EN and PL).
 *
 * Deliberately not a Product: Google validates every Product item for a product rich result,
 * which requires a price (offers) or reviews. Viezo publishes neither (no prices, no reviews), so
 * Product markup only produced "Either 'offers', 'review' or 'aggregateRating' should be specified"
 * errors in Search Console. Sonora is sensors plus analysis reviewed by Viezo's analysts, which
 * Service describes accurately; the specs stay on the page and in llms-full.txt.
 *
 * @param array $graph Schema graph.
 * @return array
 */
function vzo__schema_sonora_service( $graph ) {
	if ( ! vzo__seo_is_sonora_page() ) {
		return $graph;
	}

	$url         = get_permalink( get_queried_object_id() );
	$description = ( function_exists( 'YoastSEO' ) ? YoastSEO()->meta->for_current_page()->description : '' );

	$service = [
		'@type'         => 'Service',
		'@id'           => $url . '#sonora',
		'name'          => 'Sonora',
		'alternateName' => 'Sonora wireless vibration monitoring system',
		'description'   => $description ?: 'Sonora is a wireless vibration monitoring system for predictive maintenance of industrial rotating equipment.',
		'url'           => $url,
		'serviceType'   => 'Wireless vibration monitoring and predictive maintenance',
		'category'      => 'Condition monitoring',
		'brand'         => [ '@type' => 'Brand', 'name' => 'Viezo' ],
		'provider'      => [ '@id' => home_url( '/#organization' ) ],
		'areaServed'    => 'Europe',
	];

	if ( has_post_thumbnail( get_queried_object_id() ) ) {
		$service['image'] = get_the_post_thumbnail_url( get_queried_object_id(), 'large' );
	}

	$graph[] = $service;

	// Point the WebPage at Sonora so the relationship is explicit.
	foreach ( $graph as &$piece ) {
		if ( isset( $piece['@type'] ) && 'WebPage' === $piece['@type'] ) {
			$piece['about'] = [ '@id' => $service['@id'] ];
		}
	}
	unset( $piece );

	return $graph;
}
add_filter( 'wpseo_schema_graph', 'vzo__schema_sonora_service', 10 );

/**
 * FAQPage piece built from the page's FAQ blocks (partials/blocks/faq.php).
 *
 * Google only shows FAQ rich results for a few authoritative sites, but the markup still tells
 * search engines and AI assistants which question each answer belongs to.
 *
 * @param array $graph Schema graph.
 * @return array
 */
function vzo__schema_faq( $graph ) {
	if ( ! is_singular() || ! function_exists( 'get_field' ) ) {
		return $graph;
	}

	$questions = [];

	foreach ( (array) get_field( 'blocks', get_queried_object_id() ) as $block ) {
		if ( 'faq' !== ( $block['acf_fc_layout'] ?? '' ) || empty( $block['items'] ) ) {
			continue;
		}

		if ( isset( $block['settings']['schema'] ) && ! $block['settings']['schema'] ) {
			continue;
		}

		foreach ( (array) $block['items'] as $item ) {
			$question = trim( wp_strip_all_tags( $item['question'] ?? '' ) );
			$answer   = trim( wp_kses( $item['answer'] ?? '', [ 'p' => [], 'br' => [], 'ul' => [], 'ol' => [], 'li' => [], 'strong' => [], 'em' => [], 'a' => [ 'href' => [] ] ] ) );

			if ( '' !== $question && '' !== $answer ) {
				$questions[] = [
					'@type'          => 'Question',
					'name'           => $question,
					'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $answer ],
				];
			}
		}
	}

	if ( ! $questions ) {
		return $graph;
	}

	$url     = get_permalink( get_queried_object_id() );
	$graph[] = [
		'@type'      => 'FAQPage',
		'@id'        => $url . '#faq',
		'url'        => $url,
		'isPartOf'   => [ '@id' => $url ],
		'mainEntity' => $questions,
	];

	return $graph;
}
add_filter( 'wpseo_schema_graph', 'vzo__schema_faq', 20 );

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
 * @param int  $post_id        Case study ID.
 * @param bool $include_client Whether to include the Client row.
 * @return array Title => text.
 */
function vzo__case_study_facts( $post_id, $include_client = true ) {
	$facts = [];
	$rows  = function_exists( 'get_field' ) ? get_field( 'top_area', $post_id ) : [];

	foreach ( (array) $rows as $row ) {
		$title = trim( wp_strip_all_tags( $row['title'] ?? '' ) );
		$text  = trim( wp_strip_all_tags( $row['text'] ?? '' ) );

		if ( ! $include_client && preg_match( '/^(client|klient)/i', $title ) ) {
			continue;
		}

		if ( '' !== $title && '' !== $text ) {
			$facts[ $title ] = $text;
		}
	}

	return $facts;
}

/**
 * Case-study Article: published by Viezo (not the WordPress user), about vibration monitoring and
 * the industry, mentions Sonora.
 *
 * Client names are deliberately not added: Viezo may show them on the page but doesn't want to
 * amplify them (decision 2026-10-21).
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

	// A reference to the Sonora Service (not an inline Product: see vzo__schema_sonora_service()).
	$lang       = function_exists( 'pll_get_post_language' ) ? (string) pll_get_post_language( $post_id ) : '';
	$sonora_url = vzo__seo_sonora_url( $lang );
	$mentions   = [ array_filter( [ '@type' => 'Service', '@id' => $sonora_url ? $sonora_url . '#sonora' : '', 'name' => 'Sonora' ] ) ];

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
