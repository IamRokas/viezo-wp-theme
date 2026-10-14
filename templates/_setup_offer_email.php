<?php
/**
 * Email: confirmation to the person who submitted the pricing setup builder form.
 *
 * Sent by inc/setup-builder-email.php. Table layout + inline styles for email clients
 * (Outlook included). Colours follow the site: dark header, Viezo blue accent.
 *
 * @package Viezo
 *
 * @var array $args {
 *     @type string $lang          Language code.
 *     @type string $subject       Subject (also the preheader fallback).
 *     @type string $summary_title Heading of the summary box.
 *     @type string $body          Email text with {name} / {summary} placeholders.
 *     @type string $first_name    First name, may be empty.
 *     @type array  $summary       [ 'rows' => label => value, 'case' => array|null ].
 *     @type string $site_url      Home URL.
 *     @type string $footer        Footer text (may be empty).
 * }
 */

$vzo_dark   = '#222222';
$vzo_blue   = '#2a6278';
$vzo_text   = '#3a3a3a';
$vzo_muted  = '#8a8a8a';
$vzo_line   = '#e6e6e6';
$vzo_light  = '#f9f9f9';
$vzo_font   = "Helvetica, Arial, sans-serif";
$vzo_title  = "'Arial Narrow', 'Helvetica Neue', Arial, sans-serif";
$vzo_paras  = vzo__setup_builder_email_paragraphs( $args['body'], $args['first_name'] );
$vzo_intro  = $vzo_paras[1] ?? $args['subject']; // Preheader: the first sentence after the greeting.
$vzo_logo   = get_template_directory_uri() . '/build/images/logo.png';

/**
 * Paragraph HTML: escaped, line breaks kept, emails and URLs linked in the brand colour.
 */
$vzo_paragraph = function ( $text, $color = null ) use ( $vzo_blue ) {
	$color = $color ?: $vzo_blue;
	$html  = nl2br( esc_html( $text ) );
	$html  = preg_replace( '/\b([A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,})\b/i', '<a href="mailto:$1" style="color:' . $color . ';text-decoration:none;">$1</a>', $html );
	$html  = preg_replace( '/(?<![\/@.\w])((?:https?:\/\/)?www\.[a-z0-9.-]+\.[a-z]{2,}[^\s<]*)/i', '<a href="https://$1" style="color:' . $color . ';text-decoration:none;">$1</a>', $html );

	return str_replace( 'https://https://', 'https://', $html );
};
?>
<!DOCTYPE html>
<html lang="<?php echo esc_attr( $args['lang'] ); ?>" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="x-apple-disable-message-reformatting">
	<title><?php echo esc_html( $args['subject'] ); ?></title>
	<!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
	<style>
		@media only screen and (max-width: 620px) {
			.vzo-container { width: 100% !important; }
			.vzo-pad { padding-left: 24px !important; padding-right: 24px !important; }
		}
	</style>
