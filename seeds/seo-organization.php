<?php
/**
 * Seed: SEO organization (Yoast "Site representation").
 *
 * Yoast only outputs Organization schema when the site has a company name AND a logo from the
 * Media Library; both were empty. This sets them, using a 600×600 logo from seeds/assets/seo/
 * (Google needs at least 112×112; the header logo is 103×24).
 *
 * The extra Organization details (legal name, address, LinkedIn, …) come from
 * vzo__schema_organization() in inc/seo.php. Re-running is safe; it only sets these settings.
 *
 * @package Viezo
 */

defined( 'ABSPATH' ) || exit;

return [
	'title'       => 'SEO: organization for schema (Yoast)',
	'description' => 'Sets Yoast → Site representation to the company "Viezo" with a square logo, so Organization structured data is output on every page.',
	'run'         => function () {
		if ( ! class_exists( 'WPSEO_Options' ) ) {
			throw new RuntimeException( 'Yoast SEO is not active.' );
		}

		$logo_id = vzo__seed_import_image( 'seo/viezo-logo.png' );

		if ( ! $logo_id ) {
			throw new RuntimeException( 'seeds/assets/seo/viezo-logo.png is missing.' );
		}

		update_post_meta( $logo_id, '_wp_attachment_image_alt', 'Viezo logo' );

		WPSEO_Options::set( 'company_or_person', 'company' );
		WPSEO_Options::set( 'company_name', 'Viezo' );
		WPSEO_Options::set( 'company_alternate_name', 'UAB Viezo' );
		WPSEO_Options::set( 'company_logo', wp_get_attachment_url( $logo_id ) );
		WPSEO_Options::set( 'company_logo_id', $logo_id );
		WPSEO_Options::set( 'website_name', 'Viezo' );
		WPSEO_Options::set( 'alternate_website_name', 'Viezo, UAB' );

		return sprintf( 'Company "Viezo" with logo #%d set. Check the source of any page for "@type":"Organization".', $logo_id );
	},
];
