<?php
/**
 * Seed: FAQ block on the Sonora pages (English + Polish).
 *
 * Adds an FAQ block (partials/blocks/faq.php) with the answers Viezo approved on 2026-10-21
 * (docs/seo-geo/04-backlog/client-questions-2026-10.md, question 3) to every page using the
 * Sonora template (templates/powertrack.php), just before the "Case studies" block.
 *
 * Pages that already have an FAQ block are skipped, so re-running never adds a second one.
 * To reseed, delete the FAQ block on the page and run again. Data ownership, integrations and
 * contract terms are not public: don't add them here.
 *
 * @package Viezo
 */

defined( 'ABSPATH' ) || exit;

/**
 * FAQ content per language.
 *
 * @return array
 */
$vzo_sonora_faq = function () {
	return [
		'en' => [
			'title' => 'Frequently asked questions',
			'items' => [
				[
					'How long does installation take, and does it need IT?',
					'<p>Installing a Sonora sensor takes about 1 minute: it is mounted with glue and a magnet, and no IT support is needed. Connecting the gateway may need help from IT, depending on the factory\'s network.</p>',
				],
				[
					'Which machines can Sonora monitor?',
					'<p>Sonora monitors rotating industrial machinery running between 100 and 15,000 RPM, including motors, pumps, compressors, fans, gearboxes, spindles and conveyors.</p><p>Machines outside this range, or with unsuitable mounting conditions, are assessed individually.</p>',
				],
				[
					'How many sensors does a machine need?',
					'<p>Usually 1–2 sensors per machine are enough, typically mounted near the front and rear bearings. The exact number depends on the machine\'s design and which components need monitoring.</p>',
				],
				[
					'Who reviews the data and the alerts?',
					'<p>Sonora uses a semi-automated approach. Algorithms analyse the raw vibration data automatically, Viezo\'s analytics team reviews potential anomalies, and only validated defects are shown in the Sonora dashboard, together with maintenance recommendations.</p>',
				],
				[
					'Which faults can Sonora detect?',
					'<p>Sonora identifies vibration patterns associated with common mechanical faults:</p><ul><li>bearing wear and developing bearing defects</li><li>shaft and coupling misalignment</li><li>mechanical looseness</li><li>imbalance of rotating components</li><li>gearbox and gear defects</li><li>belt and pulley problems</li><li>other abnormal vibration that points to a developing mechanical problem</li></ul><p>What can be detected depends on the machine, sensor placement, operating conditions and the available vibration data.</p>',
				],
				[
					'How long does the sensor battery last?',
					'<p>The sensor is battery powered, with a lifetime of about 5 years. It measures vibration and temperature every hour and sends the data over Bluetooth to a gateway, which is mains powered (220 V) and connects over Bluetooth/4G.</p>',
				],
			],
		],
		'pl' => [
			'title' => 'Najczęściej zadawane pytania',
			'items' => [
				[
					'Ile trwa instalacja i czy potrzebny jest dział IT?',
					'<p>Montaż czujnika Sonora trwa około 1 minuty: mocuje się go klejem i magnesem, bez udziału działu IT. Podłączenie bramki (gateway) może wymagać pomocy IT, w zależności od konfiguracji sieci w zakładzie.</p>',
				],
				[
					'Jakie maszyny może monitorować Sonora?',
					'<p>Sonora monitoruje przemysłowe maszyny wirujące pracujące w zakresie od 100 do 15 000 obr./min, m.in. silniki, pompy, sprężarki, wentylatory, przekładnie, wrzeciona i przenośniki.</p><p>Maszyny spoza tego zakresu lub o nietypowych warunkach montażu oceniamy indywidualnie.</p>',
				],
				[
					'Ile czujników potrzeba na jedną maszynę?',
					'<p>Zwykle wystarczą 1–2 czujniki na maszynę, montowane najczęściej przy przednim i tylnym łożysku. Dokładna liczba zależy od budowy maszyny i monitorowanych podzespołów.</p>',
				],
				[
					'Kto analizuje dane i alerty?',
					'<p>Sonora działa w trybie półautomatycznym. Algorytmy automatycznie analizują surowe dane o drganiach, zespół analityków Viezo weryfikuje potencjalne anomalie, a w panelu Sonora pojawiają się tylko potwierdzone usterki wraz z zaleceniami dla służb utrzymania ruchu.</p>',
				],
				[
					'Jakie usterki wykrywa Sonora?',
					'<p>Sonora rozpoznaje wzorce drgań charakterystyczne dla typowych usterek mechanicznych:</p><ul><li>zużycie łożysk i rozwijające się uszkodzenia łożysk</li><li>niewspółosiowość wałów i sprzęgieł</li><li>luzy mechaniczne</li><li>niewyważenie elementów wirujących</li><li>uszkodzenia przekładni i kół zębatych</li><li>problemy z pasami i kołami pasowymi</li><li>inne nietypowe drgania wskazujące na rozwijający się problem mechaniczny</li></ul><p>Możliwości wykrywania zależą od maszyny, miejsca montażu czujnika, warunków pracy i dostępnych danych o drganiach.</p>',
				],
				[
					'Jak długo działa bateria czujnika?',
					'<p>Czujnik jest zasilany baterią o żywotności około 5 lat. Co godzinę mierzy drgania i temperaturę, a dane przesyła przez Bluetooth do bramki, która jest zasilana z sieci (220 V) i łączy się przez Bluetooth/4G.</p>',
				],
			],
		],
	];
};

