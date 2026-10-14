<?php
/**
 * Pricing "Setup builder": 4-question wizard → estimated setup + matched case study → lead form.
 *
 * Content: ACF group "Pricing: Setup builder", read through vzo__setup_builder_config() (inc/setup-builder.php). Behaviour and funnel tracking: src/js/templates/setup-builder.js.
 * The header CTA ("Build my setup") links to #setup-builder.
 *
 * @package Viezo
 */

$vzo_setup     = vzo__setup_builder_config();
$vzo_t         = $vzo_setup['texts'];
$vzo_questions = $vzo_setup['questions'];
$vzo_form_id   = $vzo_setup['form_id'];
$vzo_total     = count( $vzo_questions ) + 1; // + machines step.
$vzo_stops     = $vzo_setup['stops'];
$vzo_default   = $vzo_setup['default'];
$vzo_library   = vzo__setup_builder_icons();

$vzo_icon = function ( $paths, $class = 'setup-icon' ) {
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths . '</svg>';
};

$vzo_icons = [
	'points'    => '<path d="M3 8l9-4 9 4-9 4z"/><path d="M3 12l9 4 9-4M3 16l9 4 9-4"/>',
	'gateway'   => '<circle cx="12" cy="12" r="1.5"/><path d="M8.5 8.5a5 5 0 000 7M15.5 8.5a5 5 0 010 7M5.6 5.6a9 9 0 000 12.8M18.4 5.6a9 9 0 010 12.8"/>',
	'industry'  => '<path d="M2 21h20M4 21V10l5 3.5V10l5 3.5V10l5 3.5V3h2v18"/>',
	'equipment' => '<circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="7"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.9 4.9L7 7M17 17l2.1 2.1M4.9 19.1L7 17M17 7l2.1-2.1"/>',
	'challenge' => '<path d="M12 3L2 20h20z"/><path d="M12 9.5v4.5M12 16.8v.2"/>',
	'machines'  => '<path d="M3 21h18M5 21v-6h3v6M10.5 21V9h3v12M16 21V4h3v17"/>',
	'info'      => '<circle cx="12" cy="12" r="9"/><path d="M12 11v5.5M12 7.8v.2"/>',
	'mail'      => '<rect x="3" y="5" width="18" height="14" rx="1.5"/><path d="M3.5 6l8.5 7 8.5-7"/>',
	'lock'      => '<rect x="5" y="11" width="14" height="10" rx="1.5"/><path d="M8 11V8a4 4 0 018 0v3"/>',
	'edit'      => '<path d="M4 20h4L19 9l-4-4L4 16z"/><path d="M13.5 6.5l4 4"/>',
];

$vzo_config = [
	'lang'              => $vzo_setup['lang'],
	'questions'         => array_map(
		function ( $question ) {
			return [
				'key'     => $question['key'],
				'options' => wp_list_pluck( $question['options'], 'label', 'key' ),
			];
		},
		$vzo_questions
	),
	'cases'             => $vzo_setup['cases'],
	'fields'            => vzo__setup_builder_form_fields(),
	'logUrl'            => rest_url( 'viezo/v1/setup-event' ),
	'stops'             => $vzo_stops,
	'sensorsPerGateway' => $vzo_setup['sensors'],
	'i18n'              => [
		'step'   => $vzo_t['step_label'],
		'result' => $vzo_t['result_counter'],
		'offer'  => $vzo_t['offer_counter'],
		'next'   => $vzo_t['next_label'],
		'show'   => $vzo_t['show_result_label'],
	],
];
?>

