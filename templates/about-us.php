<?php

/**
 * Template name: About Us
 */


get_header();
the_post();
$blocks = get_field('blocks');
$softwareBlock = null;
?>

<main id="main" class="site-main about-us-page">

	<?php get_template_part('partials/page-header'); ?>


	<div class="timeline pt-64">

		<div class="container bg-gray-200 mx-auto w-full h-full">
			<div class="relative wrap mb-0 pb-32 desktop:pb-64 h-full">
				<div class="track absolute left-20 desktop:left-1/2">
					<div class="dot"></div>
				</div>
				<?php
				foreach (get_field('journey') as $key => $el):
					$leftSide = ($key % 2 != 0);
					$title = $el['title'];
					$date = $el['date'];
					$text = $el['description'];
					$image = $el['image'];
				?>


					<div class="mb-8 flex justify-between <?= ($leftSide ? 'desktop:flex-row-reverse left-side' : 'right-side'); ?> items-center w-full timeline-item"
						data-key="<?= $key; ?>" id="timeline-item-<?= $key; ?>">
						<div class="order-1 w-4/12 desktop:w-4/12"></div>
						<div class="z-20 items-center order-1 self-start mt-64 w-8 h-8 rounded-full the-stop hidden desktop:flex"
							id="the-stop-<?= $key; ?>">

						</div>

						<div
							class="order-1 w-8/12 desktop:w-4/12 px-6 py-4 relative <?= ($leftSide ? 'text-left desktop:text-right' : 'text-left'); ?>">
							<div class="green-line green-line-<?= $key; ?> absolute"></div>
							<div class="text-wrap flex flex-col gap-20">
								<img src="<?= $image['url']; ?>" alt="<?= $title; ?>" width="120" height="120"
									class="image shadow-shad rounded-full" />
								<div class="date text-darkest-grey text-xs desktop:text-base"><?= $date; ?></div>
								<h3 class="font-medium text-xl desktop:text-2xl"><?= $title; ?></h3>
								<p class="font-extralight font-body-1"><?= $text; ?></p>
							</div>
						</div>
					</div>


				<?php endforeach; ?>
			</div>
		</div>
	</div>


	<?php if (!empty($blocks) && is_array($blocks)): ?>
		<?php foreach ($blocks as $block): ?>
			<?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block]); ?>
		<?php endforeach; ?>
	<?php endif; ?>



</main><!-- #main -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>
<script>
	function animateFrom(elem, direction) {
		direction = direction || 1;
		var x = 0,
			y = direction * 100;
		if (elem.classList.contains("right-side")) {
			x = -100;
			y = 0;
		} else if (elem.classList.contains("left-side")) {
			x = 100;
			y = 0;
		}
		elem.style.transform = "translate(" + x + "px, " + y + "px)";
		elem.style.opacity = "0";
		gsap.fromTo(elem, {
			x: x,
			y: y,
			autoAlpha: 0
		}, {
			duration: 1.25,
			x: 0,
			y: 0,
			autoAlpha: 1,
			ease: "expo",
			overwrite: "auto"
		});
	}

	function hide(elem) {
		gsap.set(elem, {
			autoAlpha: 0
		});
	}

	document.addEventListener("DOMContentLoaded", function() {
		gsap.registerPlugin(ScrollTrigger);

		let st = ScrollTrigger.create({
			trigger: ".track",
			pin: ".train",
			start: "top center-=10",
			end: "bottom center+=150",

			onComplete: function() {
				console.log('completed');
			}
		});

		let h3h = gsap.getProperty('.green-line-0 + .text-wrap h3', "height");
		if (window.innerWidth < 1024) {
			gsap.set('#timeline-item-0 .green-line-0', {
				top: 140 + h3h,
				width: 'calc(100vw - 130px)'
			});
		}

		gsap.utils.toArray(".timeline-item:not(#timeline-item-0)").forEach(function(elem) {
			hide(elem.querySelector(
				'.text-wrap')); // assure that the element is hidden when scrolled into view

			let thekey = elem.dataset.key;

			let h3h = gsap.getProperty('.green-line-' + thekey + ' + .text-wrap h3', "height");

			let targetW = 135;
			if (window.innerWidth < 1024) {
				targetW = 'calc(100vw - 130px)';
				gsap.set('.green-line-' + thekey, {
					top: 140 + h3h
				});
			}


			gsap.set('.green-line-' + thekey, {
				width: 0
			});

			gsap.timeline({
				scrollTrigger: {
					trigger: elem,
					toggleActions: "play pause resume reverse",
					//clearProps: "all",
					//start: () => 'top top+=' + (elem.offsetTop),
					start: () => 'top center+=100',
					//end: () => '+=' + elem.offsetTop + elem.outerHeight + 100,
					end: () => '+=300',
					scrub: 1,
					toggleClass: {
						targets: [elem, '.green-line'],
						className: "in-view"
					},
				}
			}).to('.green-line-' + thekey, {
				width: targetW,
				duration: 0.4
			}).to('#timeline-item-' + thekey + ' .text-wrap', {
				autoAlpha: 1,
				duration: 0.6
			});


		});

		document.querySelector("#timeline-item-0").classList.add('in-view');
	});
</script>

<?php get_footer(); ?>