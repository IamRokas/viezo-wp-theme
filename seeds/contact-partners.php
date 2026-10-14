<?php
/**
 * Seed: distributors & OEM partners on the Contacts page.
 *
 * Logos: put files in /seeds/assets/logos/ with the names below; missing files are skipped
 * (the card then shows the company name instead).
 *
 * @package Viezo
 */

defined( 'ABSPATH' ) || exit;

return [
	'title'       => 'Contact page: distributors & OEM partners',
	'description' => 'Fills the Distributors and OEM partner repeaters on the English Contacts page (other languages fall back to it). Imports logos from seeds/assets/logos/.',
	'run'         => function () {
		$page_id = vzo__seed_find_page_by_template( 'templates/contacts.php' );

		if ( ! $page_id ) {
			throw new RuntimeException( 'No page uses the Contacts template.' );
		}

		$warnings = [];

		// A logo that can't be imported is skipped (the card shows the company name instead).
		$logo = function ( $file ) use ( &$warnings ) {
			try {
				return vzo__seed_import_image( 'logos/' . $file ) ?: '';
			} catch ( RuntimeException $e ) {
				$warnings[] = $e->getMessage();
				return '';
			}
		};

		$rows = function ( $items ) use ( $logo ) {
			return array_map(
				function ( $item ) use ( $logo ) {
					return [
						'region'  => $item[0],
						'company' => $item[1],
						'website' => $item[2],
						'logo'    => $logo( $item[3] ),
					];
				},
				$items
			);
		};

		// [ Country / region, Company, Website, Logo file in seeds/assets/logos/ ].
		$distributors = $rows(
			[
				[ 'Lithuania', 'Techvitas', 'https://techvitas.com', 'techvitas.png' ],
				[ 'Poland', 'Ruven', 'https://ruven.pl', 'ruven.png' ],
				[ 'India', 'Sujan Industries', 'https://sujanindustries.com', 'sujan-industries.png' ],
				[ 'Argentina / Spain', 'TGD Company', 'https://tgdcompany.com', 'tgd-company.png' ],
			]
		);

		$oem_partners = $rows(
			[
				[ 'International', 'IMA Schelling Group', 'https://imaschelling.com', 'ima-schelling.png' ],
			]
		);

		// Only fill empty fields: never overwrite lists or titles edited in the admin.
		$filled = [];
		foreach (
			[
				'field_contacts_distributors_title' => 'Distributors',
				'field_contacts_oem_partners_title' => 'OEM partner',
				'field_contacts_distributors'       => $distributors,
				'field_contacts_oem_partners'       => $oem_partners,
			] as $key => $value
		) {
			if ( empty( get_field( $key, $page_id, false ) ) ) {
				update_field( $key, $value, $page_id );
				$filled[] = $key;
			}
		}

		// Logos: fill rows that have no logo yet (e.g. after adding files to seeds/assets/logos/).
		foreach ( [ 'field_contacts_distributors' => $distributors, 'field_contacts_oem_partners' => $oem_partners ] as $key => $seed_rows ) {
			$rows    = get_field( $key, $page_id ) ?: [];
			$changed = false;

			foreach ( $rows as $i => $row ) {
				$match = array_values( array_filter( $seed_rows, fn( $seed_row ) => $seed_row['company'] === ( $row['company'] ?? '' ) ) );

				if ( empty( $row['logo'] ) && $match && $match[0]['logo'] ) {
					$rows[ $i ]['logo'] = $match[0]['logo'];
					$changed            = true;
				}
			}

			if ( $changed ) {
				update_field( $key, array_map( fn( $row ) => array_merge( $row, [ 'logo' => is_array( $row['logo'] ?? null ) ? $row['logo']['ID'] : ( $row['logo'] ?? '' ) ] ), $rows ), $page_id );
				$filled[] = $key . ' (logos)';
			}
		}

		$logos = count( array_filter( array_column( array_merge( $distributors, $oem_partners ), 'logo' ) ) );

		return sprintf(
			'"%s": %d fields filled (%d distributors, %d OEM partners, %d logo files available).%s',
			get_the_title( $page_id ),
			count( $filled ),
			count( $distributors ),
			count( $oem_partners ),
			$logos,
			$warnings ? ' ' . implode( ' ', array_unique( $warnings ) ) : ''
		);
	},
];
