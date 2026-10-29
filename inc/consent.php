<?php
/**
 * Cookie consent: banner, "Cookie settings" link and analytics loading.
 *
 * Requested by Viezo (2026-10-29): "Accept all" and "Reject optional" buttons, no GA4 analytics
 * cookies before consent, and the choice can be changed or withdrawn later.
 *
 * - Necessary only by default. Nothing optional is stored until the visitor chooses.
 * - GA4 (inc/analytics.php) runs in Consent Mode with analytics_storage "denied" until "Accept all",
 *   so it sets no cookies before consent.
 * - Microsoft Clarity (plugin) is unhooked and only loaded after "Accept all".
 * - The choice is stored in localStorage "vzo_consent" ({ choice: "all" | "necessary", at }) for
 *   12 months, then the banner asks again. Visitors who clicked "OK" on the old GlowCookies banner
 *   count as "all".
 * - "Cookie settings" in the footer reopens the banner. "Reject optional" after an earlier
 *   "Accept all" revokes consent and deletes the analytics cookies on this domain.
 *
 * Not covered: Tidio chat loads independently (see docs/seo-geo/releases/2026-10-29-titles-consent.md).
 *
 * @package Viezo
 */

/**
 * Banner texts in the current language.
 *
 * @return array
 */
function vzo__consent_texts() {
	$pl = function_exists( 'pll_current_language' ) && 'pl' === pll_current_language();

	if ( $pl ) {
		return [
			'title'    => 'Pliki cookie',
			'text'     => 'Używamy niezbędnych plików cookie, aby strona działała. Za Twoją zgodą używamy też analitycznych plików cookie (Google Analytics, Microsoft Clarity), aby zrozumieć, jak korzystasz ze strony. Swój wybór możesz zmienić w każdej chwili w „Ustawieniach cookie” na dole strony.',
			'accept'   => 'Akceptuj wszystkie',
			'reject'   => 'Odrzuć opcjonalne',
			'policy'   => 'Polityka prywatności',
			'settings' => 'Ustawienia cookie',
		];
	}

	return [
		'title'    => 'Cookies',
		'text'     => 'We use necessary cookies to run this site. With your permission, we also use analytics cookies (Google Analytics, Microsoft Clarity) to understand how the site is used. You can change your choice at any time under "Cookie settings" at the bottom of the page.',
		'accept'   => 'Accept all',
		'reject'   => 'Reject optional',
		'policy'   => 'Privacy policy',
		'settings' => 'Cookie settings',
	];
}

/**
 * Privacy policy URL in the current language.
 *
 * @return string
 */
function vzo__consent_policy_url() {
	$id = (int) get_option( 'wp_page_for_privacy_policy' );

	if ( $id && function_exists( 'pll_get_post' ) ) {
		$id = (int) ( pll_get_post( $id ) ?: $id );
	}

	return $id ? (string) get_permalink( $id ) : home_url( '/privacy-policy/' );
}

/**
 * Stop the Microsoft Clarity plugin from loading Clarity on every page; vzo__consent_script()
 * loads it after consent instead.
 */
function vzo__consent_unhook_clarity() {
	remove_action( 'wp_head', 'clarity_add_script_to_header' );
}
add_action( 'init', 'vzo__consent_unhook_clarity' );

/**
 * "Cookie settings" link (footer).
 */
function vzo__consent_settings_link() {
	printf(
		'<button type="button" class="consent-settings-link" data-consent-open>%s</button>',
		esc_html( vzo__consent_texts()['settings'] )
	);
}

/**
 * Banner markup and consent logic.
 */
