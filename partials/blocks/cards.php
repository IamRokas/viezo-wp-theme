<?php
/**
 * Cards block — ACF flexible layout "cards".
 *
 * Fields: title, subtitle, cards (repeater: title, content), card_numbers (bool).
 */

$block         = $args['block'] ?? [];
$title         = $block['title'] ?? '';
$subtitle      = $block['subtitle'] ?? '';
$cards         = $block['cards'] ?? [];
$card_numbers  = ! empty( $block['card_numbers'] );

if ( empty( $cards ) || ! is_array( $cards ) ) {
	return;
}
?>
<section class="cards-block bg-white py-56 md:py-80 text-darkest-grey" aria-label="<?php echo esc_attr( $title ?: __( 'Cards', 'viezo' ) ); ?>">
	<div class="container">
		<?php if ( $title ) : ?>
			<h2 class="font-osp-din uppercase text-center mb-24"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php if ( $subtitle ) : ?>
			<div class="text-heading-sm font-extralight text-center mb-40 md:mb-48">
				<?php echo nl2br( esc_html( $subtitle ) ); ?>
			</div>
		<?php endif; ?>

		<div class="cards-block__grid grid grid-cols-1 md:grid-cols-2 gap-24 md:gap-28">
			<?php
			$n = 0;
			foreach ( $cards as $card ) :
				$n++;
				$card_title   = $card['title'] ?? '';
				$card_content = $card['content'] ?? '';
				?>
				<article class="cards-block__card h-full bg-light-grey border border-border-gray px-24 py-28 desktop:px-32 desktop:py-32">
					<header class="cards-block__card-head <?php echo $card_numbers ? 'flex gap-16 items-baseline' : ''; ?>">
						<?php if ( $card_numbers ) : ?>
							<span class="cards-block__index font-osp-din text-border-gray text-lg leading-none shrink-0 tabular-nums" aria-hidden="true"><?php echo esc_html( (string) $n ); ?></span>
						<?php endif; ?>
						<?php if ( $card_title ) : ?>
							<h3 class="text-lg font-osp-din uppercase tracking-wide mb-0"><?php echo esc_html( $card_title ); ?></h3>
						<?php endif; ?>
					</header>
					<?php if ( $card_content ) : ?>
						<div class="cards-block__content nice-list font-extralight text-base <?php echo ( $card_title || $card_numbers ) ? 'mt-16' : ''; ?>">
							<?php echo wp_kses_post( $card_content ); ?>
						</div>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
