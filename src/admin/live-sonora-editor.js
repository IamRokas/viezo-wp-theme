/**
 * Admin: visual editor for the Live Sonora measuring point positions (Home page).
 *
 * Shows the selected scene image under the image field with one draggable dot per
 * "Measuring points" row. Dragging a dot writes X/Y (% of the photo) into the row;
 * typing X/Y moves the dot. On translations the dots are read-only: the photo and
 * positions come from the English page.
 *
 * Not bundled by Vite: enqueued as-is by inc/live-sonora.php.
 */
( function () {
	if ( typeof acf === 'undefined' || typeof vzoLiveSonoraEditor === 'undefined' ) {
		return;
	}

	const config = vzoLiveSonoraEditor;
	const KEYS = {
		image: 'field_live_sonora_scene_image',
		points: 'field_live_sonora_points',
		name: 'field_live_sonora_point_name',
		x: 'field_live_sonora_point_x',
		y: 'field_live_sonora_point_y',
		fault: 'field_live_sonora_point_fault',
	};

	const css = `
		.vzo-dots { margin: 8px 0 4px; }
		.vzo-dots__title { font-weight: 600; margin: 0 0 4px; }
		.vzo-dots__help { color: #646970; margin: 0 0 8px; }
		.vzo-dots__notice { background: #f0f6fc; border-left: 4px solid #72aee6; padding: 8px 12px; margin: 0 0 8px; }
		.vzo-dots__stage { position: relative; display: inline-block; max-width: 100%; line-height: 0; user-select: none; touch-action: none; }
		.vzo-dots__stage img { max-width: 100%; height: auto; display: block; }
		.vzo-dots__dot { position: absolute; width: 26px; height: 26px; margin: -13px 0 0 -13px; border-radius: 50%;
			background: #2a6278; border: 3px solid #fff; box-shadow: 0 1px 6px rgba(0,0,0,.45); cursor: grab;
			color: #fff; font: 600 11px/20px sans-serif; text-align: center; }
		.vzo-dots__dot.is-fault { background: #e5484d; }
		.vzo-dots__dot.is-dragging { cursor: grabbing; transform: scale(1.15); }
		.vzo-dots__dot.is-readonly { cursor: default; }
		.vzo-dots__label { position: absolute; left: 30px; top: 50%; transform: translateY(-50%); white-space: nowrap;
			background: rgba(0,0,0,.75); color: #fff; padding: 2px 6px; font: 12px/1.4 sans-serif; pointer-events: none; }
		.vzo-dots__empty { color: #646970; font-style: italic; }
	`;

	// On translations, hide the language-independent fields (they come from the English page).
	const hideShared = [ KEYS.image, 'field_live_sonora_point_x', 'field_live_sonora_point_y', 'field_live_sonora_point_rms',
		'field_live_sonora_point_temperature', 'field_live_sonora_point_harmonics', 'field_live_sonora_point_fault',
		'field_live_sonora_point_fault_rms', 'field_live_sonora_point_fault_temperature', 'field_live_sonora_point_fault_case_study' ]
		.map( ( key ) => `.acf-field[data-key="${ key }"]` ).join( ',' ) + '{display:none !important}';

	const round = ( value ) => Math.round( Math.max( 0, Math.min( 100, value ) ) * 10 ) / 10;

	const init = () => {
		const imageField = acf.getField( KEYS.image );
		const pointsField = acf.getField( KEYS.points );

		if ( ! imageField?.$el?.length || ! pointsField?.$el?.length ) {
			return;
		}

		document.head.insertAdjacentHTML( 'beforeend', `<style>${ css }${ config.isTranslation ? hideShared : '' }</style>` );

		const box = document.createElement( 'div' );
		box.className = 'vzo-dots';
		box.innerHTML = `
			<p class="vzo-dots__title">${ config.i18n.title }</p>
			${ config.isTranslation
				? `<p class="vzo-dots__notice">${ config.i18n.translation } <a href="${ config.sourceEditUrl }">${ config.i18n.editSource } →</a></p>`
				: `<p class="vzo-dots__help">${ config.i18n.help }</p>` }
			<div class="vzo-dots__stage"><img alt=""></div>
			<p class="vzo-dots__empty" hidden>${ config.i18n.noImage }</p>
		`;
		pointsField.$el[ 0 ].querySelector( '.acf-input' ).prepend( box );

		const stage = box.querySelector( '.vzo-dots__stage' );
		const img = stage.querySelector( 'img' );
		const empty = box.querySelector( '.vzo-dots__empty' );

		// Rows of the repeater (excluding ACF's hidden clone row).
		const rows = () => [ ...pointsField.$el[ 0 ].querySelectorAll( '.acf-repeater .acf-row:not(.acf-clone)' ) ];

		const input = ( row, key ) => row.querySelector( `[data-key="${ key }"] input:not([type="hidden"])` ) || row.querySelector( `[data-key="${ key }"] input` );

		const pointsData = () => {
			if ( config.isTranslation ) {
				return ( config.sourcePoints || [] ).map( ( point, i ) => ( { ...point, name: '', row: null, index: i } ) );
			}

			return rows().map( ( row, i ) => ( {
				row,
				index: i,
				name: input( row, KEYS.name )?.value || '',
				x: parseFloat( input( row, KEYS.x )?.value ),
				y: parseFloat( input( row, KEYS.y )?.value ),
				fault: !! row.querySelector( `[data-key="${ KEYS.fault }"] input[type="checkbox"]` )?.checked,
			} ) );
		};

		const imageUrl = () => {
			if ( config.isTranslation ) {
				return config.sourceImage;
			}

			const preview = imageField.$el[ 0 ].querySelector( '.image-wrap img' );
			const hasValue = imageField.$el[ 0 ].querySelector( 'input[type="hidden"]' )?.value;

			// No image chosen: the page shows the bundled default photo, so place dots on that.
			return hasValue && preview?.getAttribute( 'src' ) ? preview.getAttribute( 'src' ) : config.defaultImage || '';
		};

		let dragging = null;

		const render = () => {
			const url = imageUrl();

			const usingDefault = ! config.isTranslation && url && url === config.defaultImage;

			stage.hidden = ! url;
			empty.hidden = ! usingDefault && !! url;

			if ( url && img.getAttribute( 'src' ) !== url ) {
				img.setAttribute( 'src', url );
			}

			if ( dragging ) {
				return;
			}

			stage.querySelectorAll( '.vzo-dots__dot' ).forEach( ( dot ) => dot.remove() );

			pointsData().forEach( ( point ) => {
				const x = Number.isFinite( point.x ) ? point.x : 50;
				const y = Number.isFinite( point.y ) ? point.y : 50;
				const dot = document.createElement( 'span' );

				dot.className = 'vzo-dots__dot' + ( point.fault ? ' is-fault' : '' ) + ( point.row ? '' : ' is-readonly' );
				dot.style.left = `${ x }%`;
				dot.style.top = `${ y }%`;
				dot.textContent = point.index + 1;
				dot.innerHTML += point.name ? `<span class="vzo-dots__label"></span>` : '';
				dot.querySelector( '.vzo-dots__label' )?.append( point.name );

				if ( point.row ) {
					dot.addEventListener( 'pointerdown', ( event ) => startDrag( event, dot, point.row ) );
				}

				stage.append( dot );
			} );
		};

		const startDrag = ( event, dot, row ) => {
			event.preventDefault();
			dragging = { dot, row };
			dot.classList.add( 'is-dragging' );
			dot.setPointerCapture( event.pointerId );

			const move = ( e ) => {
				const rect = img.getBoundingClientRect();
				const x = round( ( ( e.clientX - rect.left ) / rect.width ) * 100 );
				const y = round( ( ( e.clientY - rect.top ) / rect.height ) * 100 );

				dot.style.left = `${ x }%`;
				dot.style.top = `${ y }%`;

				[ [ KEYS.x, x ], [ KEYS.y, y ] ].forEach( ( [ key, value ] ) => {
					const field = input( row, key );

					if ( field ) {
						field.value = value;
						field.dispatchEvent( new Event( 'change', { bubbles: true } ) );
					}
				} );
			};

			// End on any of these, so a missed pointerup never leaves the editor stuck in "dragging".
			const endEvents = [ [ dot, 'pointerup' ], [ dot, 'pointercancel' ], [ dot, 'lostpointercapture' ], [ window, 'pointerup' ], [ window, 'blur' ] ];

			const end = () => {
				if ( dragging?.dot !== dot ) {
					return;
				}

				dot.classList.remove( 'is-dragging' );
				dot.removeEventListener( 'pointermove', move );
				endEvents.forEach( ( [ target, type ] ) => target.removeEventListener( type, end ) );
				dragging = null;
				render();
			};

			dot.addEventListener( 'pointermove', move );
			endEvents.forEach( ( [ target, type ] ) => target.addEventListener( type, end ) );
		};

		// Keep in sync with typing, adding/removing/sorting rows and changing the image.
		pointsField.$el[ 0 ].addEventListener( 'input', render );
		pointsField.$el[ 0 ].addEventListener( 'change', render );
		// Observe only the repeater itself, never the editor box (that would re-render in a loop).
		const repeater = pointsField.$el[ 0 ].querySelector( '.acf-repeater' );

		if ( repeater ) {
			new MutationObserver( render ).observe( repeater, { childList: true, subtree: true } );
		}
		new MutationObserver( render ).observe( imageField.$el[ 0 ], { childList: true, subtree: true, attributes: true, attributeFilter: [ 'src', 'value', 'class' ] } );

		render();
	};

	acf.addAction( 'ready', init );
}() );