return [
	'title'       => 'SEO: FAQ on the Sonora pages',
	'description' => 'Adds an FAQ block (6 questions, English and Polish) before "Case studies" on the Sonora pages. Skips pages that already have an FAQ block.',
	'run'         => function () use ( $vzo_sonora_faq ) {
		$blocks_key = 'field_622ba61b52bfa'; // Blocks → blocks (flexible content).
		$field      = acf_get_field( $blocks_key );
		$layout     = null;

		foreach ( (array) ( $field['layouts'] ?? [] ) as $candidate ) {
			if ( 'faq' === $candidate['name'] ) {
				$layout = $candidate;
			}
		}

		if ( ! $layout ) {
			throw new RuntimeException( 'The FAQ layout is missing from the Blocks field group (acf-json/field-groups/blocks.json).' );
		}

		// Sub-field keys by name, read from the field group so they are never hardcoded.
		$keys = [];

		foreach ( $layout['sub_fields'] as $sub ) {
			$keys[ $sub['name'] ] = $sub['key'];

			foreach ( (array) ( $sub['sub_fields'] ?? [] ) as $child ) {
				$keys[ $sub['name'] . '.' . $child['name'] ] = $child['key'];
			}
		}

		$pages = get_posts(
			[
				'post_type'      => 'page',
				'post_status'    => 'any',
				'posts_per_page' => -1,
				'lang'           => '',
				'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				'meta_value'     => 'templates/powertrack.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			]
		);

		if ( ! $pages ) {
			throw new RuntimeException( 'No page uses the Sonora template (templates/powertrack.php).' );
		}

		$content = $vzo_sonora_faq();
		$no_sync  = '__return_empty_array';
		$acf_sync = [ 'WP_Syntex\\Polylang_Pro\\Integrations\\ACF\\Dispatcher', 'update' ];
		$had_acf  = has_filter( 'acf/update_value', $acf_sync );
		add_filter( 'pll_copy_post_metas', $no_sync, 999 );
		remove_filter( 'acf/update_value', $acf_sync, 5 );

		$report = [];

		try {
			foreach ( $pages as $page ) {
				$lang = function_exists( 'pll_get_post_language' ) ? ( pll_get_post_language( $page->ID ) ?: 'en' ) : 'en';
				$faq  = $content[ $lang ] ?? null;

				if ( ! $faq ) {
					$report[] = sprintf( '#%d (%s): no FAQ text for this language, skipped', $page->ID, $lang );
					continue;
				}

				// Raw (unformatted) rows keep every existing block exactly as stored.
				$rows = (array) get_field( $blocks_key, $page->ID, false );

				if ( in_array( 'faq', wp_list_pluck( $rows, 'acf_fc_layout' ), true ) ) {
					$report[] = sprintf( '#%d (%s): already has an FAQ block, skipped', $page->ID, $lang );
					continue;
				}

				$items = [];

				foreach ( $faq['items'] as $item ) {
					$items[] = [
						$keys['items.question'] => $item[0],
						$keys['items.answer']   => $item[1],
					];
				}

				$row = [
					'acf_fc_layout'  => 'faq',
					$keys['title']    => $faq['title'],
					$keys['subtitle'] => '',
					$keys['items']    => $items,
					$keys['settings'] => [
						$keys['settings.border_top']    => 1,
						$keys['settings.border_bottom'] => 0,
						$keys['settings.schema']        => 1,
					],
				];

				$position = array_search( 'case_studies', wp_list_pluck( $rows, 'acf_fc_layout' ), true );
				$position = false === $position ? count( $rows ) : $position;
				array_splice( $rows, $position, 0, [ $row ] );

				update_field( $blocks_key, $rows, $page->ID );
				$report[] = sprintf( '#%d (%s): FAQ added as block %d', $page->ID, $lang, $position + 1 );
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

		return implode( '. ', $report ) . '.';
	},
];
