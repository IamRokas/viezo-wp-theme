<?php
/**
 * Seed: Pricing setup builder (English + Polish).
 *
 * - Creates the lead forms "Pricing setup offer (EN)" and "(PL)" in WPForms. Existing forms
 *   are kept as they are; only missing hidden fields are added (and the old single form
 *   "Pricing setup offer" is renamed to the EN one, keeping its entries).
 * - Switches the Pricing page and its Polish translation to the Setup builder template and
 *   points the header button at the builder.
 * - Fills the "Pricing: Setup builder" fields on both pages. Only EMPTY fields are filled,
 *   so re-running never overwrites reviewed copy. Empty a field (or a whole list) to reseed it.
 *
 * Hidden field IDs must match vzo__setup_builder_form_fields() in inc/setup-builder.php.
 *
 * @package Viezo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Polish content. Option keys, icons and case-study slugs come from the English defaults.
 *
 * @return array
 */
$vzo_setup_polish = function () {
	return [
		'texts'   => [
			'eyebrow'            => 'Konfigurator Sonora',
			'step_label'         => 'Krok {current} z {total}',
			'next_label'         => 'Dalej',
			'back_label'         => 'Wstecz',
			'industry_title'     => 'Co produkuje Twoja firma?',
			'industry_subtitle'  => 'Wybierz branżę, która najlepiej opisuje Twoją produkcję.',
			'industry_summary'   => 'Branża',
			'equipment_title'    => 'Jakie urządzenia chcesz monitorować?',
			'equipment_subtitle' => 'Zaznacz wszystkie pasujące.',
			'equipment_summary'  => 'Urządzenia',
			'challenge_title'    => 'Jakie jest Twoje główne wyzwanie w utrzymaniu ruchu?',
			'challenge_subtitle' => 'Wybierz największe wyzwanie Twojego zespołu.',
			'challenge_summary'  => 'Główne wyzwanie',
			'machines_title'     => 'Ile maszyn chcesz monitorować?',
			'machines_subtitle'  => 'Wybierz przybliżoną liczbę. Możesz ją później zmienić.',
			'machines_unit'      => 'maszyn / punktów pomiarowych',
			'machines_summary'   => 'Maszyny / punkty pomiarowe',
			'machines_note'      => 'Średnio jedna bramka obsługuje do {sensors} czujników. Zaproponujemy optymalną konfigurację dla Twojego zakładu.',
			'show_result_label'  => 'Pokaż mój wynik',
			'result_counter'     => 'Twoja konfiguracja',
			'result_title'       => 'Twoja konfiguracja Sonora',
			'result_subtitle'    => 'Na podstawie Twoich odpowiedzi przygotowaliśmy szacunkową konfigurację dla Twojego zakładu oraz prawdziwy przykład z podobnego środowiska.',
			'points_label'       => 'punktów pomiarowych',
			'gateways_label'     => 'bramek',
			'case_eyebrow'       => 'Prawdziwy przypadek z podobnego środowiska',
			'detected_label'     => 'Wykryto',
			'outcome_label'      => 'Efekt',
			'case_link_label'    => 'Zobacz pełne studium przypadku',
			'cta_title'          => 'Chcesz poznać dokładną cenę tej konfiguracji?',
			'cta_text'           => 'Otrzymaj indywidualną ofertę od naszego zespołu.',
			'cta_button'         => 'Otrzymaj ofertę',
			'offer_counter'      => 'Ostatni krok',
			'offer_eyebrow'      => 'Otrzymaj ofertę',
			'offer_title'        => 'Prawie gotowe!',
			'offer_subtitle'     => 'Zostaw swoje dane, a wrócimy do Ciebie z ofertą dopasowaną do Twojej konfiguracji. Bez zobowiązań – po prostu rozmowa.',
			'privacy_note'       => 'Wykorzystamy Twoje dane wyłącznie do kontaktu w sprawie Sonora.',
			'summary_title'      => 'Podsumowanie konfiguracji',
			'edit_label'         => 'Edytuj',
			'estimate_label'     => 'Szacunkowa konfiguracja',
			'summary_case_label' => 'Powiązane studium przypadku',
			'summary_case_link'  => 'Zobacz studium przypadku',
			'email_subject'       => vzo__setup_builder_email_defaults( 'pl' )['subject'],
			'email_summary_title' => vzo__setup_builder_email_defaults( 'pl' )['summary_title'],
			'email_body'          => vzo__setup_builder_email_defaults( 'pl' )['body'],
			'email_footer'        => vzo__setup_builder_email_defaults( 'pl' )['footer'],
		],
		// Option key => label.
		'options' => [
			'industry'  => [
				'furniture'  => 'Meble i drewno',
				'food'       => 'Żywność i napoje',
				'packaging'  => 'Opakowania',
				'automotive' => 'Motoryzacja',
				'metal'      => 'Obróbka metali',
				'other'      => 'Inna produkcja',
			],
			'equipment' => [
				'motors'      => 'Silniki',
				'fans'        => 'Wentylatory',
				'pumps'       => 'Pompy',
				'gearboxes'   => 'Przekładnie',
				'compressors' => 'Sprężarki',
				'spindles'    => 'Wrzeciona i frezy',
			],
			'challenge' => [
				'manual'     => 'Zbyt częsty ręczny pomiar drgań',
				'unexpected' => 'Nieoczekiwane awarie',
				'downtime'   => 'Kosztowne przestoje',
				'staff'      => 'Za mało personelu utrzymania ruchu',
				'lifetime'   => 'Zbyt krótka żywotność maszyn',
				'other'      => 'Inne',
			],
		],
		// English case-study slug => [ tag, machine, detected, outcome ].
		'cases'   => [
			'bearing-fault'                    => [ 'Branża meblarska', 'Urządzenie do zaokrąglania narożników IMA KFA', 'Rozwijające się zużycie łożyska, zanim pojawiły się widoczne lub słyszalne objawy', 'Służby utrzymania ruchu zareagowały na czas, unikając nieplanowanego postoju i uszkodzenia sąsiednich elementów' ],
			'pump-failure'                     => [ 'Branża opakowaniowa', 'Pompa Bosch Rexroth H14', 'Narastająca niewspółosiowość wału w pompie tłoczącej 2 tony oleju', 'Zaplanowana wymiana zapobiegła zanieczyszczeniu układu i dwutygodniowemu postojowi, oszczędzając ponad 46 000 €' ],
			'circulation-pump-bearing-failure' => [ 'Materiały budowlane', 'Pompa obiegowa', 'Niewspółosiowość wału i początkowe zużycie łożysk', 'Degradacja łożyska potwierdzona i usunięta przed katastrofalną awarią' ],
			'fan-fault'                        => [ 'Branża meblarska', 'Wentylator przemysłowy', 'Gwałtowny wzrost poziomu drgań wskazujący na uszkodzenie wirnika', 'Wentylator wymieniony w kontrolowany sposób, zanim wirnik uległ krytycznemu uszkodzeniu' ],
			'exhaust-fan-motor-bearing-fault'  => [ 'Branża meblarska', 'Wentylator wyciągowy instalacji odciągowej', 'Nietypowy poziom hałasu; okazało się, że wirnik ociera o obudowę', 'Planowa konserwacja zamiast awarii instalacji odciągowej' ],
			'blower-bearing-wear'              => [ 'Obróbka metali', 'Dmuchawa wtrysku powietrza', 'Rozwijające się zużycie łożysk (zużyte gniazda łożysk)', 'Silnik wymieniony planowo, zanim problem się nasilił' ],
			'kekava-ammonia-compressor-fault'  => [ 'Branża spożywcza', 'Sprężarka amoniaku', 'Problem z łożyskiem silnika sprężarki wykryty w dniu montażu czujników', 'Konserwacja wykonana, zanim łożysko osiągnęło stan krytyczny' ],
			'gear-fault-detection'             => [ 'Branża meblarska', 'Przekładnia śluzy w systemie odcinania', 'Usterka przekładni 10 dni po instalacji, przy pozostałych 2–4 tygodniach żywotności', 'Naprawa w niedzielę w 4 godziny pozwoliła uniknąć ok. 3 000 € kosztów przestoju' ],
			'spindle-imbalance'                => [ 'Branża meblarska', 'Wrzeciono wiertarki, 13 kW', 'Niewyważenie narzędzia jako przyczyna powtarzających się awarii łożysk wrzeciona', 'Usunięto przyczynę źródłową, unikając ok. 7 500 € za każdą wymianę wrzeciona' ],
			'diamond-cutter-fault'             => [ 'Branża meblarska', 'Frez diamentowy', 'Niewyważenie wału potwierdzone podczas inspekcji', 'Narzędzie wymienione podczas planowej konserwacji, bez zatrzymania linii pracującej 24/7' ],
			'planer-bearing-fault'             => [ 'Branża meblarska', 'Strugarka sześciogłowicowa', 'Początkowe zużycie łożyska głowicy strugarki', 'Naprawa zaplanowana poza godzinami pracy, co pozwoliło uniknąć ok. 1 200 € kosztów przestoju' ],
			'shredder-failure'                 => [ 'Branża meblarska', 'Rozdrabniacz', 'Gwałtowny wzrost drgań ujawniający wielowarstwową usterkę', 'Przyczyny źródłowe ustalone krok po kroku, a rozdrabniacz w pełni ustabilizowany' ],
			'shredder-engine-fault'            => [ 'Branża meblarska', 'Wał rozdrabniacza', 'Zużycie lub niewyważenie narzędzia na wale', 'Naprawa podczas planowej konserwacji na linii pracującej 24/7' ],
		],
		'header'  => [
			'header_title'       => 'Ile kosztowałaby Sonora w Twoim zakładzie?',
			'header_button'      => 'Zbuduj moją konfigurację',
			'header_button_note' => 'Zajmuje mniej niż minutę',
		],
		'form'    => [
			'name'         => [ 'Imię i nazwisko', 'Twoje imię i nazwisko' ],
			'company'      => [ 'Firma', 'Nazwa firmy' ],
			'email'        => [ 'Służbowy e-mail', 'ty@firma.pl' ],
			'phone'        => [ 'Telefon (opcjonalnie)', '+48 123 456 789' ],
			'submit'       => 'Otrzymaj indywidualną ofertę →',
			'processing'   => 'Wysyłanie...',
			'subject'      => 'Zapytanie o konfigurację (PL): {field_id="2"}',
			'confirmation' => '<p><strong>Dziękujemy!</strong> Otrzymaliśmy Twoją konfigurację i wkrótce wrócimy do Ciebie z indywidualną ofertą.</p>',
		],
	];
};

