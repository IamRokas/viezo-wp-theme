/**
 * Video Block
 *
 * Handles cover reveal, no-cover initial play overlay, and custom controls
 * (play/pause, progress bar, time display, mute toggle, volume slider, fullscreen).
 * Controls auto-hide after inactivity and re-appear on hover/interaction.
 */
( function () {
	document.querySelectorAll( '[data-video-block]' ).forEach( function ( block ) {
		var cover        = block.querySelector( '[data-video-cover]' );
		var video        = block.querySelector( 'video' );
		var embedEl      = block.querySelector( '[data-video-embed]' );
		var toggle       = block.querySelector( '[data-video-toggle]' );
		var controls     = block.querySelector( '[data-video-controls]' );
		var progress     = block.querySelector( '[data-video-progress]' );
		var timeEl       = block.querySelector( '[data-video-time]' );
		var muteBtn      = block.querySelector( '[data-video-mute]' );
		var volumeEl     = block.querySelector( '[data-video-volume]' );
		var fsBtn        = block.querySelector( '[data-video-fullscreen]' );
		var initialPlay  = block.querySelector( '[data-video-initial-play]' );

		// ── Helpers ──────────────────────────────────────

		function formatTime( s ) {
			if ( isNaN( s ) ) return '0:00';
			var m   = Math.floor( s / 60 );
			var sec = Math.floor( s % 60 );
			return m + ':' + ( sec < 10 ? '0' : '' ) + sec;
		}

		function setRangeFill( el, pct ) {
			el.style.background =
				'linear-gradient(to right, rgba(255,255,255,0.95) ' + pct + '%, rgba(255,255,255,0.25) ' + pct + '%)';
		}

		function setToggleState( isPlaying ) {
			if ( ! toggle ) return;
			toggle.classList.toggle( 'is-playing', isPlaying );
			toggle.setAttribute( 'aria-label', isPlaying ? 'Pause video' : 'Play video' );
		}

		function setMuteState( isMuted ) {
			if ( ! muteBtn ) return;
			muteBtn.classList.toggle( 'is-muted', isMuted );
			muteBtn.setAttribute( 'aria-label', isMuted ? 'Unmute video' : 'Mute video' );
			if ( volumeEl ) {
				setRangeFill( volumeEl, isMuted ? 0 : volumeEl.value * 100 );
			}
		}

		// ── Controls auto-hide ───────────────────────────

		var hideTimer = null;

		function showControls() {
			if ( ! controls ) return;
			controls.classList.remove( 'video-block__controls--idle' );
			block.classList.remove( 'video-block__wrap--hide-cursor' );
		}

		function scheduleHide() {
			clearTimeout( hideTimer );
			hideTimer = setTimeout( function () {
				if ( ! video || video.paused ) return;
				if ( controls ) controls.classList.add( 'video-block__controls--idle' );
				block.classList.add( 'video-block__wrap--hide-cursor' );
			}, 2500 );
		}

		function onActivity() {
			showControls();
			scheduleHide();
		}

		block.addEventListener( 'mousemove',  onActivity );
		block.addEventListener( 'mouseenter', onActivity );
		block.addEventListener( 'mouseleave', function () {
			clearTimeout( hideTimer );
			if ( ! video || video.paused ) return;
			if ( controls ) controls.classList.add( 'video-block__controls--idle' );
			block.classList.add( 'video-block__wrap--hide-cursor' );
		} );
		block.addEventListener( 'touchstart', onActivity, { passive: true } );

		// ── Play / reveal helpers ────────────────────────

		function playVideo() {
			if ( ! video ) return;
			video.classList.remove( 'video-block__video--hidden' );
			if ( controls ) controls.classList.remove( 'video-block__controls--hidden' );
			if ( initialPlay ) initialPlay.classList.add( 'video-block__initial-play--out' );
			video.play();
			setToggleState( true );
			scheduleHide();
		}

		// No-cover initial play overlay
		if ( initialPlay ) {
			var playBtn = initialPlay.querySelector( '[data-video-play]' );
			if ( playBtn ) {
				playBtn.addEventListener( 'click', playVideo );
			}
		}

		// Cover click
		if ( cover ) {
			cover.addEventListener( 'click', function () {
				cover.classList.add( 'video-block__cover--out' );

				if ( video ) {
					playVideo();
				} else if ( embedEl ) {
					var src    = embedEl.dataset.videoSrc;
					var sep    = src.indexOf( '?' ) > -1 ? '&' : '?';
					var iframe = document.createElement( 'iframe' );

					iframe.src       = src + sep + 'autoplay=1';
					iframe.className = 'video-block__iframe';
					iframe.setAttribute( 'allow', 'autoplay; fullscreen; picture-in-picture' );
					iframe.setAttribute( 'allowfullscreen', '' );
					iframe.setAttribute( 'loading', 'eager' );

					embedEl.classList.remove( 'video-block__embed--hidden' );
					embedEl.appendChild( iframe );
				}
			} );
		}

		if ( ! video ) return;

		// ── Click video to play/pause ────────────────────

		video.addEventListener( 'click', function () {
			if ( video.paused ) {
				video.play();
			} else {
				video.pause();
				showControls();
				clearTimeout( hideTimer );
			}
		} );

		// ── Play / pause toggle button ───────────────────

		if ( toggle ) {
			toggle.addEventListener( 'click', function () {
				if ( video.paused ) {
					video.play();
				} else {
					video.pause();
					showControls();
					clearTimeout( hideTimer );
				}
			} );
		}

		video.addEventListener( 'play',  function () {
			setToggleState( true );
			scheduleHide();
		} );

		video.addEventListener( 'pause', function () {
			setToggleState( false );
			showControls();
			clearTimeout( hideTimer );
		} );

		// ── Progress bar ─────────────────────────────────

		if ( progress ) {
			setRangeFill( progress, 0 );

			video.addEventListener( 'loadedmetadata', function () {
				if ( timeEl ) timeEl.textContent = '0:00 / ' + formatTime( video.duration );
			} );

			video.addEventListener( 'timeupdate', function () {
				if ( ! video.duration ) return;
				var pct = ( video.currentTime / video.duration ) * 100;
				progress.value = pct;
				setRangeFill( progress, pct );
				if ( timeEl ) {
					timeEl.textContent = formatTime( video.currentTime ) + ' / ' + formatTime( video.duration );
				}
			} );

			progress.addEventListener( 'input', function () {
				if ( video.duration ) {
					video.currentTime = ( progress.value / 100 ) * video.duration;
					setRangeFill( progress, parseFloat( progress.value ) );
				}
			} );
		}

		// ── Mute toggle ──────────────────────────────────

		if ( muteBtn ) {
			muteBtn.addEventListener( 'click', function () {
				video.muted = ! video.muted;
			} );

			video.addEventListener( 'volumechange', function () {
				setMuteState( video.muted );
				if ( volumeEl && ! video.muted ) {
					volumeEl.value = video.volume;
					setRangeFill( volumeEl, video.volume * 100 );
				}
			} );
		}

		// ── Volume slider ────────────────────────────────

		if ( volumeEl ) {
			setRangeFill( volumeEl, 100 );

			volumeEl.addEventListener( 'input', function () {
				video.volume = parseFloat( volumeEl.value );
				video.muted  = video.volume === 0;
				setRangeFill( volumeEl, parseFloat( volumeEl.value ) * 100 );
				setMuteState( video.muted );
			} );
		}

		// ── Fullscreen ───────────────────────────────────

		function setFsState( isFs ) {
			if ( ! fsBtn ) return;
			fsBtn.classList.toggle( 'is-fullscreen', isFs );
			fsBtn.setAttribute( 'aria-label', isFs ? 'Exit fullscreen' : 'Fullscreen' );
		}

		if ( fsBtn ) {
			fsBtn.addEventListener( 'click', function () {
				if ( ! document.fullscreenElement ) {
					( block.requestFullscreen || block.webkitRequestFullscreen ).call( block );
				} else {
					( document.exitFullscreen || document.webkitExitFullscreen ).call( document );
				}
			} );

			document.addEventListener( 'fullscreenchange', function () {
				setFsState( !! document.fullscreenElement );
			} );
			document.addEventListener( 'webkitfullscreenchange', function () {
				setFsState( !! document.webkitFullscreenElement );
			} );
		}
	} );
} )();
