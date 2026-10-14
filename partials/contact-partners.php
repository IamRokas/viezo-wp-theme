<?php
/**
 * Distributors & OEM partners (Contacts template).
 *
 * Lists are shared across languages (see vzo__get_shared_field()); titles are translatable.
 *
 * @package Viezo
 */

$vzo_partner_sections = [
	'distributors' => [
		'title' => get_field( 'field_contacts_distributors_title' ) ?: __( 'Distributors', 'viezo' ),
		'items' => vzo__get_shared_field( 'field_contacts_distributors' ),
	],
	'oem'          => [
		'title' => get_field( 'field_contacts_oem_partners_title' ) ?: __( 'OEM partner', 'viezo' ),
		'items' => vzo__get_shared_field( 'field_contacts_oem_partners' ),
	],
];

if ( empty( $vzo_partner_sections['distributors']['items'] ) && empty( $vzo_partner_sections['oem']['items'] ) ) {
	return;
}

/**
 * Render one partner card.
 *
 * @param array $partner  Repeater row (region, company, website, logo).
 * @param bool  $featured Wide horizontal layout.
 */
$vzo_partner_card = function ( $partner, $featured = false ) {
	$website = $partner['website'] ?? '';
	$host    = $website ? preg_replace( '#^www\.#', '', wp_parse_url( $website, PHP_URL_HOST ) ?: $website ) : '';
	$tag     = $website ? 'a' : 'div';
	$logo    = $partner['logo'] ?? null;
	?>
	<<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		class="partner-card<?php echo $featured ? ' partner-card--featured' : ''; ?>"
		<?php if ( $website ) : ?>
			href="<?php echo esc_url( $website ); ?>" target="_blank" rel="noopener"
		<?php endif; ?>
	>
		<div class="partner-card__logo">
			<?php if ( ! empty( $logo['ID'] ) ) : ?>
				<?php echo wp_get_attachment_image( $logo['ID'], 'medium', false, [ 'alt' => $partner['company'], 'loading' => 'lazy' ] ); ?>
			<?php else : ?>
				<span class="partner-card__logo-text"><?php echo esc_html( $partner['company'] ); ?></span>
			<?php endif; ?>
		</div>

		<div class="partner-card__body">
			<?php if ( ! empty( $partner['region'] ) ) : ?>
				<span class="partner-card__region"><?php echo esc_html( $partner['region'] ); ?></span>
			<?php endif; ?>
			<h3 class="partner-card__company"><?php echo esc_html( $partner['company'] ); ?></h3>
			<?php if ( $host ) : ?>
				<span class="partner-card__link"><?php echo esc_html( $host ); ?> <span aria-hidden="true">&rarr;</span></span>
			<?php endif; ?>
		</div>
	</<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
};
?>

<section class="contact-partners container pb-64">
	<?php if ( ! empty( $vzo_partner_sections['distributors']['items'] ) ) : ?>
		<div class="mb-48">
			<h2 class="contact-partners__title"><?php echo esc_html( $vzo_partner_sections['distributors']['title'] ); ?></h2>
			<div class="grid grid-cols-1 md:grid-cols-2 desktop:grid-cols-4 gap-20">
				<?php
				foreach ( $vzo_partner_sections['distributors']['items'] as $vzo_partner ) {
					$vzo_partner_card( $vzo_partner );
				}
				?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $vzo_partner_sections['oem']['items'] ) ) : ?>
		<div>
			<h2 class="contact-partners__title"><?php echo esc_html( $vzo_partner_sections['oem']['title'] ); ?></h2>
			<div class="grid grid-cols-1 gap-20">
				<?php
				foreach ( $vzo_partner_sections['oem']['items'] as $vzo_partner ) {
					$vzo_partner_card( $vzo_partner, true );
				}
				?>
			</div>
		</div>
	<?php endif; ?>
</section>