<section class="setup-builder" id="setup-builder" aria-label="<?php echo esc_attr( $vzo_t['eyebrow'] ); ?>" data-setup-builder>
	<div class="container">
		<div class="setup-builder__card">

			<div class="setup-builder__head">
				<span class="setup-builder__eyebrow"><?php echo esc_html( $vzo_t['eyebrow'] ); ?></span>
				<div class="setup-builder__progress" aria-hidden="true">
					<?php for ( $vzo_i = 0; $vzo_i < $vzo_total; $vzo_i++ ) : ?>
						<span></span>
					<?php endfor; ?>
				</div>
				<span class="setup-builder__counter" aria-live="polite" data-setup-counter>
					<?php echo esc_html( vzo__setup_builder_format( $vzo_t['step_label'], [ 'current' => 1, 'total' => $vzo_total ] ) ); ?>
				</span>
			</div>

			<form class="setup-builder__questions" novalidate data-setup-questions>
				<?php foreach ( $vzo_questions as $vzo_index => $vzo_question ) : ?>
					<fieldset class="setup-builder__step" data-step="<?php echo esc_attr( $vzo_question['key'] ); ?>"<?php echo $vzo_index ? ' hidden' : ''; ?>>
						<legend class="setup-builder__title"><?php echo esc_html( $vzo_question['title'] ); ?></legend>
						<p class="setup-builder__subtitle"><?php echo esc_html( $vzo_question['subtitle'] ); ?></p>

						<div class="setup-builder__options">
							<?php foreach ( $vzo_question['options'] as $vzo_option ) : ?>
								<label class="setup-option">
									<input
										class="setup-option__input"
										type="<?php echo $vzo_question['multiple'] ? 'checkbox' : 'radio'; ?>"
										name="<?php echo esc_attr( $vzo_question['key'] ); ?>"
										value="<?php echo esc_attr( $vzo_option['key'] ); ?>">
									<span class="setup-option__box">
										<span class="setup-option__check" aria-hidden="true"></span>
										<?php if ( isset( $vzo_library[ $vzo_option['icon'] ] ) ) : ?>
											<?php echo $vzo_icon( $vzo_library[ $vzo_option['icon'] ][1], 'setup-option__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
										<?php endif; ?>
										<span class="setup-option__label"><?php echo esc_html( $vzo_option['label'] ); ?></span>
									</span>
								</label>
							<?php endforeach; ?>
						</div>
					</fieldset>
				<?php endforeach; ?>

				<fieldset class="setup-builder__step" data-step="machines" hidden>
					<legend class="setup-builder__title"><?php echo esc_html( $vzo_t['machines_title'] ); ?></legend>
					<p class="setup-builder__subtitle"><?php echo esc_html( $vzo_t['machines_subtitle'] ); ?></p>

					<div class="setup-range">
						<output class="setup-range__value" for="setup-machines" data-setup-machines-value><?php echo (int) $vzo_default; ?></output>
						<span class="setup-range__unit"><?php echo esc_html( $vzo_t['machines_unit'] ); ?></span>

						<input
							class="setup-range__input"
							id="setup-machines"
							type="range"
							min="0"
							max="100"
							step="1"
							value="0"
							aria-label="<?php echo esc_attr( $vzo_t['machines_summary'] ); ?>"
							data-default="<?php echo (int) $vzo_default; ?>"
							data-setup-machines>

						<div class="setup-range__ticks" aria-hidden="true">
							<?php foreach ( $vzo_stops as $vzo_i => $vzo_stop ) : ?>
								<span><?php echo esc_html( $vzo_stop . ( count( $vzo_stops ) - 1 === $vzo_i ? '+' : '' ) ); ?></span>
							<?php endforeach; ?>
						</div>
					</div>

					<p class="setup-builder__note">
						<?php echo $vzo_icon( $vzo_icons['info'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
						<span>
							<?php echo esc_html( vzo__setup_builder_format( $vzo_t['machines_note'], [ 'sensors' => $vzo_setup['sensors'] ] ) ); ?>
						</span>
					</p>
				</fieldset>
			</form>

			<div class="setup-builder__step setup-result" data-step="result" tabindex="-1" hidden>
				<h2 class="setup-builder__title"><?php echo esc_html( $vzo_t['result_title'] ); ?></h2>
				<p class="setup-builder__subtitle"><?php echo esc_html( $vzo_t['result_subtitle'] ); ?></p>

				<dl class="setup-result__stats">
					<div class="setup-result__stat">
						<?php echo $vzo_icon( $vzo_icons['points'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
						<dd><span class="setup-approx">~</span> <span data-setup-out="points"></span></dd>
						<dt><?php echo esc_html( $vzo_t['points_label'] ); ?></dt>
					</div>
					<div class="setup-result__stat">
						<?php echo $vzo_icon( $vzo_icons['gateway'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
						<dd><span class="setup-approx">~</span> <span data-setup-out="gateways"></span></dd>
						<dt><?php echo esc_html( $vzo_t['gateways_label'] ); ?></dt>
					</div>
				</dl>

				<article class="setup-case" data-setup-case hidden>
					<a class="setup-case__media" href="#" tabindex="-1" aria-hidden="true" data-case-link>
						<img src="" alt="" loading="lazy" data-case-image>
						<span class="setup-case__tag" data-case-tag></span>
					</a>
					<div class="setup-case__body">
						<span class="setup-case__eyebrow"><?php echo esc_html( $vzo_t['case_eyebrow'] ); ?></span>
						<h3 class="setup-case__title" data-case-machine></h3>
						<dl class="setup-case__facts">
							<div>
								<dt><?php echo esc_html( $vzo_t['detected_label'] ); ?></dt>
								<dd data-case-detected></dd>
							</div>
							<div>
								<dt><?php echo esc_html( $vzo_t['outcome_label'] ); ?></dt>
								<dd data-case-outcome></dd>
							</div>
						</dl>
						<a class="setup-case__more" href="#" data-case-link><?php echo esc_html( $vzo_t['case_link_label'] ); ?> <span aria-hidden="true">&rarr;</span></a>
					</div>
				</article>

				<div class="setup-result__cta">
					<?php echo $vzo_icon( $vzo_icons['mail'], 'setup-icon setup-result__cta-icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					<div class="setup-result__cta-text">
						<h3><?php echo esc_html( $vzo_t['cta_title'] ); ?></h3>
						<p><?php echo esc_html( $vzo_t['cta_text'] ); ?></p>
					</div>
					<button type="button" class="button setup-button setup-button--light" data-setup-offer><?php echo esc_html( $vzo_t['cta_button'] ); ?> <span aria-hidden="true">&rarr;</span></button>
				</div>
			</div>

			<div class="setup-builder__step setup-offer" data-step="offer" tabindex="-1" hidden>
				<div class="setup-offer__main">
					<span class="setup-builder__eyebrow"><?php echo esc_html( $vzo_t['offer_eyebrow'] ); ?></span>
					<h2 class="setup-builder__title"><?php echo esc_html( $vzo_t['offer_title'] ); ?></h2>
					<p class="setup-builder__subtitle"><?php echo esc_html( $vzo_t['offer_subtitle'] ); ?></p>

					<div class="setup-offer__form" data-setup-form>
						<?php
						if ( $vzo_form_id ) {
							echo do_shortcode( '[wpforms id="' . $vzo_form_id . '" title="false" description="false"]' );
						} elseif ( current_user_can( 'manage_options' ) ) {
							printf(
								'<p class="setup-offer__missing">%s</p>',
								esc_html( 'No lead form found. Pick one under "Lead form" or run the "pricing-setup" seed in Tools → Viezo seeds.' )
							);
						}
						?>
					</div>

					<p class="setup-offer__privacy">
						<?php echo $vzo_icon( $vzo_icons['lock'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
						<?php echo esc_html( $vzo_t['privacy_note'] ); ?>
					</p>
				</div>

				<aside class="setup-summary" aria-labelledby="setup-summary-title">
					<div class="setup-summary__head">
						<h3 class="setup-summary__title" id="setup-summary-title"><?php echo esc_html( $vzo_t['summary_title'] ); ?></h3>
						<button type="button" class="setup-summary__edit" data-setup-edit>
							<?php echo $vzo_icon( $vzo_icons['edit'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
							<?php echo esc_html( $vzo_t['edit_label'] ); ?>
						</button>
					</div>

					<dl class="setup-summary__list">
						<?php foreach ( $vzo_questions as $vzo_question ) : ?>
							<div class="setup-summary__item">
								<?php echo $vzo_icon( $vzo_icons[ $vzo_question['key'] ] ?? $vzo_icons['equipment'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
								<dt><?php echo esc_html( $vzo_question['summary'] ); ?></dt>
								<dd data-setup-out="<?php echo esc_attr( $vzo_question['key'] ); ?>"></dd>
							</div>
						<?php endforeach; ?>
						<div class="setup-summary__item">
							<?php echo $vzo_icon( $vzo_icons['machines'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
							<dt><?php echo esc_html( $vzo_t['machines_summary'] ); ?></dt>
							<dd data-setup-out="machines"></dd>
						</div>
						<div class="setup-summary__item">
							<?php echo $vzo_icon( $vzo_icons['points'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
							<dt><?php echo esc_html( $vzo_t['estimate_label'] ); ?></dt>
							<dd>
								<span class="setup-approx">~</span> <span data-setup-out="points"></span> <?php echo esc_html( $vzo_t['points_label'] ); ?><br>
								<span class="setup-approx">~</span> <span data-setup-out="gateways"></span> <?php echo esc_html( $vzo_t['gateways_label'] ); ?>
							</dd>
						</div>
					</dl>

					<a class="setup-summary__case" href="#" data-setup-case data-case-link hidden>
						<img src="" alt="" loading="lazy" data-case-image>
						<span>
							<span class="setup-summary__case-label"><?php echo esc_html( $vzo_t['summary_case_label'] ); ?></span>
							<span class="setup-summary__case-title" data-case-machine></span>
							<span class="setup-summary__case-more"><?php echo esc_html( $vzo_t['summary_case_link'] ); ?> <span aria-hidden="true">&rarr;</span></span>
						</span>
					</a>
				</aside>
			</div>

			<div class="setup-builder__nav" data-setup-nav>
				<button type="button" class="setup-builder__back" data-setup-back hidden>
					<span aria-hidden="true">&larr;</span> <?php echo esc_html( $vzo_t['back_label'] ); ?>
				</button>
				<button type="button" class="button setup-button" data-setup-next disabled>
					<span data-setup-next-label><?php echo esc_html( $vzo_t['next_label'] ); ?></span> <span aria-hidden="true">&rarr;</span>
				</button>
			</div>
		</div>
	</div>

	<script type="application/json" data-setup-config><?php echo wp_json_encode( $vzo_config ); ?></script>
</section>
