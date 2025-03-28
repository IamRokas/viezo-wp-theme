/**
 * Site JS
 */

import './global';
import './template-tags';
import './templates';
import './blocks';

// Viezo powerail / sonora

const animatePowerail = (powerailBlock, scrollAmount, blocks, powerailStickyBlockHeight) => {
	const currentScrolledInto = window.scrollY - powerailBlock.offsetTop;
	const progressStep = scrollAmount / 5;

	const progressArray = [
		currentScrolledInto >= progressStep ? 100 : Math.round(currentScrolledInto * 100 / progressStep),
		currentScrolledInto >= progressStep * 2 ? 100 : currentScrolledInto - progressStep <= 0 ? 0 : Math.floor((currentScrolledInto - progressStep) * 100 / progressStep),
		currentScrolledInto >= progressStep * 3 ? 100 : currentScrolledInto - progressStep * 2 <= 0 ? 0 : Math.floor((currentScrolledInto - progressStep * 2) * 100 / progressStep),
		currentScrolledInto >= progressStep * 4 ? 100 : currentScrolledInto - progressStep * 3 <= 0 ? 0 : Math.floor((currentScrolledInto - progressStep * 3) * 100 / progressStep),
		currentScrolledInto >= progressStep * 5 ? 100 : currentScrolledInto - progressStep * 4 <= 0 ? 0 : Math.floor((currentScrolledInto - progressStep * 4) * 100 / progressStep),
		currentScrolledInto >= progressStep * 6 ? 100 : currentScrolledInto - progressStep * 5 <= 0 ? 0 : Math.floor((currentScrolledInto - progressStep * 5) * 100 / progressStep),
	];

	blocks.forEach((block, index) => {
		const blockTextBlock = block.querySelector('.powerail-text');
		const isMobile = window.innerWidth <= 1023;
		if (progressArray[index + 1] !== undefined && progressArray[index + 1] !== 0) {
			const opacity = 1 - (progressArray[index + 1] / 100);
			blockTextBlock.style.opacity = `${opacity}`;
		} else {
			block.style.opacity = `${progressArray[index] / 100}`;
		}

		const blockMaxTop = powerailStickyBlockHeight - block.clientHeight * 1.5;
		block.style.top = `${blockMaxTop * progressArray[index] / 100}px`;

		if (index === 3) {
			if (progressArray[index] === 100) {
				const image1 = block.querySelector('.swap-image-1');
				const image2 = block.querySelector('.swap-image-2');

				image1.classList.add("opacity-0");
				image2.classList.remove("opacity-0");
			} else {
				const image1 = block.querySelector('.swap-image-1');
				const image2 = block.querySelector('.swap-image-2');

				image1.classList.remove("opacity-0");
				image2.classList.add("opacity-0");
			}
		}
	})
};

const initPowerailAnimation = () => {
	const powerailBlock = document.getElementById('powerail-animation-container');

	if (powerailBlock) {
		const powerailStickyBlock = powerailBlock.querySelector('.sticky');
		const powerailStickyBlockHeight = powerailStickyBlock.clientHeight;
		const blocks = powerailStickyBlock.querySelectorAll('.powerail-card');
		const windowHeight = window.innerHeight;
		const isMobile = window.innerWidth <= 1023;
		const scrollAmount = windowHeight * (isMobile ? 5 : 4);

		document.addEventListener('scroll', function () {
			if (powerailBlock.offsetTop <= window.scrollY) {
				animatePowerail(powerailBlock, scrollAmount, blocks, powerailStickyBlockHeight);
			}
		});
	}
};

