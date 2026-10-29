<?php
/**
 * Google Analytics 4 (gtag.js) with Google Consent Mode v2.
 *
 * - Measurement ID: Settings → Viezo Settings → Analytics (field "GA4 Measurement ID"),
 *   falling back to VZO_GA4_DEFAULT_ID. Enter "off" to disable.
 * - Analytics cookies stay off until the visitor clicks "Accept all" in the cookie banner
 *   (inc/consent.php, localStorage "vzo_consent"); until then GA4 only receives cookieless pings.
 *   The banner sends the consent updates (grant, or revoke from "Cookie settings").
 *   Ads storage is always denied (no ads tracking on this site).
 * - The setup builder (src/js/templates/setup-builder.js) sends its funnel events via gtag().
 *
 * @package Viezo
 */

const VZO_GA4_DEFAULT_ID = 'G-3NFFVXWCVK';

/**
 * Active GA4 Measurement ID, or '' when disabled / not set.
 *
 * @return string
 */
function vzo__ga4_id() {
	$id = function_exists( 'get_field' ) ? trim( (string) get_field( 'field_vzo_ga4_id', 'option' ) ) : '';

	if ( '' === $id ) {
		$id = VZO_GA4_DEFAULT_ID;
	}

	return preg_match( '/^G-[A-Z0-9]{4,20}$/i', $id ) ? strtoupper( $id ) : '';
}

/**
 * Print the GA4 tag early in <head>.
 */
function vzo__ga4_tag() {
	$id = vzo__ga4_id();

	if ( ! $id ) {
		return;
	}
	?>
	<!-- Google Analytics 4 (Consent Mode: analytics cookies only after "Accept all" in the cookie banner) -->
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	(function () {
		var accepted = false;
		try {
			var stored = JSON.parse(window.localStorage.getItem('vzo_consent') || 'null');
			accepted = stored ? stored.choice === 'all' && Date.now() - stored.at < 31536000000 : window.localStorage.getItem('GlowCookies') === '1';
		} catch (e) {}
		gtag('consent', 'default', {
			analytics_storage: accepted ? 'granted' : 'denied',
			ad_storage: 'denied',
			ad_user_data: 'denied',
			ad_personalization: 'denied',
			wait_for_update: 500
		});
	})();
	gtag('js', new Date());
	gtag('config', <?php echo wp_json_encode( $id ); ?>);
	</script>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( rawurlencode( $id ) ); ?>"></script>
	<?php
}
add_action( 'wp_head', 'vzo__ga4_tag', 1 );
