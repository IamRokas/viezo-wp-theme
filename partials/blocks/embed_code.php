<?php
/**
 * Embed code block — ACF flexible layout "embed_code".
 *
 * Fields: title (text), subtitle (text), embed_code (raw HTML/JS for third-party embeds).
 */

$block       = $args['block'] ?? [];
$title       = $block['title'] ?? '';
$subtitle    = $block['subtitle'] ?? '';
$embed_code  = $block['embed_code'] ?? '';

if ( '' === trim( (string) $embed_code ) && '' === trim( (string) $subtitle ) && '' === trim( (string) $title ) ) {
	return;
}
?>
<section class="embed-code-block bg-dark-grey py-56 md:py-80 text-white" aria-label="<?php echo esc_attr( $title ?: __( 'Embed', 'viezo' ) ); ?>">
	<div class="container max-w-[900px]">
		<?php if ( $title ) : ?>
			<h2 class="font-osp-din uppercase text-center mb-24"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php if ( $subtitle ) : ?>
			<div class="embed-code-block__subtitle text-heading-sm font-extralight text-center mb-32 md:mb-40">
				<?php echo nl2br( esc_html( $subtitle ) ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $embed_code ) : ?>
			<div class="embed-code-block__embed max-w-[500px] w-full mx-auto">
				<?php echo $embed_code; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Third-party embed markup/scripts from trusted ACF input. ?>
			</div>
		<?php endif; ?>
	</div>
</section>
