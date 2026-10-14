<?php
/**
 * "Live Sonora network" section (Home template, under the hero).
 *
 * Content: ACF group "Home: Live Sonora network" (acf-json/field-groups/home-live-sonora-network.json).
 * Empty fields on a translation fall back to the default-language (English) home page,
 * see vzo__get_shared_field(). Initial content: seeds/home-live-sonora.php.
 * The machine scene is animated by src/js/blocks/live-sonora.js.
 *
 * @package Viezo
 */

// Look fields up by key (not name): works on translations even when Polylang copied
// the values without ACF's field reference meta.
$vzo_field = function ( $name ) {
	return vzo__get_shared_field( 'field_live_sonora_' . $name );
};

if ( $vzo_field( 'hidden' ) || ! $vzo_field( 'title' ) ) {
	return;
}

/**
 * Case study in the current language (Polylang), as [ url, published ].
 *
 * @param int $id Case study ID (any language).
 * @return string Permalink, or empty string.
 */
$vzo_case_url = function ( $id ) {
	$id = (int) $id;

	if ( $id && function_exists( 'pll_get_post' ) ) {
		$id = pll_get_post( $id ) ?: $id;
	}

	return $id && 'publish' === get_post_status( $id ) ? get_permalink( $id ) : '';
};

// Machine icons: 64×40 line drawings, stroke = currentColor. Keys match the ACF "Icon" choices.
$vzo_icons = [
	'pump'       => '<circle cx="22" cy="20" r="11"/><circle cx="22" cy="20" r="4"/><path d="M33 15h14v10H33M47 17h8v6h-8M4 20h7M16 31v6M28 31v6"/>',
	'fan'        => '<circle cx="20" cy="20" r="14"/><circle cx="20" cy="20" r="2.5"/><path d="M20 17.5c-1-6 2-10 6-9M22.5 20c6-1 10 2 9 6M20 22.5c1 6-2 10-6 9M17.5 20c-6 1-10-2-9-6M34 15h16v10H34"/>',
	'gearbox'    => '<rect x="4" y="9" width="26" height="20"/><circle cx="12" cy="19" r="5"/><circle cx="22" cy="19" r="5"/><path d="M30 14h14l12 5-12 5H30M9 29v6M25 29v6"/>',
	'motor'      => '<rect x="4" y="12" width="28" height="18" rx="3"/><path d="M12 12V7h12v5M32 17h8v8h-8M10 30v5M26 30v5"/><circle cx="50" cy="21" r="6"/><path d="M40 21h4"/>',
	'compressor' => '<rect x="4" y="16" width="40" height="16" rx="8"/><path d="M12 16V8h8v8M26 16V8h8v8M10 32v4M38 32v4M44 24h8M52 20v8"/>',
	'spindle'    => '<rect x="4" y="13" width="24" height="16" rx="2"/><path d="M28 17h14v8H28M42 19h6v4h-6"/><circle cx="54" cy="21" r="6"/><path d="M54 13v2M54 27v2M46 21h2M60 21h2"/>',
];

// Machine scene: image + measuring points (one of them develops a fault on scroll).
// Image, positions and values come from the English page; texts from this language (inc/live-sonora.php).
// Without a chosen image, fall back to the bundled default photo (the seeded positions match it).
$vzo_scene_image = vzo__live_sonora_scene_image( get_the_ID() );
$vzo_points      = vzo__live_sonora_points( get_the_ID() );
$vzo_yes_no      = array_pad( explode( '|', (string) ( $vzo_field( 'label_yes_no' ) ?: 'Yes|No' ) ), 2, '' );
$vzo_number      = function ( $value, $decimals = 0 ) {
	return number_format_i18n( (float) $value, $decimals );
};

$vzo_buttons   = array_filter( [ $vzo_field( 'primary_link' ), $vzo_field( 'secondary_link' ) ] );
$vzo_more      = $vzo_field( 'machines_link' ) ?: [
	'url'    => get_post_type_archive_link( 'case-study' ),
	'title'  => __( 'All cases', 'viezo' ),
	'target' => '',
];
$vzo_machines  = $vzo_field( 'machines' ) ?: [];
$vzo_target    = function ( $link ) {
	return ! empty( $link['target'] ) ? ' target="' . esc_attr( $link['target'] ) . '" rel="noopener"' : '';
};
?>

