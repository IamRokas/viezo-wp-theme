<?php
/**
 * Seed: SEO server files (robots.txt + compression).
 *
 * 1. robots.txt: the physical robots.txt in the site root blocked /wp-content/uploads/ (all
 *    images). It is renamed to robots.txt.viezo-backup so WordPress serves robots.txt from
 *    vzo__robots_txt() in inc/seo.php (version-controlled from now on).
 * 2. Compression: adds a "Viezo compression" block (mod_deflate) to the root .htaccess so HTML,
 *    CSS, JS, SVG and fonts are sent gzipped. WordPress manages the block with
 *    insert_with_markers(), the same way it writes its own rewrite rules; re-running replaces it.
 * 3. Checks both from the outside and reports what it found.
 *
 * Undo: delete the "Viezo compression" block from .htaccess and rename the backup to robots.txt.
 *
 * @package Viezo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Lines for the .htaccess block.
 *
 * @return string[]
 */
$vzo_compression_rules = function () {
	return [
		'# Gzip text responses. Managed by the Viezo theme (Tools → Viezo seeds → SEO: server files).',
		'<IfModule mod_deflate.c>',
		'	<IfModule mod_filter.c>',
		'		AddOutputFilterByType DEFLATE text/html text/plain text/css text/xml text/javascript',
		'		AddOutputFilterByType DEFLATE application/javascript application/x-javascript application/json application/ld+json',
		'		AddOutputFilterByType DEFLATE application/xml application/xhtml+xml application/rss+xml image/svg+xml',
		'		AddOutputFilterByType DEFLATE font/ttf font/otf application/x-font-ttf application/vnd.ms-fontobject',
		'	</IfModule>',
		'</IfModule>',
	];
};

/**
 * Fetch a URL from the server itself and return [status, content-encoding, body] or an error string.
 *
 * @param string $url URL.
 * @return array|string
 */
$vzo_fetch = function ( $url ) {
	$response = wp_remote_get(
		add_query_arg( 'vzo-check', time(), $url ),
		[
			'timeout'    => 15,
			'decompress' => false,
			'headers'    => [ 'Accept-Encoding' => 'gzip, deflate' ],
			'sslverify'  => false,
		]
	);

	if ( is_wp_error( $response ) ) {
		return $response->get_error_message();
	}

	$encoding = strtolower( (string) wp_remote_retrieve_header( $response, 'content-encoding' ) );
	$body     = (string) wp_remote_retrieve_body( $response );

	// Some HTTP transports decompress anyway; only decode what is still gzipped.
	if ( 'gzip' === $encoding && function_exists( 'gzdecode' ) ) {
		$decoded = @gzdecode( $body ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
		$body    = false !== $decoded ? $decoded : $body;
	}

	return [ (int) wp_remote_retrieve_response_code( $response ), $encoding, $body ];
};

return [
	'title'       => 'SEO: server files (robots.txt, compression)',
	'description' => 'Replaces the physical robots.txt (it blocked all images) with the theme\'s version and adds gzip compression to .htaccess. Then checks both and reports the result.',
	'run'         => function () use ( $vzo_compression_rules, $vzo_fetch ) {
		require_once ABSPATH . 'wp-admin/includes/misc.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';

		$report = [];
		$errors = [];

		// 1. robots.txt.
		$robots = ABSPATH . 'robots.txt';

		if ( ! get_option( 'blog_public' ) ) {
			$errors[] = 'robots.txt: skipped, Settings → Reading → "Discourage search engines" is on.';
		} elseif ( file_exists( $robots ) ) {
			$backup = ABSPATH . 'robots.txt.viezo-backup';

			if ( @rename( $robots, $backup ) ) { // phpcs:ignore WordPress.PHP.NoSilencedErrors, WordPress.WP.AlternativeFunctions.rename_rename
				$report[] = 'robots.txt: physical file renamed to robots.txt.viezo-backup.';
			} else {
				$errors[] = 'robots.txt: could not rename ' . $robots . ' (not writable by PHP). Delete or rename it on the server by hand.';
			}
		} else {
			$report[] = 'robots.txt: no physical file, WordPress serves it.';
		}

		// 2. Compression.
		$htaccess = get_home_path() . '.htaccess';

		if ( ! file_exists( $htaccess ) || ! wp_is_writable( $htaccess ) ) {
			$errors[] = '.htaccess: not found or not writable at ' . $htaccess . '. Add the rules from seeds/seo-server.php by hand.';
		} elseif ( insert_with_markers( $htaccess, 'Viezo compression', $vzo_compression_rules() ) ) {
			$report[] = '.htaccess: "Viezo compression" block written.';
		} else {
			$errors[] = '.htaccess: could not write the block.';
		}

		// 3. Check from the outside.
		$check = $vzo_fetch( home_url( '/robots.txt' ) );

		if ( is_string( $check ) ) {
			$report[] = 'Check robots.txt: request failed (' . $check . '). Open ' . home_url( '/robots.txt' ) . ' to check.';
		} elseif ( false !== strpos( $check[2], 'Disallow: /wp-content/uploads' ) ) {
			$errors[] = 'Check robots.txt: still blocks /wp-content/uploads/ (a cache may still serve the old file).';
		} elseif ( false !== strpos( $check[2], 'GPTBot' ) ) {
			$report[] = 'Check robots.txt: OK, images allowed and AI crawlers listed.';
		} else {
			$report[] = 'Check robots.txt: HTTP ' . $check[0] . ', open it to check.';
		}

		$stylesheet = get_stylesheet_uri();

		foreach ( [ 'Home page' => home_url( '/' ), 'style.css' => $stylesheet ] as $label => $url ) {
			$check = $vzo_fetch( $url );

			if ( is_string( $check ) ) {
				$report[] = 'Check ' . $label . ': request failed (' . $check . ').';
			} elseif ( in_array( $check[1], [ 'gzip', 'br', 'deflate' ], true ) ) {
				$report[] = 'Check ' . $label . ': compressed (' . $check[1] . ').';
			} else {
				$errors[] = 'Check ' . $label . ': NOT compressed. Apache\'s mod_deflate or mod_filter is probably not enabled; ask the server admin to enable them (or put Cloudflare in front).';
			}
		}

		if ( $errors ) {
			throw new RuntimeException( implode( ' ', array_merge( $errors, $report ) ) );
		}

		return implode( ' ', $report );
	},
];
