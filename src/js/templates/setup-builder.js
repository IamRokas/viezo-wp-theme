/**
 * Pricing "Setup builder" funnel (partials/setup-builder.php).
 *
 * 4 questions → estimated setup + best-matching case study → WPForms lead form.
 * The answers and estimate are copied into the form's hidden fields.
 *
 * Every funnel step is tracked anonymously, whether or not a lead is left:
 * GA4 (gtag, or the GTM dataLayer), Microsoft Clarity (custom event + tags) and the site's
 * own log (inc/setup-builder-stats.php → Tools → Setup builder stats).
 * Country comes from GA4 / Clarity geo lookups, so nothing is resolved here.
 * Answers are tracked by their option keys, which are the same in every language.
 */

const QUESTION_STEPS = [ 'industry', 'equipment', 'challenge', 'machines' ];
const STEPS = [ ...QUESTION_STEPS, 'result', 'offer' ];

// Case study scoring: same equipment → same maintenance problem → same industry.
const WEIGHTS = { equipment: 100, challenge: 10, industry: 1 };

const newSessionId = () =>
	window.crypto?.randomUUID?.() ||
	`${ Date.now().toString( 36 ) }-${ Math.random().toString( 36 ).slice( 2, 10 ) }`;

/**
 * Readable, numbered event names for GA4 / Clarity: sorted by name they read as the funnel.
 * The site's own log keeps the internal names (Tools → Setup builder stats).
 *
 * @param {string} name   Internal event name.
 * @param {Object} params Event parameters.
 * @return {string} Analytics event name.
 */
const analyticsName = ( name, params ) => {
	if ( name === 'setup_step_answered' ) {
		return `setup_${ params.setup_step }_${ params.setup_question }`;
	}

	return {
		setup_started: 'setup_0_started',
		setup_result_viewed: 'setup_5_result_viewed',
		setup_offer_clicked: 'setup_6_offer_clicked',
		setup_form_submitted: 'setup_7_form_submitted',
	}[ name ] || name;
};

/**
 * Send a funnel event to GA4 and Clarity.
 *
 * @param {string} name   Event name.
 * @param {Object} params Flat event parameters.
 */
const sendEvent = ( name, params ) => {
	if ( typeof window.gtag === 'function' ) {
		window.gtag( 'event', name, params );
	} else {
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push( { event: name, ...params } );
	}

	if ( typeof window.clarity === 'function' ) {
		Object.entries( params ).forEach( ( [ key, value ] ) => {
			if ( value !== '' && value !== undefined ) {
				window.clarity( 'set', key, String( value ) );
			}
		} );
		window.clarity( 'event', name );
	}
};

/**
 * Log a funnel event on the site (anonymous). "Form submitted" is logged server-side.
 *
 * @param {string} url    REST endpoint.
 * @param {string} name   Event name.
 * @param {Object} params Event parameters (setup_* keys).
 */
const logEvent = ( url, name, params ) => {
	if ( ! url || name === 'setup_form_submitted' ) {
		return;
	}

	const body = JSON.stringify( {
		event: name,
		session: params.setup_session,
		lang: params.setup_lang,
		step: params.setup_step || 0,
		question: params.setup_question || '',
		answer: params.setup_answer || '',
		industry: params.setup_industry,
		equipment: params.setup_equipment,
		challenge: params.setup_challenge,
		machines: params.setup_machines,
		gateways: params.setup_gateways,
		case: params.setup_case,
	} );

	// text/plain keeps it a "simple" request (no CORS preflight); the endpoint parses the body.
	if ( ! navigator.sendBeacon?.( url, new Blob( [ body ], { type: 'text/plain' } ) ) ) {
		fetch( url, { method: 'POST', body, keepalive: true, headers: { 'Content-Type': 'text/plain' } } ).catch( () => {} );
	}
};

