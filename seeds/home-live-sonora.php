<?php
/**
 * Seed: "Live Sonora network" section on the Home page (English + Polish).
 *
 * Only fills empty fields, so it never overwrites edits. On the Polish page a value identical
 * to the English one counts as empty (an untranslated copy). To reseed a field, empty it first.
 *
 * The photo, point positions and values live on the English page only: the Polish page gets
 * the texts (see inc/live-sonora.php).
 *
 * @package Viezo
 */

defined( 'ABSPATH' ) || exit;

return [
	'title'       => 'Home page: Live Sonora network',
	'description' => 'Fills empty Live Sonora fields on the English and Polish Home pages: texts, buttons, machine scene (photo from seeds/assets/home/, 3 measuring points, the gearbox develops a fault), machines linked to case studies.',
	'run'         => function () {
		$en_id = vzo__seed_find_page_by_template( 'templates/home.php' );

		if ( ! $en_id ) {
			throw new RuntimeException( 'No page uses the Home template.' );
		}

		$pl_id = function_exists( 'pll_get_post' ) ? (int) pll_get_post( $en_id, 'pl' ) : 0;

		// Post (case study / page) in a language, falling back to the original.
		$in_lang = function ( $id, $lang ) {
			return $id && function_exists( 'pll_get_post' ) ? ( pll_get_post( $id, $lang ) ?: $id ) : $id;
		};

		$case_id = function ( $slug, $lang ) use ( $in_lang ) {
			$post = get_page_by_path( $slug, OBJECT, 'case-study' );

			return $post ? $in_lang( $post->ID, $lang ) : '';
		};

		$link = function ( $url, $title ) {
			return $url ? [ 'url' => $url, 'title' => $title, 'target' => '' ] : '';
		};

		// Case study archive URL in a language (with Polylang's translated slug, e.g. /pl/studia-przypadkow/).
		$archive = function ( $lang ) {
			if ( ! function_exists( 'PLL' ) || ! PLL()->model->get_language( $lang ) ) {
				return get_post_type_archive_link( 'case-study' );
			}

			$previous      = PLL()->curlang;
			PLL()->curlang = PLL()->model->get_language( $lang );
			$url           = get_post_type_archive_link( 'case-study' );
			PLL()->curlang = $previous;

			return $url;
		};

		$sonora_id = vzo__seed_find_page_by_template( 'templates/powertrack.php' );

		$content = [
			'en' => [
				'eyebrow'           => 'Live Sonora network',
				'title'             => 'This is happening right now.',
				'text'              => 'Across industrial sites, Sonora is continuously monitoring machinery and identifying developing defects through vibration data.',
				'primary_link'      => $link( $sonora_id ? get_permalink( $sonora_id ) : '', 'See how Sonora works' ),
				'secondary_link'    => $link( $archive( 'en' ), 'Explore real cases' ),
				'panel_title'       => 'Sonora / Live',
				'panel_status'      => 'Monitoring continuously',
				'label_rms'         => 'RMS (velocity)',
				'label_temperature' => 'Ambient temperature',
				'label_harmonics'   => 'New harmonics detected',
				'label_last'        => 'Last measurement',
				'status_ok'         => 'Operating normally',
				'status_fault'      => 'Active defect',
				'label_issue'       => 'Detected issue',
				'label_yes_no'      => 'Yes|No',
				'points'            => [
					[ 'name' => 'Electric motor', 'last_measurement' => '18 min ago' ],
					[ 'name' => 'Gearbox', 'last_measurement' => 'just now', 'fault_issue' => 'Developing gearbox fault', 'fault_link_label' => 'View defect' ],
					[ 'name' => 'Process fan', 'last_measurement' => '12 min ago' ],
				],
				'machines_label'    => 'Machines we monitor',
				'machines_subtitle' => 'Real examples from Sonora cases',
				'machines_link'     => $link( $archive( 'en' ), 'All cases' ),
				'machines'          => [
					[ 'name' => 'Bosch Rexroth H14', 'type' => 'Pump' ],
					[ 'name' => 'Fan motor', 'type' => 'Fan system' ],
					[ 'name' => 'Conveyor drive', 'type' => 'Gearbox' ],
					[ 'name' => 'Diamond cutter', 'type' => 'Motor' ],
				],
			],
			'pl' => [
				'eyebrow'           => 'Sieć Sonora na żywo',
				'title'             => 'To dzieje się właśnie teraz.',
				'text'              => 'W zakładach przemysłowych Sonora nieustannie monitoruje maszyny i wykrywa rozwijające się usterki na podstawie danych o drganiach.',
				'primary_link'      => $link( $sonora_id ? get_permalink( $in_lang( $sonora_id, 'pl' ) ) : '', 'Zobacz, jak działa Sonora' ),
				'secondary_link'    => $link( $archive( 'pl' ), 'Poznaj prawdziwe przypadki' ),
				'panel_title'       => 'Sonora / Live',
				'panel_status'      => 'Ciągły monitoring',
				'label_rms'         => 'RMS (prędkość)',
				'label_temperature' => 'Temperatura otoczenia',
				'label_harmonics'   => 'Nowe harmoniczne',
				'label_last'        => 'Ostatni pomiar',
				'status_ok'         => 'Praca normalna',
				'status_fault'      => 'Aktywna usterka',
				'label_issue'       => 'Wykryty problem',
				'label_yes_no'      => 'Tak|Nie',
				'points'            => [
					[ 'name' => 'Silnik elektryczny', 'last_measurement' => '18 min temu' ],
					[ 'name' => 'Przekładnia', 'last_measurement' => 'przed chwilą', 'fault_issue' => 'Rozwijająca się usterka przekładni', 'fault_link_label' => 'Zobacz usterkę' ],
					[ 'name' => 'Wentylator procesowy', 'last_measurement' => '12 min temu' ],
				],
				'machines_label'    => 'Maszyny, które monitorujemy',
				'machines_subtitle' => 'Prawdziwe przykłady z wdrożeń Sonora',
				'machines_link'     => $link( $archive( 'pl' ), 'Wszystkie przypadki' ),
				'machines'          => [
					[ 'name' => 'Bosch Rexroth H14', 'type' => 'Pompa' ],
					[ 'name' => 'Silnik wentylatora', 'type' => 'Układ wentylacji' ],
					[ 'name' => 'Napęd przenośnika', 'type' => 'Przekładnia' ],
					[ 'name' => 'Frez diamentowy', 'type' => 'Silnik' ],
				],
			],
		];

		// Language-independent parts of the repeaters (merged into each language's rows).
		$points_shared = [
			[ 'x' => 10.1, 'y' => 54, 'rms' => 2.3, 'temperature' => 34, 'harmonics' => 0, 'fault' => 0 ],
			[ 'x' => 36.3, 'y' => 55, 'rms' => 2.4, 'temperature' => 35, 'harmonics' => 0, 'fault' => 1, 'fault_rms' => 6.3, 'fault_temperature' => 48, 'case' => 'gear-fault-detection' ],
			[ 'x' => 67.8, 'y' => 41.7, 'rms' => 1.3, 'temperature' => 30, 'harmonics' => 0, 'fault' => 0 ],
		];
		$machines_shared = [
			[ 'icon' => 'pump', 'case' => 'pump-failure' ],
			[ 'icon' => 'fan', 'case' => 'fan-fault' ],
			[ 'icon' => 'gearbox', 'case' => 'gear-fault-detection' ],
			[ 'icon' => 'motor', 'case' => 'diamond-cutter-fault' ],
		];

		// Write each page on its own: stop Polylang from copying these meta writes to the other
		// translation (its custom-field sync ignores the per-field ACF settings for scripted writes).
		$no_sync  = '__return_empty_array';
		$acf_sync = [ 'WP_Syntex\\Polylang_Pro\\Integrations\\ACF\\Dispatcher', 'update' ];
		$had_acf  = has_filter( 'acf/update_value', $acf_sync );
		add_filter( 'pll_copy_post_metas', $no_sync, 999 );
		remove_filter( 'acf/update_value', $acf_sync, 5 );

		// Fill only empty fields. On a translation, a value identical to English counts as empty.
		$filled = [];
		$fill   = function ( $name, $value, $page_id, $lang ) use ( $en_id, &$filled ) {
			$key     = 'field_live_sonora_' . $name;
			$current = get_field( $key, $page_id, false );
			$empty   = null === $current || '' === $current || false === $current || [] === $current;

			// Same as English = untranslated copy, unless the translation is meant to be identical.
			// Repeaters compare their row names only (other sub fields may differ, e.g. empty links).
			$english = get_field( $key, $en_id, false );
			$names   = function ( $rows ) {
				return is_array( $rows ) ? array_map(
					function ( $row ) {
						return is_array( $row ) ? (string) ( $row['field_live_sonora_point_name'] ?? $row['field_live_sonora_machine_name'] ?? $row['name'] ?? '' ) : '';
					},
					array_values( $rows )
				) : $rows;
			};

			if ( ! $empty && 'en' !== $lang && ( $current == $english || ( is_array( $current ) && $names( $current ) === $names( $english ) ) ) ) { // phpcs:ignore Universal.Operators.StrictComparisons -- rows arrays.
				$empty = $names( $current ) !== $names( $value );
			}

			if ( $empty && '' !== $value && [] !== $value ) {
				update_field( $key, $value, $page_id );
				$filled[ $lang ] = ( $filled[ $lang ] ?? 0 ) + 1;
			}
		};

		$pages    = array_filter( [ 'en' => $en_id, 'pl' => $pl_id ] );
		$warnings = [];

		try {
			foreach ( $pages as $lang => $page_id ) {
				$values = $content[ $lang ];

				$values['points'] = array_map(
					function ( $texts, $shared ) use ( $case_id, $lang ) {
						$row = array_merge( $shared, $texts );

						if ( isset( $row['case'] ) ) {
							$row['fault_case_study'] = $case_id( $row['case'], $lang );
							unset( $row['case'] );
						}

						return $row;
					},
					$values['points'],
					$points_shared
				);

				$values['machines'] = array_map(
					function ( $texts, $shared ) use ( $case_id, $lang ) {
						return array_merge( $texts, [ 'icon' => $shared['icon'], 'case_study' => $case_id( $shared['case'], $lang ) ] );
					},
					$values['machines'],
					$machines_shared
				);

				if ( 'en' === $lang ) {
					$values['hidden'] = 0;

					// A failed image import must not stop the rest of the seed.
					try {
						$values['scene_image'] = vzo__seed_import_image( 'home/machine-line.webp' ) ?: '';
					} catch ( RuntimeException $e ) {
						$values['scene_image'] = '';
						$warnings[]            = rtrim( $e->getMessage(), '.' ) . '. The page shows the bundled default photo until one is chosen';
					}
				}

				foreach ( $values as $name => $value ) {
					$fill( $name, $value, $page_id, $lang );
				}
			}
		} finally {
			remove_filter( 'pll_copy_post_metas', $no_sync, 999 );

			if ( $had_acf ) {
				add_filter( 'acf/update_value', $acf_sync, 5, 3 );
			}
		}

		$log = [];

		foreach ( $pages as $lang => $page_id ) {
			$log[] = sprintf( '%s "%s": %d fields filled', strtoupper( $lang ), get_the_title( $page_id ), $filled[ $lang ] ?? 0 );
		}

		if ( ! $pl_id ) {
			$log[] = 'no Polish translation of the Home page';
		}

		return implode( '; ', array_merge( $log, $warnings ) ) . '.';
	},
];
