// eslint-disable-next-line eslint-comments/disable-enable-pair
/* eslint-disable no-console */

function navbarScrolled() {
	if (window.scrollY > 0) {
		// user is scrolled
		document.body.classList.add('scrolled');
	} else {
		// user is at top of page
		document.body.classList.remove('scrolled');
	}
}
document.addEventListener('scroll', navbarScrolled);
document.addEventListener('DOMContentLoaded', navbarScrolled);
