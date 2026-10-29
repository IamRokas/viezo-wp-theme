<?php
/**
 * Seed: Case-study titles and meta descriptions (backlog C-03, approved by Viezo 2026-10-29).
 *
 * Sets the approved title (page heading, cards, Google) and Yoast meta description of every case
 * study, English and Polish. Source: docs/seo-geo/04-backlog/c-03-case-study-titles.md.
 * No client names (Viezo, 2026-10-21). URLs don't change.
 *
 * Case studies are found by their English URL slug; the Polish version through Polylang.
 * The first run stores the previous title/description in `_vzo_c03_previous` on each post, so it
 * can be undone. Re-running writes the same values again (safe). In Google the title gets the
 * suffix " | Viezo case study" / " | Studium przypadku Viezo" (vzo__seo_case_study_title()).
 *
 * The Polish granulator case was published by Viezo (2026-10); its title is set here like the rest.
 *
 * @package Viezo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Approved titles: English slug => [ EN title, EN description, PL title, PL description ].
 *
 * @return array
 */
$vzo_case_study_titles = function () {
	return [
		'fan-bearing-wear'                     => [
			'Fan motor bearing wear caught before critical condition',
			'Furniture plant: Sonora vibration monitoring flagged bearing wear in a fan motor just before it reached critical condition.',
			'Zużycie łożyska silnika wentylatora wykryte przed stanem krytycznym',
			'Zakład meblarski: monitoring drgań Sonora wykrył zużycie łożyska w silniku wentylatora tuż przed osiągnięciem stanu krytycznego.',
		],
		'belt-imbalance-on-grinding-machine'   => [
			'Belt imbalance on a grinding machine fixed in 15 minutes',
			'Automotive plant: Sonora detected belt imbalance on a grinding machine drive. Belts were replaced at once, cutting repair time from 1 hour to 15 minutes.',
			'Niewyważenie pasów szlifierki usunięte w 15 minut',
			'Zakład motoryzacyjny: Sonora wykryła niewyważenie pasów w napędzie szlifierki. Pasy wymieniono od razu, skracając naprawę z 1 godziny do 15 minut.',
		],
		'motor-bearing-wear-detected-on-uv-processing-line' => [
			'Motor bearing wear detected on a UV processing line',
			'Furniture plant: vibration monitoring tracked growing bearing wear on a Hymmen UV line motor and flagged it before it reached critical levels.',
			'Zużycie łożyska silnika wykryte na linii UV',
			'Zakład meblarski: monitoring drgań śledził narastające zużycie łożyska silnika linii UV Hymmen i zgłosił je przed osiągnięciem poziomu krytycznego.',
		],
		'fan-imbalance'                        => [
			'Industrial fan imbalance caused by contamination',
			'Metal-working plant: Sonora detected imbalance on an industrial fan, and inspection traced it to contamination on the fan.',
			'Niewyważenie wentylatora przemysłowego spowodowane zanieczyszczeniem',
			'Zakład obróbki metali: Sonora wykryła niewyważenie wentylatora przemysłowego, a przegląd wykazał, że przyczyną było zanieczyszczenie.',
		],
		'cutter-bearing-wear'                  => [
			'Cutter bearing wear on an edge processing machine',
			'Furniture plant: vibration monitoring detected developing bearing wear on an edge processing cutter.',
			'Zużycie łożyska frezu na maszynie do obróbki krawędzi',
			'Zakład meblarski: monitoring drgań wykrył narastające zużycie łożyska frezu do obróbki krawędzi.',
		],
		'cutter-wear-on-edge-processing-line'  => [
			'Cutter wear tracked on an edge processing line',
			'Furniture plant: Sonora detected cutter wear on an edge processing line and tracked it until replacement, before it escalated.',
			'Zużycie frezu na linii obróbki krawędzi wykryte i monitorowane',
			'Zakład meblarski: Sonora wykryła zużycie frezu na linii obróbki krawędzi i monitorowała je aż do wymiany, zanim problem się nasilił.',
		],
		'becker-compressor-vane-wear'          => [
			'Vane wear on a Becker vacuum pump detected early',
			'Paper packaging plant: vibration monitoring detected vane wear on a Becker compressor (vacuum pump) before it led to major damage.',
			'Zużycie łopatek pompy próżniowej Becker wykryte wcześnie',
			'Zakład opakowań papierowych: monitoring drgań wykrył zużycie łopatek sprężarki Becker (pompy próżniowej), zanim doszło do poważnej awarii.',
		],
		'granulator-bearing-fault-validated-after-initial-dismissal' => [
			'Granulator motor bearing fault confirmed after a dismissed alert',
			'Animal feed plant: Sonora flagged bearing wear on a granulator motor. First dismissed as a false alarm, further data confirmed an outer-race defect.',
			'Usterka łożyska silnika granulatora potwierdzona mimo zlekceważonego alarmu',
			'Wytwórnia pasz: Sonora wykryła zużycie łożyska silnika granulatora. Alarm uznano za fałszywy, ale dalsze dane potwierdziły uszkodzenie bieżni zewnętrznej.',
		],
		'bearing-deterioration-on-a-cutting-motor' => [
			'Bearing deterioration on a cutting motor detected before failure',
			'Furniture plant: abnormal vibration patterns revealed bearing deterioration on an industrial cutting motor before it failed.',
			'Zużycie łożysk silnika tnącego wykryte przed awarią',
			'Zakład meblarski: nietypowe wzorce drgań ujawniły zużycie łożysk przemysłowego silnika tnącego, zanim doszło do awarii.',
		],
		'bearing-deterioration-detected-on-an-ima-motor' => [
			'Bearing damage on an IMA spindle motor detected before failure',
			'Furniture plant: vibration monitoring detected bearing deterioration on an IMA high-frequency spindle motor before failure occurred.',
			'Uszkodzenie łożyska silnika wrzeciona IMA wykryte przed awarią',
			'Zakład meblarski: monitoring drgań wykrył zużycie łożyska wysokoobrotowego silnika wrzeciona IMA, zanim doszło do awarii.',
		],
		'circulation-pump-bearing-failure'     => [
			'Circulation pump bearing failure caught before breakdown',
			'Roofing materials plant: Sonora detected a developing bearing failure on a circulation pump before it broke down, allowing timely repair.',
			'Awaria łożyska pompy obiegowej wykryta przed postojem',
			'Producent pokryć dachowych: Sonora wykryła rozwijającą się awarię łożyska pompy obiegowej przed jej zatrzymaniem, umożliwiając naprawę na czas.',
		],
		'shredder-failure'                     => [
			'Complex multi-cause fault on a shredder uncovered',
			'Furniture panel plant: continuous vibration monitoring and analysis uncovered a complex, multi-layered fault on a shredding system.',
			'Złożona usterka rozdrabniacza wykryta dzięki analizie drgań',
			'Producent płyt meblowych: ciągły monitoring i analiza drgań ujawniły złożoną, wielowarstwową usterkę systemu rozdrabniania.',
		],
		'kekava-ammonia-compressor-fault'      => [
			'Bearing problem on an ammonia compressor motor',
			'Meat processing plant: signs of a developing bearing problem on an ammonia compressor motor were detected on the same day the sensors were installed.',
			'Problem z łożyskiem silnika sprężarki amoniaku',
			'Zakład mięsny: oznaki rozwijającego się problemu z łożyskiem silnika sprężarki amoniaku wykryto tego samego dnia, w którym zamontowano czujniki.',
		],
		'blower-bearing-wear'                  => [
			'Blower bearing wear detected early, motor replaced in time',
			'Metal-working plant: vibration monitoring identified developing bearing wear on an air-injection blower early, so the motor was replaced in time.',
			'Zużycie łożyska dmuchawy wykryte wcześnie, silnik wymieniony na czas',
			'Zakład obróbki metali: monitoring drgań wcześnie wykrył zużycie łożyska dmuchawy powietrza, dzięki czemu silnik wymieniono na czas.',
		],
		'bearing-fault'                        => [
			'Bearing fault in an IMA KFA corner rounding unit caught early',
			'Furniture plant: early detection of a bearing fault in an IMA KFA corner rounding unit allowed the motor to be replaced before costly downtime.',
			'Usterka łożyska w agregacie zaokrąglania naroży IMA KFA wykryta wcześnie',
			'Zakład meblarski: wczesne wykrycie usterki łożyska w agregacie do zaokrąglania naroży IMA KFA pozwoliło wymienić silnik przed kosztownym postojem.',
		],
		'pump-failure'                         => [
			'Shaft misalignment on an oil circulation pump caught early',
			'Plastics packaging plant: early detection of shaft misalignment on a Bosch Rexroth pump saved over €46,000 in replacement and labor costs and a two-week shutdown.',
			'Niewspółosiowość wału pompy oleju wykryta na czas',
			'Zakład opakowań z tworzyw: wczesne wykrycie niewspółosiowości wału pompy Bosch Rexroth pozwoliło zaoszczędzić ponad 46 000 € kosztów wymiany i robocizny oraz uniknąć dwutygodniowego postoju.',
		],
		'diamond-cutter-fault'                 => [
			'Diamond cutter shaft imbalance fixed before a line stop',
			'Furniture panel plant: a quick reaction to shaft imbalance on a diamond cutter prevented an unplanned stop of the production line.',
			'Niewyważenie wału frezu diamentowego usunięte przed postojem linii',
			'Producent płyt meblowych: szybka reakcja na niewyważenie wału frezu diamentowego zapobiegła nieplanowanemu zatrzymaniu linii produkcyjnej.',
		],
		'fan-fault'                            => [
			'Fan fault caught before impeller damage',
			'Furniture plant: an early warning on an industrial fan allowed a controlled replacement before the impeller was critically damaged.',
			'Usterka wentylatora wykryta przed uszkodzeniem wirnika',
			'Zakład meblarski: wczesne ostrzeżenie dotyczące wentylatora przemysłowego pozwoliło na planową wymianę, zanim wirnik uległ poważnemu uszkodzeniu.',
		],
		'shredder-engine-fault'                => [
			'Shaft problem on a shredder motor detected early',
			'Furniture panel plant: vibration monitoring detected an early shaft-related problem on a shredding system motor.',
			'Problem z wałem silnika rozdrabniacza wykryty wcześnie',
			'Producent płyt meblowych: monitoring drgań wcześnie wykrył problem z wałem silnika systemu rozdrabniania.',
		],
		'motor-defect'                         => [
			'Motor defect on an IMA processing unit detected early',
			'Furniture plant: vibration monitoring identified a developing defect in an IMA processing unit motor before it escalated into a failure.',
			'Usterka silnika agregatu IMA wykryta wcześnie',
			'Zakład meblarski: monitoring drgań wykrył rozwijającą się usterkę silnika agregatu obróbczego IMA, zanim przerodziła się w awarię.',
		],
		'sanding-line-shaft-wear'              => [
			'Shaft wear on a sanding line detected before downtime',
			'Furniture plant: Sonora detected shaft-related wear on a sanding line motor before it led to unplanned downtime.',
			'Zużycie wału linii szlifierskiej wykryte przed postojem',
			'Zakład meblarski: Sonora wykryła zużycie wału silnika linii szlifierskiej, zanim doprowadziło do nieplanowanego postoju.',
		],
		'compressor-motor-bearing-wear'        => [
			'Compressor motor bearing wear caught before critical failure',
			'Food plant: vibration monitoring detected bearing wear on a compressor motor before it developed into a critical failure.',
			'Zużycie łożysk silnika sprężarki wykryte przed awarią',
			'Zakład spożywczy: monitoring drgań wykrył zużycie łożysk silnika sprężarki, zanim przerodziło się w poważną awarię.',
		],
		'diamond-cutter-motor-bearing-fault'   => [
			'Hidden bearing defect in a diamond cutter motor found',
			'Furniture panel plant: when a tool replacement didn\'t stop the vibration, Sonora pointed to a hidden bearing defect in the diamond cutter motor.',
			'Ukryta usterka łożyska silnika piły diamentowej',
			'Producent płyt meblowych: gdy wymiana narzędzia nie usunęła drgań, Sonora wskazała ukrytą usterkę łożyska silnika piły diamentowej.',
		],
		'belt-misalignment-detected-on-main-motor' => [
			'Belt pulley misalignment on a main motor drive',
			'Chocolate factory: Sonora detected belt pulley misalignment on a main motor drive before it caused accelerated wear and equipment damage.',
			'Niewspółosiowość koła pasowego w napędzie silnika głównego',
			'Fabryka czekolady: Sonora wykryła niewspółosiowość koła pasowego w napędzie silnika głównego, zanim spowodowała przyspieszone zużycie i uszkodzenia.',
		],
		'disc-mill-bearing-wear'               => [
			'Disc mill bearing wear detected months in advance',
			'Agricultural plant: Sonora detected bearing deterioration on a disc mill motor months before maintenance confirmed the root cause.',
			'Zużycie łożysk młyna tarczowego wykryte kilka miesięcy wcześniej',
			'Zakład rolniczy: Sonora wykryła zużycie łożysk silnika młyna tarczowego na kilka miesięcy przed potwierdzeniem przyczyny przez dział utrzymania ruchu.',
		],
		'dryer-fan-motor-fault'                => [
			'Dryer fan motor damage tracked before inspection',
			'Packaging plant: Sonora tracked a developing fault on a dryer process fan before inspection revealed internal motor damage.',
			'Uszkodzenie silnika wentylatora suszarki wykryte przed przeglądem',
			'Zakład opakowań: Sonora śledziła rozwijającą się usterkę wentylatora suszarki, zanim przegląd wykazał wewnętrzne uszkodzenie silnika.',
		],
		'tool-holder-looseness'                => [
			'Loose tool holder on an edge processing unit detected',
			'Furniture plant: abnormal vibration on an edge processing unit pointed maintenance to a loose tool holder.',
			'Poluzowany uchwyt narzędziowy w agregacie do obróbki krawędzi',
			'Zakład meblarski: nietypowe drgania agregatu do obróbki krawędzi wskazały służbom utrzymania ruchu poluzowany uchwyt narzędziowy.',
		],
		'exhaust-fan-motor-bearing-fault'      => [
			'Exhaust fan motor bearing fault detected before failure',
			'Furniture parts plant: vibration monitoring detected developing bearing wear in an exhaust fan motor before the fault became critical.',
			'Usterka łożyska silnika wentylatora wyciągowego wykryta przed awarią',
			'Producent elementów meblowych: monitoring drgań wykrył narastające zużycie łożyska silnika wentylatora wyciągowego, zanim usterka stała się krytyczna.',
		],
		'gearbox-fault-detected-on-a-conveyor-drive' => [
			'Conveyor gearbox fault detected before critical failure',
			'Footwear and fashion retailer: vibration monitoring identified a developing gearbox fault on a conveyor drive before it escalated into a critical failure.',
			'Usterka przekładni napędu przenośnika wykryta przed awarią',
			'Sieć sprzedaży obuwia i odzieży: monitoring drgań wykrył rozwijającą się usterkę przekładni w napędzie przenośnika, zanim przerodziła się w krytyczną awarię.',
		],
		'scoring-saw-blade-wear'               => [
			'Blunt scoring saw blade detected through vibration',
			'Furniture panel plant: rising vibration harmonics revealed scoring saw blade wear, and maintenance confirmed a blunt blade.',
			'Tępe ostrze piły podcinającej wykryte dzięki analizie drgań',
			'Producent płyt meblowych: rosnące harmoniczne drgań ujawniły zużycie ostrza piły podcinającej, a przegląd potwierdził tępe ostrze.',
		],
	];
};

