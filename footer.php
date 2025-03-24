<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Viezo
 */

?>

<!-- Get in touch block -->
<?php
$title = get_field('get_in_touch_title', 'options');
$subtitle = get_field('get_in_touch_subtitle', 'options');
$bg = get_field('get_in_touch_bg', 'options'); //image id

$bg_style = '';
if (!empty($bg)) {
	$bg_url = wp_get_attachment_image_url($bg, 'full');
	if ($bg_url) {
		$bg_style = 'style="background-image: url(' . esc_url($bg_url) . '); background-size: cover; background-position: center;"';
	}
}
?>
<div class="get-in-touch py-104 relative text-white" <?php echo $bg_style; ?>>
	<div class="absolute inset-0 bg-black opacity-40 z-[10]"></div>
	<div class="container flex flex-wrap gap-20 md:flex-nowrap items-center justify-between relative z-[100]">
		<div class="w-full md:w-auto text-center md:text-left">
			<h2 class="mb-28"><?= $title; ?></h2>
			<div class="subtitle text-heading-sm font-extralight mb-48"><?= $subtitle; ?></div>
		</div>


		<?php echo do_shortcode('[contact-form-7 id="236" title="get-in-touch"]'); ?>
		<!--<form>
			<div class="flex justify-center">
				<input type="text" class="form-input flex-1" />
				<button class="button uppercase green" type="submit">Contact Us</button>
			</div>
		</form>-->
	</div>
</div>

<footer class="site-footer text-white py-48 ">
	<div class="container md:flex">
		<div class="col first w-2/5 pb-40">
			<a href="<?= get_home_url(); ?>" class="logo"><img
					src="<?= get_template_directory_uri(); ?>/build/images/logo.svg" alt="Viezo" width="103"
					height="24"></a>

			<div class="copyright pt-32 hidden md:block">
				&copy; <?= date('Y'); ?> Viezo. All rights reserved.
			</div>
		</div>
		<div class="col second-wrap md:w-3/5 md:flex justify-between font-osp-din uppercase">
			<nav id="site-footer-navigation" class="footer-navigation navigation-menu hidden desktop:block"
				aria-label="<?php esc_attr_e('Footer Navigation', 'viezo'); ?>">
				<?php
				wp_nav_menu(
					[
						'fallback_cb'    => false,
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'menu_class'     => 'menu flex-col',
						'container'      => false,
						'depth'          => 1,
					]
				);
				?>
			</nav><!-- #site-navigation-->

			<div class="col third">
				<nav id="site-footer-navigation-second"
					class="footer-navigation navigation-menu pb-16 hidden desktop:block"
					aria-label="<?php esc_attr_e('Footer Navigation 2', 'viezo'); ?>">
					<?php
					wp_nav_menu(
						[
							'fallback_cb'    => false,
							'theme_location' => 'footer-second',
							'menu_id'        => 'footer-menu-second',
							'menu_class'     => 'menu flex-col',
							'container'      => false,
							'depth'          => 1,
						]
					);
					?>
				</nav><!-- #site-navigation-->

			</div>

			<div class="col contacts navigation-menu">
				<ul class="list-none text-sm menu flex-col">
					<li>
						<a href="mailto:info@viezo.lt">
							<i class="vicon-LocalPostOffice"></i> <span>info<span
									class="font-saira font-medium">@</span>viezo.lt</span>
						</a>
					</li>
					<li>
						<a href="tel:+370 675 56 247">
							<i class="vicon-LocalPhone"></i> <span>+370 675 56 247</span>
						</a>
					</li>
					<li class="address"><a href="#"><i class="vicon-LocationOn"></i> <span>
								Lentvario g. 33
								Vilnius 02241
								Lithuania
							</span>
						</a>
					</li>
					<li>
						<a href="<?= get_field('linkedin', 'option'); ?>"><i class="vicon-LinkedIn2"></i>
							<span>LinkedIn</span>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="block md:hidden">

			<div class="copyright pt-32">
				&copy; <?= date('Y'); ?> Viezo. All rights reserved.
			</div>
		</div>
	</div>
</footer><!-- .site-footer container-->

<?php vzo__display_mobile_menu(); ?>

<script src="https://cdn.jsdelivr.net/gh/manucaralmo/GlowCookies@3.1.7/src/glowCookies.min.js"></script>
<style>
	.glowCookies__banner__1>h3 {
		font-size: 22px;
	}

	#rejectCookies {
		display: none;
	}

	.glowCookies__banner .accept__btn__styles {
		width: 100%;
		padding: 10px 13px;
	}
</style>
<script>
	glowCookies.start('en', {
		style: 1,
		hideAfterClick: true,
		'acceptBtnText': 'OK',
		policyLink: 'https://viezo.lt/privacy-policy/'
	});
</script>


<?php wp_footer(); ?>

</body>

</html>