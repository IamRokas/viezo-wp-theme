/**
 * Live Sonora network section (partials/live-sonora.php).
 *
 * When the machine scene scrolls into view it plays once:
 * 1. points and cards appear, everything "operating normally";
 * 2. the fault point turns amber while its values climb;
 * 3. it turns red, starts blinking and its card opens with the detected issue.
 *
 * Cards also open on hover (desktop) and on click/tap. Users who prefer reduced
 * motion get the final state straight away.
 */

const WARNING_AT = 2600; // ms after the scene becomes visible.
const FAULT_AT = 4600;
const TWEEN_MS = 1900;

const easeInOut = ( t ) => ( t < 0.5 ? 2 * t * t : 1 - Math.pow( -2 * t + 2, 2 ) / 2 );

const formatter = ( decimals ) =>
	new Intl.NumberFormat( document.documentElement.lang || undefined, {
		minimumFractionDigits: decimals,
		maximumFractionDigits: decimals,
	} );

/**
 * Animate an element's number from one value to another.
 *
 * @param {HTMLElement} el       Element whose text is the number.
 * @param {number}      from     Start value.
 * @param {number}      to       End value.
 * @param {number}      decimals Decimal places.
 * @param {number}      duration Duration in ms.
 */
const tween = ( el, from, to, decimals, duration ) => {
	const format = formatter( decimals );
	const start = performance.now();

	const tick = ( now ) => {
		const progress = Math.min( 1, ( now - start ) / duration );
		el.textContent = format.format( from + ( to - from ) * easeInOut( progress ) );

		if ( progress < 1 ) {
			requestAnimationFrame( tick );
		}
	};

	requestAnimationFrame( tick );
};

const initScene = ( root ) => {
	const reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	const cards = [ ...root.querySelectorAll( '.scene-card' ) ];
	const points = [ ...root.querySelectorAll( '.scene-point' ) ];
	const pinned = new Set();

	const parts = ( index ) => ( {
		card: cards.find( ( el ) => el.dataset.card === String( index ) ),
		point: points.find( ( el ) => el.dataset.point === String( index ) ),
	} );

	const setOpen = ( index, open ) => {
		const { card, point } = parts( index );

		if ( ! card ) {
			return;
		}

		card.classList.toggle( 'is-open', open );
		card.querySelector( '.scene-card__head' )?.setAttribute( 'aria-expanded', String( open ) );
		point?.setAttribute( 'aria-expanded', String( open ) );
	};

	const setState = ( index, state ) => {
		const { card, point } = parts( index );

		[ card, point ].forEach( ( el ) => {
			el?.classList.remove( 'is-warning', 'is-fault' );

			if ( state ) {
				el?.classList.add( `is-${ state }` );
			}
		} );
	};

	// Click/tap toggles and pins a card; hover previews it (desktop only).
	const canHover = window.matchMedia( '(hover: hover) and (min-width: 1024px)' ).matches;

	root.querySelectorAll( '[data-point]' ).forEach( ( trigger ) => {
		const index = trigger.dataset.point;

		trigger.addEventListener( 'click', () => {
			const open = ! pinned.has( index );

			if ( open ) {
				pinned.add( index );
			} else {
				pinned.delete( index );
			}

			setOpen( index, open );
		} );

		if ( canHover ) {
			const hoverTarget = trigger.classList.contains( 'scene-point' ) ? trigger : parts( index ).card;

			hoverTarget?.addEventListener( 'mouseenter', () => setOpen( index, true ) );
			hoverTarget?.addEventListener( 'mouseleave', () => {
				if ( ! pinned.has( index ) ) {
					setOpen( index, false );
				}
			} );
		}
	} );

	// Scripted fault story.
	const faultCard = root.querySelector( '.scene-card--fault' );
	const faultIndex = faultCard?.dataset.card;
	const values = faultCard ? [ ...faultCard.querySelectorAll( '[data-from][data-to]' ) ] : [];

	const showFault = () => {
		setState( faultIndex, 'fault' );
		pinned.add( faultIndex );
		setOpen( faultIndex, true );
	};

	const play = () => {
		root.classList.add( 'is-live' );

		if ( reduceMotion ) {
			values.forEach( ( el ) => {
				el.textContent = formatter( +el.dataset.decimals ).format( +el.dataset.to );
			} );

			if ( faultCard ) {
				showFault();
			}

			return;
		}

		if ( ! faultCard ) {
			return;
		}

		setTimeout( () => {
			setState( faultIndex, 'warning' );
			values.forEach( ( el ) => tween( el, +el.dataset.from, +el.dataset.to, +el.dataset.decimals, TWEEN_MS ) );
		}, WARNING_AT );

		setTimeout( showFault, FAULT_AT );
	};

	const observer = new IntersectionObserver(
		( [ entry ] ) => {
			if ( entry.isIntersecting ) {
				observer.disconnect();
				play();
			}
		},
		{ threshold: 0.45 }
	);

	observer.observe( root.querySelector( '.live-sonora__scene-media' ) || root );
};

document.querySelectorAll( '[data-live-sonora]' ).forEach( initScene );