/**
 * Rebuild Yoast's index entry for a post. Yoast serves titles and descriptions from its own
 * index table, which isn't always refreshed when posts are changed from code.
 *
 * @param int $post_id Post ID.
 */
$vzo_reindex_yoast = function ( $post_id ) {
	if ( ! function_exists( 'YoastSEO' ) ) {
		return;
	}

	try {
		$repository = YoastSEO()->classes->get( \Yoast\WP\SEO\Repositories\Indexable_Repository::class );
		$builder    = YoastSEO()->classes->get( \Yoast\WP\SEO\Builders\Indexable_Builder::class );
		$indexable  = $builder->build_for_id_and_type( $post_id, 'post', $repository->find_by_id_and_type( $post_id, 'post', false ) );

		// Yoast skips saving on non-production environments; save explicitly so it works everywhere.
		if ( $indexable ) {
			$indexable->save();
		}
	} catch ( Throwable $e ) {
		// Yoast rebuilds it on the next save anyway; the post data itself is already updated.
		return;
	}
};

/**
 * Set one post's title and Yoast description, keeping the previous values once for undo.
 *
 * @param int    $post_id     Post ID.
 * @param string $title       New title.
 * @param string $description New meta description.
 * @return bool Whether something changed.
 */
$vzo_set_case_study_title = function ( $post_id, $title, $description ) use ( $vzo_reindex_yoast ) {
	$post    = get_post( $post_id );
	$old     = [ 'title' => $post->post_title, 'description' => (string) get_post_meta( $post_id, '_yoast_wpseo_metadesc', true ) ];
	$changed = $old['title'] !== $title || $old['description'] !== $description;

	if ( $changed ) {
		if ( ! get_post_meta( $post_id, '_vzo_c03_previous', true ) ) {
			update_post_meta( $post_id, '_vzo_c03_previous', $old );
		}

		update_post_meta( $post_id, '_yoast_wpseo_metadesc', $description );
		wp_update_post( [ 'ID' => $post_id, 'post_title' => $title ] );
	}

	// Always, so a re-run also repairs a stale index.
	$vzo_reindex_yoast( $post_id );

	return $changed;
};