<section class="live-sonora" aria-labelledby="live-sonora-title">
	<div class="container">
		<div class="live-sonora__top">
			<div class="live-sonora__intro-head">
				<?php if ( $vzo_field( 'eyebrow' ) ) : ?>
					<p class="live-sonora__eyebrow">
						<span class="live-dot" aria-hidden="true"></span>
						<?php echo esc_html( $vzo_field( 'eyebrow' ) ); ?>
					</p>
				<?php endif; ?>

				<h2 id="live-sonora-title" class="live-sonora__title font-osp-din uppercase mb-16"><?php echo esc_html( $vzo_field( 'title' ) ); ?></h2>
			</div>

			<div class="live-sonora__intro-body">
				<?php if ( $vzo_field( 'text' ) ) : ?>
					<p class="live-sonora__lead"><?php echo esc_html( $vzo_field( 'text' ) ); ?></p>
				<?php endif; ?>

				<?php if ( $vzo_buttons ) : ?>
					<div class="live-sonora__actions">
						<?php foreach ( $vzo_buttons as $vzo_button ) : ?>
							<a class="button outline-black" href="<?php echo esc_url( $vzo_button['url'] ); ?>"<?php echo $vzo_target( $vzo_button ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $vzo_button['title'] ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="live-sonora__scene" data-live-sonora>
			<?php if ( $vzo_scene_image || $vzo_points ) : ?>
				<div class="live-sonora__scene-media">
					<div class="live-sonora__scene-frame">
						<?php if ( $vzo_scene_image ) : ?>
							<?php
							echo wp_get_attachment_image(
								$vzo_scene_image,
								'full',
								false,
								[
									'class'   => 'live-sonora__scene-image',
									'sizes'   => '(min-width: 1200px) 1140px, 100vw',
									'loading' => 'lazy',
								]
							);
							?>
						<?php else : ?>
							<?php $vzo_default = vzo__live_sonora_default_image(); ?>
							<img class="live-sonora__scene-image" src="<?php echo esc_url( $vzo_default['url'] ); ?>" width="<?php echo (int) $vzo_default['width']; ?>" height="<?php echo (int) $vzo_default['height']; ?>" alt="" loading="lazy">
						<?php endif; ?>

						<span class="live-sonora__badge">
							<span class="live-dot" aria-hidden="true"></span>
							<span class="live-sonora__badge-title"><?php echo esc_html( $vzo_field( 'panel_title' ) ); ?></span>
							<span class="live-sonora__badge-status"><?php echo esc_html( $vzo_field( 'panel_status' ) ); ?></span>
						</span>

						<?php foreach ( $vzo_points as $vzo_i => $vzo_point ) : ?>
							<button type="button" class="scene-point<?php echo $vzo_point['fault'] ? ' scene-point--fault' : ''; ?>" style="--x: <?php echo esc_attr( (float) $vzo_point['x'] ); ?>%; --y: <?php echo esc_attr( (float) $vzo_point['y'] ); ?>%; --i: <?php echo (int) $vzo_i; ?>;" data-point="<?php echo (int) $vzo_i; ?>" aria-controls="scene-card-<?php echo (int) $vzo_i; ?>" aria-expanded="false">
								<span class="scene-point__num" aria-hidden="true"><?php echo (int) $vzo_i + 1; ?></span>
								<span class="screen-reader-text"><?php echo esc_html( $vzo_point['name'] ); ?></span>
							</button>
						<?php endforeach; ?>
					</div>

					<?php if ( $vzo_points ) : ?>
						<div class="live-sonora__scene-cards">
							<?php foreach ( $vzo_points as $vzo_i => $vzo_point ) : ?>
								<?php
								$vzo_fault   = $vzo_point['fault'];
								$vzo_case    = $vzo_fault ? $vzo_case_url( $vzo_point['fault_case_study'] ) : '';
								$vzo_rms     = $vzo_point['rms'];
								$vzo_temp    = $vzo_point['temperature'];
								$vzo_rms_to  = $vzo_point['fault_rms'];
								$vzo_temp_to = $vzo_point['fault_temperature'];
								$vzo_classes = 'scene-card scene-card--' . $vzo_point['side'] . ( $vzo_point['below'] ? ' scene-card--below' : '' ) . ( $vzo_fault ? ' scene-card--fault' : '' );
								?>
								<div id="scene-card-<?php echo (int) $vzo_i; ?>" class="<?php echo esc_attr( $vzo_classes ); ?>" style="--x: <?php echo esc_attr( (float) $vzo_point['x'] ); ?>%; --y: <?php echo esc_attr( (float) $vzo_point['y'] ); ?>%; --i: <?php echo (int) $vzo_i; ?>;" data-card="<?php echo (int) $vzo_i; ?>">
									<button type="button" class="scene-card__head" data-point="<?php echo (int) $vzo_i; ?>" aria-expanded="false" aria-controls="scene-card-body-<?php echo (int) $vzo_i; ?>">
										<span class="scene-card__num"><?php echo (int) $vzo_i + 1; ?></span>
										<span class="scene-card__title">
											<span class="scene-card__name">
												<?php echo esc_html( $vzo_point['name'] ); ?>
											</span>
											<span class="scene-card__status">
												<span class="scene-card__status-ok"><?php echo esc_html( $vzo_field( 'status_ok' ) ); ?></span>
												<?php if ( $vzo_fault ) : ?>
													<span class="scene-card__status-fault"><?php echo esc_html( $vzo_field( 'status_fault' ) ); ?></span>
												<?php endif; ?>
											</span>
										</span>
										<span class="scene-card__chevron" aria-hidden="true"></span>
									</button>

									<div class="scene-card__body" id="scene-card-body-<?php echo (int) $vzo_i; ?>">
										<div class="scene-card__body-inner">
										<dl class="scene-card__rows">
											<div class="scene-card__row scene-card__row--alert">
												<dt><?php echo esc_html( $vzo_field( 'label_rms' ) ); ?></dt>
												<dd><span data-from="<?php echo esc_attr( $vzo_rms ); ?>" data-to="<?php echo esc_attr( $vzo_rms_to ); ?>" data-decimals="1"><?php echo esc_html( $vzo_number( $vzo_rms, 1 ) ); ?></span> mm/s</dd>
											</div>
											<div class="scene-card__row scene-card__row--alert">
												<dt><?php echo esc_html( $vzo_field( 'label_temperature' ) ); ?></dt>
												<dd><span data-from="<?php echo esc_attr( $vzo_temp ); ?>" data-to="<?php echo esc_attr( $vzo_temp_to ); ?>" data-decimals="0"><?php echo esc_html( $vzo_number( $vzo_temp ) ); ?></span> °C</dd>
											</div>
											<div class="scene-card__row scene-card__row--alert">
												<dt><?php echo esc_html( $vzo_field( 'label_harmonics' ) ); ?></dt>
												<dd>
													<?php if ( $vzo_fault ) : ?>
														<span class="scene-card__before"><?php echo esc_html( $vzo_point['harmonics'] ? $vzo_yes_no[0] : $vzo_yes_no[1] ); ?></span>
														<span class="scene-card__after"><?php echo esc_html( $vzo_yes_no[0] ); ?></span>
													<?php else : ?>
														<?php echo esc_html( $vzo_point['harmonics'] ? $vzo_yes_no[0] : $vzo_yes_no[1] ); ?>
													<?php endif; ?>
												</dd>
											</div>
											<?php if ( ! empty( $vzo_point['last_measurement'] ) ) : ?>
												<div class="scene-card__row">
													<dt><?php echo esc_html( $vzo_field( 'label_last' ) ); ?></dt>
													<dd><?php echo esc_html( $vzo_point['last_measurement'] ); ?></dd>
												</div>
											<?php endif; ?>
										</dl>

										<?php if ( $vzo_fault && ! empty( $vzo_point['fault_issue'] ) ) : ?>
											<div class="scene-card__issue">
												<svg viewBox="0 0 24 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M1 8h4l2-5 3 10 3-12 3 12 2-5h5"/></svg>
												<span>
													<span class="scene-card__issue-label"><?php echo esc_html( $vzo_field( 'label_issue' ) ); ?></span>
													<?php echo esc_html( $vzo_point['fault_issue'] ); ?>
												</span>
											</div>
											<?php if ( $vzo_case ) : ?>
												<a class="scene-card__link" href="<?php echo esc_url( $vzo_case ); ?>"><?php echo esc_html( $vzo_point['fault_link_label'] ?: __( 'View defect', 'viezo' ) ); ?> <span aria-hidden="true">&rarr;</span></a>
											<?php endif; ?>
										<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $vzo_machines ) : ?>
			<div class="live-sonora__machines">
				<div class="live-sonora__machines-head">
					<span class="live-sonora__label"><?php echo esc_html( $vzo_field( 'machines_label' ) ); ?></span>
					<?php if ( $vzo_field( 'machines_subtitle' ) ) : ?>
						<span class="live-sonora__machines-sub"><?php echo esc_html( $vzo_field( 'machines_subtitle' ) ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $vzo_more['url'] ) ) : ?>
						<a class="live-sonora__more" href="<?php echo esc_url( $vzo_more['url'] ); ?>"<?php echo $vzo_target( $vzo_more ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $vzo_more['title'] ); ?> <span aria-hidden="true">&rarr;</span></a>
					<?php endif; ?>
				</div>

				<ul class="live-sonora__machine-list">
					<?php foreach ( $vzo_machines as $vzo_machine ) : ?>
						<?php
						$vzo_url  = $vzo_case_url( $vzo_machine['case_study'] ?? 0 );
						$vzo_tag  = $vzo_url ? 'a' : 'div';
						$vzo_icon = $vzo_icons[ $vzo_machine['icon'] ?? '' ] ?? $vzo_icons['motor'];
						?>
						<li>
							<<?php echo $vzo_tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="live-sonora__machine"<?php echo $vzo_url ? ' href="' . esc_url( $vzo_url ) . '"' : ''; ?>>
								<svg class="live-sonora__machine-icon" viewBox="0 0 64 40" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
									<?php echo $vzo_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG above. ?>
								</svg>
								<span class="live-sonora__machine-text">
									<span class="live-sonora__machine-name"><?php echo esc_html( $vzo_machine['name'] ); ?></span>
									<?php if ( ! empty( $vzo_machine['type'] ) ) : ?>
										<span class="live-sonora__machine-type"><?php echo esc_html( $vzo_machine['type'] ); ?></span>
									<?php endif; ?>
								</span>
								<span class="live-sonora__machine-point" aria-hidden="true"></span>
							</<?php echo $vzo_tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</section>
