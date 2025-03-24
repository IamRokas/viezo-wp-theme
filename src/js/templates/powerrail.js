function calculatorPage(){


	function numberAnimations() {

		// How long you want the animation to take, in ms
		const animationDuration = 2000;
		// Calculate how long each ‘frame’ should last if we want to update the animation 60 times per second
		const frameDuration = 1000 / 60;
		// Use that to calculate how many frames we need to complete the animation
		const totalFrames = Math.round( animationDuration / frameDuration );
		// An ease-out function that slows the count as it progresses
		const easeOutQuad = t => t * ( 2 - t );

		// The animation function, which takes an Element
		const animateCountUp = el => {
			let frame = 0;
			const countTo = parseInt( el.dataset.number, 10 );

			el.style.visibility = "visible";

			// Start the animation running 60 times per second
			const counter = setInterval( () => {
				frame++;
				// Calculate our progress as a value between 0 and 1
				// Pass that value to our easing function to get our
				// progress on a curve
				const progress = easeOutQuad( frame / totalFrames );
				// Use the progress value to calculate the current count
				const currentCount = Math.round( countTo * progress );

				// If the current count has changed, update the element
				if ( parseInt( el.dataset.value, 10 ) !== currentCount ) {
					el.innerHTML = currentCount.toLocaleString('lt-LT');
					el.dataset.value = currentCount;
				}

				// If we’ve reached our last frame, stop the animation
				if ( frame === totalFrames ) {
				clearInterval( counter );
				}
			}, frameDuration );
		};

		// Run the animation on all elements with a class of ‘countup’
		const runAnimations = () => {
			const countupEls = document.querySelectorAll( '.countup' );
			countupEls.forEach( animateCountUp );
		};
		runAnimations();
	}



	function setBubble(range, bubble) {
		const val = range.value;
		const min = range.min ? range.min : 0;
		const max = range.max ? range.max : 100;
		const newVal = Number(((val - min) * 100) / (max - min));
		const newPosition = 12 - (newVal * 0.2);
		bubble.innerHTML = val+'<span>K km</span>';

		range.style.backgroundSize = newVal + '% 100%';

		// Sorta magic numbers based on size of the native UI thumb
		bubble.style.left = `calc(${newVal}% + (${newPosition}px))`;
	}
		const range = document.querySelector("#average-mileage");
		const bubble = document.querySelector("#mileage-bubble");
		range.addEventListener("input", () => {

			setBubble(range, bubble);
	});
	setBubble(range, bubble);

	function calculation(){
		document.querySelector("#calculate-button").addEventListener('click', function(e){
			e.preventDefault();
			const form = document.querySelector(".calculator form");
			form.querySelector('.loader').classList.add('is-active');
			form.querySelector("#calculate-button").disabled = true;
			let isValid = form.querySelector("#fleet-size").checkValidity();
			if(!isValid){
				form.querySelector("#fleet-size").reportValidity();
				form.querySelector('.loader').classList.remove('is-active');
				form.querySelector("#calculate-button").disabled = false;
				return;
			}

			let col1 = document.querySelector('.col-1');
			if(col1){
				document.querySelector('.col-1').classList.remove('animated');
				setTimeout(requestReplace, 400);
			}else{
				requestReplace();
			}
		});
	}

	function requestReplace(){
		const form = document.querySelector(".calculator form");
		const request = new XMLHttpRequest();
			const reqUrl = form.action;
			let formData = new FormData(form);
			formData.append('getCalculations', 1);
			formData.delete('_wpcf7');
			request.open('POST', reqUrl, true);
			request.responseType = 'document';

			request.onload = function() {
				if (this.status >= 200 && this.status < 400) {
					const resp = this.response;
					const results = document.querySelector('.calc-results');


					results.innerHTML = resp.querySelector('.calc-results').innerHTML;
					//scroll to results

					setTimeout(toggleResults, 200);
					setTimeout(numberAnimations, 1500);
					setTimeout(toggleForm, 3500);
					form.querySelector('.loader').classList.remove('is-active');
				}
			};

			request.onerror = function() {
			// There was a connection error of some sort
			};

			request.send(formData);
	}

	function fleetSizeInput(){
		document.querySelector("#fleet-size").addEventListener('change', function(e){
			let inputs = document.querySelector("#axles-inputs");
			if(!inputs.classList.contains('to-open')){
				inputs.classList.add('to-open');
				setTimeout(function(){
					document.querySelector("#axles-inputs").classList.remove('overflow-hidden');
				}, 1300);
			}

		});
	}
	fleetSizeInput();
	calculation();
}

function toggleResults(){
	const col1 = document.querySelector('.col-1');
	col1.classList.toggle('animated');

	setTimeout(function(){
		const results = document.querySelector('.col-1');
		window.scrollBy({
			top: results.getBoundingClientRect().top + results.clientHeight,
			left: 0,
			behavior: 'smooth'});
	}, 150);
}

function toggleForm(){
	document.querySelector('.col-2').classList.toggle('animated-2');
	document.querySelector('.col-1').classList.toggle('animated-2');
	document.querySelector('.col-1 .heading').classList.toggle('to-left');
	document.querySelector("#calculate-button").disabled = false;
	//document.querySelector("#fleet-size").disabled = true;
}


if(document.body.classList.contains('page-template-powerail')){
	calculatorPage();
}