return [
	'title'       => 'Pricing: setup builder (EN + PL)',
	'description' => 'Creates the EN and PL lead forms, switches the Pricing page and its Polish translation to the Setup builder template, and fills the setup builder fields. Only empty fields are filled; existing forms are only given missing hidden fields.',
	'run'         => function () use ( $vzo_setup_polish ) {
		if ( ! function_exists( 'wpforms' ) ) {
			throw new RuntimeException( 'WPForms is not active.' );
		}

		$defaults = vzo__setup_builder_defaults();

		// The funnel log table is created by the theme on first use; make sure it exists now.
		if ( function_exists( 'vzo__setup_events_install' ) ) {
			vzo__setup_events_install();
		}
		$polish   = $vzo_setup_polish();
		$log      = [];

		// ── Forms ───────────────────────────────────────────────

		$hidden_labels = [
			'industry'  => 'Industry',
			'equipment' => 'Equipment',
			'challenge' => 'Main challenge',
			'machines'  => 'Machines / measuring points',
			'points'    => 'Estimated measuring points',
			'gateways'  => 'Estimated gateways',
			'case'      => 'Shown case study',
			'session'   => 'Funnel session ID',
			'lang'      => 'Language',
			'keys'      => 'Answer keys',
		];

		$hidden_fields = [];
		foreach ( vzo__setup_builder_form_fields() as $key => $id ) {
			$hidden_fields[ $id ] = [
				'id'    => (string) $id,
				'type'  => 'hidden',
				'label' => $hidden_labels[ $key ],
			];
		}

		$form_copy = [
			'en' => [
				'name'         => [ 'Name', 'Your name' ],
				'company'      => [ 'Company', 'Your company' ],
				'email'        => [ 'Business email', 'you@company.com' ],
				'phone'        => [ 'Phone (optional)', '+48 123 456 789' ],
				'submit'       => 'Get my tailored offer →',
				'processing'   => 'Sending...',
				'subject'      => 'Pricing setup request (EN): {field_id="2"}',
				'confirmation' => '<p><strong>Thank you!</strong> We’ve received your setup and will get back to you with a tailored offer shortly.</p>',
			],
			'pl' => $polish['form'],
		];

		$new_form = function ( $form_id, $title, $copy ) use ( $hidden_fields ) {
			$field = function ( $id, $type, $text, $required ) {
				return [
					'id'          => (string) $id,
					'type'        => $type,
					'label'       => $text[0],
					'placeholder' => $text[1],
					'required'    => $required ? '1' : '',
					'size'        => 'large',
				] + ( 'phone' === $type ? [ 'format' => 'international' ] : [] );
			};

			$fields = [
				1 => $field( 1, 'text', $copy['name'], true ),
				2 => $field( 2, 'text', $copy['company'], true ),
				3 => $field( 3, 'email', $copy['email'], true ),
				4 => $field( 4, 'phone', $copy['phone'], false ),
			] + $hidden_fields;

			return [
				'id'       => (string) $form_id,
				'field_id' => max( array_keys( $fields ) ) + 1,
				'fields'   => $fields,
				'settings' => [
					'form_title'             => $title,
					'form_desc'              => '',
					'submit_text'            => $copy['submit'],
					'submit_text_processing' => $copy['processing'],
					'ajax_submit'            => '1',
					'notification_enable'    => '1',
					'notifications'          => [
						1 => [
							'notification_name' => 'Default Notification',
							'email'             => '{admin_email}',
							'subject'           => $copy['subject'],
							'sender_name'       => 'Viezo',
							'sender_address'    => '{admin_email}',
							'replyto'           => '{field_id="3"}',
							'message'           => '{all_fields}',
							'enable'            => '1',
						],
					],
					'confirmations'          => [
						1 => [
							'name'           => 'Default Confirmation',
							'type'           => 'message',
							'message'        => $copy['confirmation'],
							'message_scroll' => '1',
						],
					],
					'antispam_v3'            => '1',
					'anti_spam'              => [
						'time_limit' => [
							'enable'   => '1',
							'duration' => '2',
						],
					],
				],
			];
		};

		$form_ids = [];

		foreach ( VZO_SETUP_FORM_TITLES as $lang => $title ) {
			$form_id = vzo__setup_builder_find_form( $title );

			// The first version had a single form: it becomes the English one (entries kept).
			if ( ! $form_id && 'en' === $lang ) {
				$form_id = vzo__setup_builder_find_form( 'Pricing setup offer' );
			}

			if ( ! $form_id ) {
				$form_id = (int) wpforms()->form->add( $title );

				if ( ! $form_id ) {
					throw new RuntimeException( "Could not create the {$title} form." );
				}

				wpforms()->form->update( $form_id, $new_form( $form_id, $title, $form_copy[ $lang ] ) );
				$log[] = "form \"{$title}\" #{$form_id} created";
			} else {
				$form    = wpforms()->form->get( $form_id, [ 'content_only' => true ] );
				$added   = [];
				$renamed = ( $form['settings']['form_title'] ?? '' ) !== $title;

				foreach ( $hidden_fields as $id => $hidden ) {
					if ( empty( $form['fields'][ $id ] ) ) {
						$form['fields'][ $id ] = $hidden;
						$added[]               = $hidden['label'];
					} elseif ( 'hidden' !== $form['fields'][ $id ]['type'] ) {
						throw new RuntimeException( "Form #{$form_id} field {$id} should be the hidden \"{$hidden['label']}\" field but is a {$form['fields'][ $id ]['type']} field. Fix the form by hand." );
					}
				}

				if ( $added || $renamed ) {
					$form['settings']['form_title'] = $title;
					$form['field_id']               = max( (int) ( $form['field_id'] ?? 0 ), max( array_keys( $form['fields'] ) ) + 1 );
					wpforms()->form->update( $form_id, $form );
					wp_update_post(
						[
							'ID'         => $form_id,
							'post_title' => $title,
						]
					);
				}

				$log[] = "form \"{$title}\" #{$form_id} kept" . ( $added ? ' (added: ' . implode( ', ', $added ) . ')' : '' ) . ( $renamed ? ' (renamed)' : '' );
			}

			$form_ids[ $lang ] = $form_id;
		}

		// ── Pages ───────────────────────────────────────────────

		$en_id = vzo__seed_find_page_by_template( 'templates/pricing-setup.php' )
			?: vzo__seed_find_page_by_template( 'templates/page-pricing.php' );

		if ( ! $en_id ) {
			return implode( '; ', $log ) . '. No Pricing page found: set its template manually and run again.';
		}

		$pages = [ 'en' => $en_id ];
		if ( function_exists( 'pll_get_post' ) && pll_get_post( $en_id, 'pl' ) ) {
			$pages['pl'] = pll_get_post( $en_id, 'pl' );
		} else {
			$log[] = 'no Polish translation of the Pricing page, create it and run again';
		}

		// Each page is written separately: stop Polylang from copying these meta writes to the
		// other translation (its custom-field sync would put English copy on the Polish page).
		$no_sync = function () {
			return [];
		};
		add_filter( 'pll_copy_post_metas', $no_sync, 999 );
		$acf_sync = [ 'WP_Syntex\\Polylang_Pro\\Integrations\\ACF\\Dispatcher', 'update' ];
		$had_acf  = has_filter( 'acf/update_value', $acf_sync );
		remove_filter( 'acf/update_value', $acf_sync, 5 );

		// Fill a field only when it's empty ('0' counts as set). On a translation, a value
		// identical to the English page counts as empty too: it's an untranslated copy.
		$filled = 0;
		$fill   = function ( $key, $value, $page_id, $compare_id = 0 ) use ( &$filled ) {
			$current = get_field( $key, $page_id, false );
			$empty   = null === $current || '' === $current || false === $current || [] === $current || 0 === $current;

			if ( ! $empty && $compare_id && $current == get_field( $key, $compare_id, false ) ) { // phpcs:ignore Universal.Operators.StrictComparisons -- arrays of rows.
				$empty = $current != $value; // phpcs:ignore Universal.Operators.StrictComparisons
			}

			if ( $empty ) {
				update_field( $key, $value, $page_id );
				++$filled;
			}
		};

		$case_id = function ( $slug, $lang ) {
			$post = get_page_by_path( $slug, OBJECT, 'case-study' );
			$id   = $post ? $post->ID : 0;

			return $id && function_exists( 'pll_get_post' ) ? ( pll_get_post( $id, $lang ) ?: $id ) : $id;
		};

		foreach ( $pages as $lang => $page_id ) {
			$filled  = 0;
			$compare = 'en' === $lang ? 0 : $en_id;

			update_post_meta( $page_id, '_wp_page_template', 'templates/pricing-setup.php' );

			// Header button → builder. Polish header copy only where it's empty.
			$button = get_field( 'header_button', $page_id ) ?: [];
			update_field(
				'header_button',
				[
					'title'  => ( $button['title'] ?? '' ) ?: ( 'pl' === $lang ? $polish['header']['header_button'] : 'Build my setup' ),
					'url'    => '#setup-builder',
					'target' => '',
				],
				$page_id
			);

			if ( 'pl' === $lang ) {
				foreach ( [ 'header_title', 'header_button_note' ] as $name ) {
					if ( ! get_field( $name, $page_id ) ) {
						update_field( $name, $polish['header'][ $name ], $page_id );
					}
				}

				foreach ( [ 'header_size', 'header_background' ] as $name ) {
					if ( ! get_field( $name, $page_id, false ) ) {
						update_field( $name, get_field( $name, $en_id, false ), $page_id );
					}
				}
			}

			$texts = 'pl' === $lang ? $polish['texts'] : $defaults['texts'];
			foreach ( $texts as $name => $value ) {
				$fill( 'field_setup_' . $name, $value, $page_id, $compare );
			}

			foreach ( VZO_SETUP_QUESTIONS as $question ) {
				$fill( "field_setup_{$question}_multiple", $defaults['multiple'][ $question ] ? 1 : 0, $page_id );

				$rows = array_map(
					function ( $option ) use ( $lang, $polish, $question ) {
						if ( 'pl' === $lang ) {
							$option['label'] = $polish['options'][ $question ][ $option['key'] ] ?? $option['label'];
						}

						return $option;
					},
					$defaults['options'][ $question ]
				);
				$fill( "field_setup_{$question}_options", $rows, $page_id, $compare );
			}

			$fill( 'field_setup_stops', $defaults['stops'], $page_id );
			$fill( 'field_setup_default_machines', $defaults['default'], $page_id );
			$fill( 'field_setup_sensors_per_gateway', $defaults['sensors'], $page_id );
			$fill( 'field_setup_email_enabled', 1, $page_id );

			$cases = [];
			foreach ( $defaults['cases'] as $case ) {
				$id = $case_id( $case['slug'], $lang );

				if ( ! $id ) {
					continue;
				}

				$copy    = 'pl' === $lang ? ( $polish['cases'][ $case['slug'] ] ?? null ) : null;
				$cases[] = [
					'case_study' => $id,
					'tag'        => $copy ? $copy[0] : $case['tag'],
					'machine'    => $copy ? $copy[1] : $case['machine'],
					'detected'   => $copy ? $copy[2] : $case['detected'],
					'outcome'    => $copy ? $copy[3] : $case['outcome'],
					'equipment'  => $case['equipment'],
					'challenge'  => $case['challenge'],
					'industry'   => $case['industry'],
				];
			}
			$fill( 'field_setup_cases', $cases, $page_id, $compare );

			$fill( 'field_setup_form', $form_ids[ $lang ], $page_id, $compare );

			$log[] = sprintf( '%s page #%d: %d empty fields filled', strtoupper( $lang ), $page_id, $filled );
		}

		remove_filter( 'pll_copy_post_metas', $no_sync, 999 );
		if ( $had_acf ) {
			add_filter( 'acf/update_value', $acf_sync, 5, 3 );
		}

		return ucfirst( implode( '; ', $log ) ) . '.';
	},
];
