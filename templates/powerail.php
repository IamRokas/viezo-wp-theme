<?php
require_once get_template_directory() . '/templates/powerail_timeline.php';

/**
 * Template name: Powerail
 */


get_header();
the_post();
$blocks = get_field('blocks');
$softwareBlock = null;
?>

<main id="main" class="site-main">

	<?php get_template_part('partials/page-header'); ?>



	<?php //get_template_part( 'template-parts/content', get_post_format() ); 
	?>

	<div class="page-content bg-white">

		<?php
		if (function_exists('yoast_breadcrumb')) {
			//yoast_breadcrumb('<div class="big-container container breadcrumbs pt-20">', '</div>');
		}
		?>
		<?php foreach ($blocks as $counter => $block):
			// if ($block['acf_fc_layout'] == 'image_grid') {
			// 	$machinesBlock = $block;
			// 	continue;
			// } 
		?>
			<?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block, 'counter' => $counter]);
			if ($counter === 0 && function_exists('get_field') && !empty(get_field('Element'))) {
				display_timeline();
			}
			?>
		<?php endforeach; ?>
	</div>

	<?php //echo get_template_part('partials/blocks/images_grid', null, ['block' => $machinesBlock]);
	?>

	<div class="container hidden px-8 desktop:px-16" id="calculator">
		<?php $showCalc = get_field('show_calculator', 'option');
		if ($showCalc):
		?>
			<div
				class="calculator bg-light-grey text-darkest-grey border-primary-green border-2 rounded-4 rounded-2xl pt-40 desktop:pt-56 mb-48">


				<?php //echo do_shortcode('[contact-form-7 id="266" title="calculator" id="calculator-form"]'); 
				?>
				<!--<form method="GET" action="<?= get_permalink(); ?>" id="calculator-form">


			</form>-->

			</div>
		<?php endif; ?>
	</div>




</main><!-- #main -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollToPlugin.min.js"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		gsap.registerPlugin(ScrollTrigger);

		var fromTheTop = [
			190,
			400,
			605,
			840,
			1020
		];

		var fromRelative = [
			190,
			200,
			200,
			230,
			180,
		];


		var tl = gsap.timeline();
		var tlImages = gsap.utils.toArray(".animme .image");
		var tlHeadings = gsap.utils.toArray(".animme h3 .text");
		var tlTexts = gsap.utils.toArray(".animme p");
		var previousPanel = document.querySelector("#panel-0");
		var sumHeights = previousPanel.offsetHeight;

		gsap.utils.toArray(".animme").forEach((panel, i) => {
			let startY = fromRelative[i];
			let toH = previousPanel;

			gsap.timeline({
					scrollTrigger: {
						//start: 'top center',
						//end: '+='+startY+'px',
						start: "top center-=20%",
						end: () => {
							return "+=" + (toH.offsetHeight - 30);
						},
						trigger: panel,
						//endTrigger: ".timeline",
						//markers: true,
						pin: true,
						pinSpacing: false,
						preventOverlaps: true,
						y: 0,
						toggleActions: "play pause reverse reverse",
						//toggleActions: "play none none none",
						scrub: 0.3,
						onEnter: () => {
							//console.log('Enter Section ' + (i + 1));
						},
						onLeave: () => {
							//console.log('ended' + i);
							//panel.classList.add('ended-view')
						},
						onLeaveBack: () => {
							//console.log('Enter Section ' + (i));
						}
					}
				}).from(tlImages[i], {
					autoAlpha: 0,
					ease: 'power1'
				})
				.from('.green-line-' + (i + 1), {
					width: 0,
					delay: 0.4
				})
				.from([tlHeadings[i], tlTexts[i]], {
					autoAlpha: 0,
					delay: 0.5
				});

			previousPanel = panel;
			sumHeights = sumHeights + panel.offsetHeight;
		});

	});
</script>

<?php get_footer(); ?>