const animateSonora = (sonoraBlock, scrollAmount, ranges, sonoraImage, sonoraTextBlocks) => {
	const currentScrolledInto = window.scrollY - sonoraBlock.offsetTop;
	const progress = currentScrolledInto >= scrollAmount ? 100 : currentScrolledInto * 100 / scrollAmount;
	const progress180 = Math.round(progress * 1.8);

	let activeIndex = 0;

	for (let i = 0; i < ranges.length; i++) {
		if (progress180 >= ranges[i].min && progress180 <= ranges[i].max) {
			activeIndex = i;
		}
	}

	const imageWidth = sonoraImage.clientWidth;

	sonoraImage.style.backgroundPosition = `-${imageWidth * activeIndex}px 0px`;

	const isMobile = window.innerWidth <= 1023;

	if (2 < progress && (isMobile ? progress <= 25 : true)) {
		sonoraTextBlocks[0].classList.remove('opacity-0');
	} else {
		sonoraTextBlocks[0].classList.add('opacity-0');
	}

	if (25 < progress && (isMobile ? progress <= 50 : true)) {
		sonoraTextBlocks[1].classList.remove('opacity-0');
	} else {
		sonoraTextBlocks[1].classList.add('opacity-0');
	}

	if (50 < progress && (isMobile ? progress <= 75 : true)) {
		sonoraTextBlocks[2].classList.remove('opacity-0');
	} else {
		sonoraTextBlocks[2].classList.add('opacity-0');
	}

	if (progress > 75) {
		sonoraTextBlocks[3].classList.remove('opacity-0');
	} else {
		sonoraTextBlocks[3].classList.add('opacity-0');
	}
};

const initSonoraAnimation = () => {
	const sonoraBlock = document.getElementById('sonora-animation-container');

	if (sonoraBlock) {
		const isMobile = window.innerWidth <= 1023;
		const windowHeight = window.innerHeight;
		const scrollAmount = windowHeight * (isMobile ? 5 : 4);
		const sonoraImage = document.getElementById('sonora-sprite-container');
		const sonoraTextBlocks = document.querySelectorAll('.sonora-text-block');

		const ranges = [{
				min: 0,
				max: 10
			},
			{
				min: 11,
				max: 20
			},
			{
				min: 21,
				max: 30
			},
			{
				min: 31,
				max: 40
			},
			{
				min: 41,
				max: 50
			},
			{
				min: 51,
				max: 60
			},
			{
				min: 61,
				max: 70
			},
			{
				min: 71,
				max: 80
			},
			{
				min: 81,
				max: 90
			},
			{
				min: 91,
				max: 100
			},
			{
				min: 101,
				max: 110
			},
			{
				min: 111,
				max: 120
			},
			{
				min: 121,
				max: 130
			},
			{
				min: 131,
				max: 140
			},
			{
				min: 141,
				max: 150
			},
			{
				min: 151,
				max: 160
			},
			{
				min: 161,
				max: 170
			},
			{
				min: 171,
				max: 180
			}
		];

		document.addEventListener('scroll', function () {
			if (sonoraBlock.offsetTop <= window.scrollY) {
				animateSonora(sonoraBlock, scrollAmount, ranges, sonoraImage, sonoraTextBlocks);
			}
		})
	}
}

document.addEventListener('DOMContentLoaded', () => {
	initPowerailAnimation();
	initSonoraAnimation();

	// Get all elements with arrow-down class
	const arrowDownButtons = document.querySelectorAll('.arrow-down');
	const headerButtons = document.querySelectorAll('.header-btn');

	// Add click event listener to each arrow-down element
	arrowDownButtons.forEach(function (button) {
		button.addEventListener('click', function (e) {
			e.preventDefault();

			// Find the page-header element
			const pageHeader = document.querySelector('.page-header');

			if (pageHeader) {
				// Calculate the target scroll position (bottom of page-header minus 100px)
				const targetPosition = pageHeader.offsetTop + pageHeader.offsetHeight - 100;

				// Scroll to that position with smooth behavior
				window.scrollTo({
					top: targetPosition,
					behavior: 'smooth'
				});
			}
		});
	});

	// Add click event listener to each arrow-down element
	headerButtons.forEach(function (button) {
		button.addEventListener('click', function (e) {
			e.preventDefault();

			// Find the page-header element
			const pageHeader = document.querySelector('.header-btn-scroll');

			if (pageHeader) {
				// Calculate the target scroll position (bottom of page-header minus 100px)
				const targetPosition = pageHeader.offsetTop + pageHeader.offsetHeight - 100;

				// Scroll to that position with smooth behavior
				window.scrollTo({
					top: targetPosition,
					behavior: 'smooth'
				});
			}
		});
	});
})