const initBuilder = ( root ) => {
	const config = JSON.parse( root.querySelector( '[data-setup-config]' ).textContent );
	const form = root.querySelector( '[data-setup-questions]' );
	const range = root.querySelector( '[data-setup-machines]' );
	const rangeValue = root.querySelector( '[data-setup-machines-value]' );
	const counter = root.querySelector( '[data-setup-counter]' );
	const progress = root.querySelectorAll( '.setup-builder__progress span' );
	const backButton = root.querySelector( '[data-setup-back]' );
	const nextButton = root.querySelector( '[data-setup-next]' );
	const nextLabel = root.querySelector( '[data-setup-next-label]' );
	const card = root.querySelector( '.setup-builder__card' );
	const stepEls = Object.fromEntries(
		STEPS.map( ( key ) => [ key, root.querySelector( `[data-step="${ key }"]` ) ] )
	);

	Object.values( stepEls ).forEach( ( el ) => el.setAttribute( 'tabindex', '-1' ) );

	const labels = Object.fromEntries( config.questions.map( ( q ) => [ q.key, q.options ] ) );
	const stops = config.stops;
	const maxStop = stops[ stops.length - 1 ];
	const segment = 100 / ( stops.length - 1 );

	const state = {
		step: 0,
		session: newSessionId(),
		started: false,
		machines: Number( range.dataset.default ),
		match: null,
	};

	// ── Answers ──────────────────────────────────────────────

	const answers = () => {
		const data = new FormData( form );

		return {
			industry: data.get( 'industry' ) || '',
			equipment: data.getAll( 'equipment' ),
			challenge: data.get( 'challenge' ) || '',
			machines: state.machines,
		};
	};

	const isAnswered = ( key ) => {
		if ( key === 'machines' ) {
			return state.machines > 0;
		}

		const value = answers()[ key ];

		return Array.isArray( value ) ? value.length > 0 : Boolean( value );
	};

	const label = ( key, value ) =>
		( Array.isArray( value ) ? value : [ value ] )
			.map( ( v ) => labels[ key ]?.[ v ] || v )
			.join( ', ' );

	const estimate = () => {
		const plus = state.machines >= maxStop;

		return {
			points: state.machines,
			gateways: Math.max( 1, Math.ceil( state.machines / config.sensorsPerGateway ) ),
			plus,
		};
	};

	const formatCount = ( count, plus ) => `${ count }${ plus ? '+' : '' }`;

	// ── Slider: stops are evenly spaced on the track, values interpolate between them ──

	const roundValue = ( value ) => {
		if ( value >= 100 ) {
			return Math.round( value / 10 ) * 10;
		}

		if ( value >= 50 ) {
			return Math.round( value / 5 ) * 5;
		}

		return Math.max( 1, Math.round( value ) );
	};

	const positionToValue = ( position ) => {
		const index = Math.min( Math.floor( position / segment ), stops.length - 2 );
		const t = ( position - index * segment ) / segment;

		return roundValue( stops[ index ] + t * ( stops[ index + 1 ] - stops[ index ] ) );
	};

	const valueToPosition = ( value ) => {
		for ( let i = 0; i < stops.length - 1; i++ ) {
			if ( value <= stops[ i + 1 ] ) {
				return i * segment + ( ( value - stops[ i ] ) / ( stops[ i + 1 ] - stops[ i ] ) ) * segment;
			}
		}

		return 100;
	};

	const renderRange = () => {
		const text = formatCount( state.machines, state.machines >= maxStop );
		rangeValue.textContent = text;
		range.setAttribute( 'aria-valuetext', text );
		range.style.setProperty( '--fill', `${ range.value }%` );
	};

	range.value = Math.round( valueToPosition( state.machines ) );
	renderRange();

	range.addEventListener( 'input', () => {
		state.machines = positionToValue( Number( range.value ) );
		renderRange();
	} );

	// ── Case study match ─────────────────────────────────────

	const findCase = ( a ) => {
		let best = null;
		let bestScore = -1;

		config.cases.forEach( ( item ) => {
			const score =
				( item.equipment.some( ( e ) => a.equipment.includes( e ) ) ? WEIGHTS.equipment : 0 ) +
				( item.challenge.includes( a.challenge ) ? WEIGHTS.challenge : 0 ) +
				( item.industry.includes( a.industry ) ? WEIGHTS.industry : 0 );

			// Strictly greater: on a tie the earlier (more generic) case wins.
			if ( score > bestScore ) {
				best = item;
				bestScore = score;
			}
		} );

		return best;
	};

	const renderCase = ( item ) => {
		root.querySelectorAll( '[data-setup-case]' ).forEach( ( el ) => {
			el.hidden = ! item;
		} );

		if ( ! item ) {
			return;
		}

		root.querySelectorAll( '[data-case-link]' ).forEach( ( el ) => {
			el.href = item.url;
		} );
		root.querySelectorAll( '[data-case-image]' ).forEach( ( el ) => {
			el.src = item.image;
			el.alt = item.title;
			el.hidden = ! item.image;
		} );
		root.querySelectorAll( '[data-case-machine]' ).forEach( ( el ) => {
			el.textContent = item.machine;
		} );

		const fill = { tag: item.tag, detected: item.detected, outcome: item.outcome };
		Object.entries( fill ).forEach( ( [ key, value ] ) => {
			root.querySelectorAll( `[data-case-${ key }]` ).forEach( ( el ) => {
				el.textContent = value;
			} );
		} );
	};

	// ── Outputs: result, summary, WPForms hidden fields ─────

	const renderOutputs = () => {
		const a = answers();
		const est = estimate();
		const values = {
			industry: label( 'industry', a.industry ),
			equipment: label( 'equipment', a.equipment ),
			challenge: label( 'challenge', a.challenge ),
			machines: formatCount( a.machines, est.plus ),
			points: formatCount( est.points, est.plus ),
			gateways: formatCount( est.gateways, est.plus ),
		};

		Object.entries( values ).forEach( ( [ key, value ] ) => {
			root.querySelectorAll( `[data-setup-out="${ key }"]` ).forEach( ( el ) => {
				el.textContent = value;
			} );
		} );

		state.match = findCase( a );
		renderCase( state.match );

		return values;
	};

	const fillForm = () => {
		const values = renderOutputs();
		const a = answers();
		const fields = {
			...values,
			case: state.match ? `${ state.match.title } (${ state.match.url })` : '',
			session: state.session,
			lang: config.lang,
			// Language-independent answer codes, so leads compare across languages.
			keys: `industry=${ a.industry }; equipment=${ a.equipment.join( ',' ) }; challenge=${ a.challenge }`,
		};

		Object.entries( config.fields ).forEach( ( [ key, id ] ) => {
			root.querySelectorAll( `[name="wpforms[fields][${ id }]"]` ).forEach( ( input ) => {
				input.value = fields[ key ] ?? '';
			} );
		} );
	};

	// ── Tracking ─────────────────────────────────────────────

	const track = ( name, extra = {} ) => {
		const a = answers();
		const est = estimate();

		const params = {
			setup_session: state.session,
			setup_lang: config.lang,
			setup_industry: a.industry,
			setup_equipment: a.equipment.join( ',' ),
			setup_challenge: a.challenge,
			setup_machines: formatCount( a.machines, est.plus ),
			setup_gateways: formatCount( est.gateways, est.plus ),
			setup_case: state.match?.key || '',
			...extra,
		};

		sendEvent( analyticsName( name, params ), params );
		logEvent( config.logUrl, name, params );
	};

	const start = () => {
		if ( ! state.started ) {
			state.started = true;
			track( 'setup_started' );
		}
	};

	// ── Navigation ───────────────────────────────────────────

	const updateNext = () => {
		const key = STEPS[ state.step ];
		nextButton.disabled = ! isAnswered( key );
	};

	const show = ( index, { focus = true } = {} ) => {
		state.step = index;
		const key = STEPS[ index ];

		STEPS.forEach( ( step, i ) => {
			stepEls[ step ].hidden = i !== index;
		} );

		const isQuestion = index < QUESTION_STEPS.length;
		form.hidden = ! isQuestion;
		nextButton.hidden = ! isQuestion;
		backButton.hidden = index === 0;
		nextLabel.textContent = key === 'machines' ? config.i18n.show : config.i18n.next;
		root.dataset.step = key;

		if ( isQuestion ) {
			counter.textContent = config.i18n.step
				.replace( '{current}', index + 1 )
				.replace( '{total}', QUESTION_STEPS.length );
		} else {
			counter.textContent = key === 'offer' ? config.i18n.offer : config.i18n.result;
			renderOutputs();
		}

		progress.forEach( ( bar, i ) => {
			bar.classList.toggle( 'is-done', i <= Math.min( index, QUESTION_STEPS.length ) );
		} );

		updateNext();

		if ( focus ) {
			stepEls[ key ].focus( { preventScroll: true } );

			if ( card.getBoundingClientRect().top < 0 ) {
				card.scrollIntoView( { behavior: 'smooth', block: 'start' } );
			}
		}
	};

	form.addEventListener( 'change', () => {
		start();
		updateNext();
	} );
	form.addEventListener( 'submit', ( event ) => event.preventDefault() );

	nextButton.addEventListener( 'click', () => {
		const key = STEPS[ state.step ];

		if ( ! isAnswered( key ) ) {
			return;
		}

		start();

		const a = answers();
		const value = key === 'machines' ? formatCount( a.machines, a.machines >= maxStop ) : [].concat( a[ key ] ).join( ',' );
		track( 'setup_step_answered', { setup_step: state.step + 1, setup_question: key, setup_answer: value } );

		show( state.step + 1 );

		if ( STEPS[ state.step ] === 'result' ) {
			track( 'setup_result_viewed' );
		}
	} );

	backButton.addEventListener( 'click', () => show( Math.max( 0, state.step - 1 ) ) );

	root.querySelector( '[data-setup-edit]' ).addEventListener( 'click', () => show( 0 ) );

	root.querySelector( '[data-setup-offer]' ).addEventListener( 'click', () => {
		track( 'setup_offer_clicked' );
		fillForm();
		show( STEPS.indexOf( 'offer' ) );
	} );

	// Header "Build my setup" button (and any other link to the builder).
	document.querySelectorAll( `a[href$="#${ root.id }"]` ).forEach( ( link ) => {
		link.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			start();
			root.scrollIntoView( { behavior: 'smooth', block: 'start' } );
			stepEls[ STEPS[ state.step ] ].focus( { preventScroll: true } );
		} );
	} );

	// ── Lead form ────────────────────────────────────────────

	const formWrap = root.querySelector( '[data-setup-form]' );

	// Make sure the hidden fields are current right before WPForms sends them.
	formWrap.addEventListener( 'submit', fillForm, true );

	// WPForms (AJAX) announces success through jQuery events only. jQuery may load after
	// this bundle, so bind once the page has loaded.
	const bindSubmitted = () =>
		window.jQuery?.( formWrap ).on( 'wpformsAjaxSubmitSuccess', () => {
			track( 'setup_form_submitted' );
			root.classList.add( 'is-submitted' );
		} );

	if ( document.readyState === 'complete' ) {
		bindSubmitted();
	} else {
		window.addEventListener( 'load', bindSubmitted, { once: true } );
	}

	show( 0, { focus: false } );
};

document.querySelectorAll( '[data-setup-builder]' ).forEach( initBuilder );
