<?php

/**
 * Template name: Contacts
 */


get_header();
the_post();
$blocks = get_field('blocks');
?>

<main id="main" class="site-main contacts-page bg-dark-grey">

	<?php //get_template_part('partials/page-header'); 
	?>

	<?php
	if (function_exists('yoast_breadcrumb')) {
		//yoast_breadcrumb( '<div class="big-container container pl-30 breadcrumbs pt-24">','</div>' );
	}
	?>


	<div class="container justify-center">
		<div class="desktop:flex mb-48 mt-32 border-white border">
			<div class="col-1 mb-48 desktop:mb-0 desktop:w-1/2 overflow-hidden">
				<div
					class="  text-white h-full text-lg uppercase desktop:border-r rounded-xl desktop:rounded-r-none px-24 desktop:px-44 pt-32 desktop:pt-48 pb-32 desktop:pb-40 page-content">
					<?php

					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. */
								esc_html__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'viezo'),
								[
									'span' => [
										'class' => [],
									],
								]
							),
							the_title('<span class="screen-reader-text">"', '"</span>', false)
						)
					);


					?>
				</div>
			</div>
			<div class="col-2 desktop:w-1/2">
				<div
					class="text-white z-10 bg-dark-grey py-32 desktop:py-48 px-24 desktop:px-44 rounded-xl desktop:rounded-l-none">
					<h2>Contact us</h2>
					<div class="flex">
						<?php echo do_shortcode(get_field('contact_form')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div>
		<div id="map" class="hidden"></div>
	</div>

	<?php if (!empty($blocks)): foreach ($blocks as $block): ?>
			<?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block]); ?>
	<?php endforeach;
	endif;  ?>


</main><!-- #main -->

<script>
	// Initialize and add the map
	function initMap() {
		const stylesArray = [{
				"featureType": "all",
				"stylers": [{
						"saturation": 0
					},
					{
						"hue": "#e7ecf0"
					}
				]
			},
			{
				"featureType": "road",
				"stylers": [{
					"saturation": -70
				}]
			},
			{
				"featureType": "transit",
				"stylers": [{
					"visibility": "off"
				}]
			},
			{
				"featureType": "poi",
				"stylers": [{
					"visibility": "off"
				}]
			},
			{
				"featureType": "water",
				"stylers": [{
						"visibility": "simplified"
					},
					{
						"saturation": -60
					}
				]
			}
		];

		const map = new google.maps.Map(document.getElementById("map"), {
			zoom: 11,
			center: {
				lat: 54.648462096486234,
				lng: 25.12163756423617
			},
			disableDefaultUI: true,
			styles: stylesArray
		});
		const image = {
			url: '<?= get_template_directory_uri(); ?>/build/images/icons/LocationOnBlue.svg',
			scaledSize: new google.maps.Size(40, 40), // scaled size
			origin: new google.maps.Point(0, 0), // origin
			anchor: new google.maps.Point(0, 35) // anchor
		};
		const marker = new google.maps.Marker({
			position: {
				lat: 54.648462096486234,
				lng: 25.12163756423617
			},
			map: map,
			icon: image,
			draggable: true
		});
	}
</script>

<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlWZqcxr01EOEForpTqgjC6v2k7Yk-6vg&callback=initMap&v=weekly&channel=2"
	async></script>

<?php get_footer(); ?>