function vzo__consent_script() {
	$texts   = vzo__consent_texts();
	$clarity = trim( (string) get_option( 'clarity_project_id' ) );
	?>
	<div class="consent-banner" id="vzo-consent" role="dialog" aria-labelledby="vzo-consent-title" aria-describedby="vzo-consent-text" hidden>
		<div class="consent-banner__inner">
			<h2 class="consent-banner__title" id="vzo-consent-title"><?php echo esc_html( $texts['title'] ); ?></h2>
			<p class="consent-banner__text" id="vzo-consent-text">
				<?php echo esc_html( $texts['text'] ); ?>
				<a href="<?php echo esc_url( vzo__consent_policy_url() ); ?>"><?php echo esc_html( $texts['policy'] ); ?></a>
			</p>
			<div class="consent-banner__buttons">
				<button type="button" class="consent-banner__button button outline-black" data-consent="necessary"><?php echo esc_html( $texts['reject'] ); ?></button>
				<button type="button" class="consent-banner__button button outline-black" data-consent="all"><?php echo esc_html( $texts['accept'] ); ?></button>
			</div>
		</div>
	</div>
	<script>
	(function () {
		var KEY = 'vzo_consent';
		var MAX_AGE = 365 * 24 * 60 * 60 * 1000; // Ask again after 12 months.
		var CLARITY_ID = <?php echo wp_json_encode( $clarity ); ?>;
		var banner = document.getElementById('vzo-consent');
		var clarityLoaded = false;

		function read() {
			try {
				var stored = JSON.parse(window.localStorage.getItem(KEY) || 'null');
				if (stored && (stored.choice === 'all' || stored.choice === 'necessary') && Date.now() - stored.at < MAX_AGE) {
					return stored.choice;
				}
				// Visitors who clicked "OK" on the old GlowCookies banner.
				if (!stored && window.localStorage.getItem('GlowCookies') === '1') {
					return save('all');
				}
			} catch (e) {}
			return null;
		}

		function save(choice) {
			try {
				window.localStorage.setItem(KEY, JSON.stringify({ choice: choice, at: Date.now() }));
				window.localStorage.removeItem('GlowCookies');
			} catch (e) {}
			return choice;
		}

		function loadClarity() {
			if (!CLARITY_ID || clarityLoaded) {
				return;
			}
			clarityLoaded = true;
			(function (c, l, a, r, i, t, y) {
				c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments); };
				t = l.createElement(r); t.async = 1; t.src = 'https://www.clarity.ms/tag/' + i + '?ref=wordpress';
				y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
			})(window, document, 'clarity', 'script', CLARITY_ID);
			window.clarity('consent');
		}

		function deleteCookies(pattern) {
			var host = window.location.hostname;
			var domains = ['', host, '.' + host, '.' + host.split('.').slice(-2).join('.')];
			document.cookie.split(';').forEach(function (part) {
				var name = part.split('=')[0].trim();
				if (pattern.test(name)) {
					domains.forEach(function (domain) {
						document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/' + (domain ? '; domain=' + domain : '');
					});
				}
			});
		}

		function apply(choice) {
			var granted = choice === 'all';
			if (typeof window.gtag === 'function') {
				window.gtag('consent', 'update', { analytics_storage: granted ? 'granted' : 'denied' });
			}
			if (granted) {
				loadClarity();
			} else {
				if (typeof window.clarity === 'function') {
					window.clarity('consent', false);
				}
				deleteCookies(/^(_ga|_gid|_gat|_clck|_clsk|CLID)/);
			}
			document.dispatchEvent(new CustomEvent('vzo:consent', { detail: { choice: choice } }));
		}

		function show() {
			banner.hidden = false;
			var first = banner.querySelector('[data-consent]');
			if (first) {
				first.focus({ preventScroll: true });
			}
		}

		banner.addEventListener('click', function (event) {
			var button = event.target.closest('[data-consent]');
			if (!button) {
				return;
			}
			apply(save(button.getAttribute('data-consent')));
			banner.hidden = true;
		});

		document.addEventListener('click', function (event) {
			if (event.target.closest && event.target.closest('[data-consent-open]')) {
				event.preventDefault();
				show();
			}
		});

		var choice = read();
		if (choice) {
			apply(choice);
		} else {
			banner.hidden = false;
		}
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'vzo__consent_script', 5 );