</head>
<body style="margin:0;padding:0;background-color:<?php echo esc_attr( $vzo_light ); ?>;">
	<!-- Preheader (inbox preview text) -->
	<div style="display:none;max-height:0;overflow:hidden;mso-hide:all;"><?php echo esc_html( $vzo_intro ); ?></div>

	<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:<?php echo esc_attr( $vzo_light ); ?>;">
		<tr>
			<td align="center" style="padding:32px 12px;">
				<table role="presentation" class="vzo-container" width="600" cellspacing="0" cellpadding="0" border="0" style="width:600px;max-width:600px;background-color:#ffffff;border:1px solid <?php echo esc_attr( $vzo_line ); ?>;">

					<!-- Header -->
					<tr>
						<td class="vzo-pad" style="background-color:<?php echo esc_attr( $vzo_dark ); ?>;padding:24px 40px;">
							<a href="<?php echo esc_url( $args['site_url'] ); ?>" style="text-decoration:none;">
								<img src="<?php echo esc_url( $vzo_logo ); ?>" width="103" height="24" alt="VIEZO" style="display:block;border:0;color:#ffffff;font-family:<?php echo esc_attr( $vzo_title ); ?>;font-size:20px;letter-spacing:3px;">
							</a>
						</td>
					</tr>
					<tr>
						<td style="height:3px;line-height:3px;font-size:0;background-color:<?php echo esc_attr( $vzo_blue ); ?>;">&nbsp;</td>
					</tr>

					<!-- Body -->
					<tr>
						<td class="vzo-pad" style="padding:40px 40px 32px;font-family:<?php echo esc_attr( $vzo_font ); ?>;font-size:16px;line-height:1.6;color:<?php echo esc_attr( $vzo_text ); ?>;">
							<?php foreach ( $vzo_paras as $vzo_i => $vzo_para ) : ?>
								<?php if ( '{summary}' === $vzo_para ) : ?>

									<!-- Setup summary -->
									<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:8px 0 24px;background-color:<?php echo esc_attr( $vzo_light ); ?>;border-left:3px solid <?php echo esc_attr( $vzo_blue ); ?>;">
										<tr>
											<td style="padding:20px 24px 8px;font-family:<?php echo esc_attr( $vzo_title ); ?>;font-size:15px;font-weight:bold;letter-spacing:1.5px;text-transform:uppercase;color:#000000;">
												<?php echo esc_html( $args['summary_title'] ); ?>
											</td>
										</tr>
										<?php
										// Stacked rows (label above value): readable on any screen without media queries,
										// which some mail apps strip.
										$vzo_rows = $args['summary']['rows'];
										if ( $args['summary']['case'] ) {
											$vzo_rows[ $args['summary']['case']['label'] ] = $args['summary']['case'];
										}
										?>
										<?php foreach ( $vzo_rows as $vzo_label => $vzo_value ) : ?>
											<tr>
												<td style="padding:0 24px;">
													<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-top:1px solid <?php echo esc_attr( $vzo_line ); ?>;">
														<tr>
															<td style="padding:10px 0 2px;font-family:<?php echo esc_attr( $vzo_font ); ?>;font-size:12px;line-height:1.4;letter-spacing:0.3px;color:<?php echo esc_attr( $vzo_muted ); ?>;"><?php echo esc_html( $vzo_label ); ?></td>
														</tr>
														<tr>
															<td style="padding:0 0 10px;font-family:<?php echo esc_attr( $vzo_font ); ?>;font-size:15px;line-height:1.45;color:#000000;">
																<?php if ( is_array( $vzo_value ) ) : ?>
																	<?php echo esc_html( $vzo_value['title'] ); ?>
<br><a href="<?php echo esc_url( $vzo_value['url'] ); ?>" style="font-size:14px;color:<?php echo esc_attr( $vzo_blue ); ?>;text-decoration:none;white-space:nowrap;"><?php echo esc_html( $vzo_value['link'] ); ?>&nbsp;&rarr;</a>
																<?php else : ?>
																	<?php echo esc_html( $vzo_value ); ?>
																<?php endif; ?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										<?php endforeach; ?>
										<tr><td style="height:12px;line-height:12px;font-size:0;">&nbsp;</td></tr>
									</table>

								<?php else : ?>
									<p style="margin:0 0 16px;<?php echo 0 === $vzo_i ? 'font-family:' . esc_attr( $vzo_title ) . ';font-size:22px;font-weight:bold;letter-spacing:0.5px;color:#000000;' : ''; ?>">
										<?php echo $vzo_paragraph( $vzo_para ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>
									</p>
								<?php endif; ?>
							<?php endforeach; ?>
						</td>
					</tr>

					<!-- Footer -->
					<?php if ( '' !== trim( $args['footer'] ) ) : ?>
						<tr>
							<td class="vzo-pad" style="padding:20px 40px;border-top:1px solid <?php echo esc_attr( $vzo_line ); ?>;font-family:<?php echo esc_attr( $vzo_font ); ?>;font-size:12px;line-height:1.5;color:<?php echo esc_attr( $vzo_muted ); ?>;">
								<?php echo $vzo_paragraph( $args['footer'], $vzo_muted ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
							</td>
						</tr>
					<?php endif; ?>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