return [
	'title'       => 'SEO: case-study titles and descriptions',
	'description' => 'Sets the approved titles and Google descriptions of all 30 case studies (English and Polish, no client names). URLs stay the same. Previous values are kept on each post for undo.',
	'run'         => function () use ( $vzo_case_study_titles, $vzo_set_case_study_title ) {
		$no_sync  = '__return_empty_array';
		$acf_sync = [ 'WP_Syntex\\Polylang_Pro\\Integrations\\ACF\\Dispatcher', 'update' ];
		$had_acf  = has_filter( 'acf/update_value', $acf_sync );
		add_filter( 'pll_copy_post_metas', $no_sync, 999 );
		remove_filter( 'acf/update_value', $acf_sync, 5 );

		$changed   = 0;
		$unchanged = 0;
		$missing   = [];

		try {
			foreach ( $vzo_case_study_titles() as $slug => $row ) {
				$en = get_posts(
					[
						'post_type'      => 'case-study',
						'name'           => $slug,
						'post_status'    => 'any',
						'posts_per_page' => 1,
						'lang'           => '',
					]
				);

				if ( ! $en ) {
					$missing[] = $slug . ' (EN)';
					continue;
				}

				$vzo_set_case_study_title( $en[0]->ID, $row[0], $row[1] ) ? ++$changed : ++$unchanged;

				$pl_id = function_exists( 'pll_get_post' ) ? (int) pll_get_post( $en[0]->ID, 'pl' ) : 0;

				if ( ! $pl_id ) {
					$missing[] = $slug . ' (PL)';
					continue;
				}

				$vzo_set_case_study_title( $pl_id, $row[2], $row[3] ) ? ++$changed : ++$unchanged;
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

		$message = sprintf( '%d pages updated, %d already up to date.', $changed, $unchanged );

		if ( $missing ) {
			$message .= ' Not found: ' . implode( ', ', $missing ) . '.';
		}

		return $message;
	},
];
