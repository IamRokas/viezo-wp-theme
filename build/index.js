(()=>{var e={20:()=>{!function(){function e(e){var t=e.target.parentNode,o=t.querySelector(".video-background");t.classList.toggle("video-toggled"),t.classList.contains("video-toggled")?o.pause():o.play()}document.querySelectorAll(".video-toggle").forEach((function(t){t.addEventListener("click",e)}))}()},25:()=>{function e(){function e(e){e.preventDefault();var o=e.target.parentNode.closest(".menu-item-has-children"),n=o.querySelector("ul.sub-menu");!function(e){var o=t(e);o.forEach((function(e){e.classList.remove("is-visible"),e.querySelector(".parent-indicator")&&e.querySelector(".parent-indicator").setAttribute("aria-expanded",!1),e.querySelector(".sub-menu")&&e.querySelector(".sub-menu").classList.remove("is-visible","animated","slideInLeft")}))}(o),function(e,t){if(e.classList.contains("is-visible"))return void function(e,t){e.classList.remove("is-visible"),e.querySelector(".parent-indicator").setAttribute("aria-expanded",!1),t.classList.remove("is-visible","animated","slideInLeft")}(e,t);e.classList.add("is-visible"),e.querySelector(".parent-indicator").setAttribute("aria-expanded",!0),t.classList.add("is-visible","animated","slideInLeft")}(o,n)}document.querySelectorAll(".mobile-menu li.menu-item-has-children, .utility-navigation li.menu-item-has-children").forEach((function(t){t.querySelector("a").innerHTML+='<button type="button" aria-expanded="false" class="parent-indicator caret-down" aria-label="Open submenu"><span class="down-arrow"></span></button>',document.querySelectorAll(".parent-indicator").forEach((function(t){t.addEventListener("click",e)}))}));var t=function(e){for(var t=[],o=e.parentNode.firstChild;o;)1===o.nodeType&&o!==e&&t.push(o),o=o.nextSibling;return t}}"complete"!==document.readyState&&"loading"===document.readyState||document.documentElement.doScroll?document.addEventListener("DOMContentLoaded",e):e()},77:()=>{document.body.classList.contains("page-template-powerail")},110:()=>{!function(){var e=document.querySelectorAll(".main-navigation .menu-item-has-children");function t(e){n(e.target.parentNode,".menu-item-has-children").forEach((function(e){e.classList.add("focus")}))}function o(e){n(e.target.parentNode,".menu-item-has-children").forEach((function(e){e.classList.remove("focus")}))}document.addEventListener("DOMContentLoaded",(function(){e.forEach((function(e){e.querySelector("a").innerHTML+='<span class="caret-down" aria-hidden="true"></span>'}))})),document.addEventListener("DOMContentLoaded",(function(){e.forEach((function(e){e.addEventListener("focusin",t),e.addEventListener("focusout",o)}))}));var n=function(e,t){Element.prototype.matches||(Element.prototype.matches=Element.prototype.matchesSelector||Element.prototype.mozMatchesSelector||Element.prototype.msMatchesSelector||Element.prototype.oMatchesSelector||Element.prototype.webkitMatchesSelector||function(e){for(var t=(this.document||this.ownerDocument).querySelectorAll(e),o=t.length;0>=--o&&t.item(o)!==this;);return-1>o});for(var o=[];e&&e!==document;e=e.parentNode)t?e.matches(t)&&o.push(e):o.push(e);return o}}()},282:()=>{function e(){document.body.classList.add("ready")}"complete"!==document.readyState&&"loading"===document.readyState||document.documentElement.doScroll?document.addEventListener("DOMContentLoaded",e):e()},519:()=>{document.querySelectorAll("table").forEach((function(e){var t=e.querySelectorAll("th");0!==t.length&&e.querySelectorAll("tbody tr").forEach((function(e){e.querySelectorAll("td").forEach((function(e,o){t[o].textContent&&e.setAttribute("data-label",t[o].textContent)}))}))}))},578:()=>{function e(){window.scrollY>0?document.body.classList.add("scrolled"):document.body.classList.remove("scrolled")}document.addEventListener("scroll",e),document.addEventListener("DOMContentLoaded",e)},635:()=>{document.body.className=document.body.className.replace("no-js","js")},831:()=>{function e(){var e=document.querySelector(".off-canvas-screen");if(e){var t=document.querySelector(".off-canvas-container"),o=document.querySelector(".off-canvas-open"),n=document.querySelector(".off-canvas-close");o.addEventListener("click",i),n.addEventListener("click",i),e.addEventListener("click",a),document.body.addEventListener("keydown",(function(e){27===e.keyCode&&a()}))}function a(){t.classList.remove("is-visible"),o.classList.remove("is-visible"),n.classList.remove("is-visible"),e.classList.remove("is-visible"),t.setAttribute("aria-hidden",!0),o.setAttribute("aria-expanded",!1)}function i(){"true"===o.getAttribute("aria-expanded")?a():(t.classList.add("is-visible"),o.classList.add("is-visible"),n.classList.add("is-visible"),e.classList.add("is-visible"),t.setAttribute("aria-hidden",!1),o.setAttribute("aria-expanded",!0),n.setAttribute("aria-expanded",!0))}}"complete"!==document.readyState&&"loading"===document.readyState||document.documentElement.doScroll?document.addEventListener("DOMContentLoaded",e):e()},846:()=>{function e(){var e=document.querySelectorAll(".modal-trigger"),t=document.querySelectorAll(".modal .close"),o=document.body;function n(e){var t=e.target.getAttribute("data-target"),n=document.querySelector(t),a=n.querySelectorAll("a, input, button");o.classList.add("modal-open"),n.classList.add("modal-open"),n.setAttribute("aria-hidden",!1),0<a.length&&a[0].focus()}function a(e){var t=e.target.getAttribute("data-target"),n=document.querySelector(t),a=n.querySelector("iframe");if(o.classList.remove("modal-open"),n.classList.remove("modal-open"),n.setAttribute("aria-hidden",!0),a){var i=a.getAttribute("src");a.setAttribute("src",""),a.setAttribute("src",i)}}e.forEach((function(e){e.addEventListener("click",n)})),t.forEach((function(e){e.addEventListener("click",a)})),o.addEventListener("keydown",(function(e){if(!o.classList.contains("modal-open"))return;var t=document.querySelector(".modal.modal-open"),n=t.querySelector("iframe");if(27===e.keyCode&&(t.setAttribute("aria-hidden",!0),t.classList.remove("modal-open"),o.classList.remove("modal-open"),n)){var a=n.getAttribute("src");n.setAttribute("src",""),n.setAttribute("src",a)}})),o.addEventListener("click",(function(e){var t=e.target;if(o.classList.contains("modal-open")&&t.classList.contains("modal-open")){var n=t.querySelector("iframe");if(o.classList.remove("modal-open"),t.classList.remove("modal-open"),t.setAttribute("aria-hidden",!0),n){var a=n.getAttribute("src");n.setAttribute("src",""),n.setAttribute("src",a)}}}))}"complete"!==document.readyState&&"loading"===document.readyState||document.documentElement.doScroll?document.addEventListener("DOMContentLoaded",e):e()}},t={};function o(n){var a=t[n];if(void 0!==a)return a.exports;var i=t[n]={exports:{}};return e[n](i,i.exports,o),i.exports}(()=>{"use strict";o(635),o(282),o(578),o(25),o(846),o(110),o(831),o(519),o(20),o(77);var e=function(){var e=document.getElementById("powerail-animation-container");if(e){var t=e.querySelector(".sticky"),o=t.clientHeight,n=t.querySelectorAll(".powerail-card"),a=window.innerHeight*(window.innerWidth<=1023?5:4);document.addEventListener("scroll",(function(){e.offsetTop<=window.scrollY&&function(e,t,o,n){var a=window.scrollY-e.offsetTop,i=t/5,r=[a>=i?100:Math.round(100*a/i),a>=2*i?100:a-i<=0?0:Math.floor(100*(a-i)/i),a>=3*i?100:a-2*i<=0?0:Math.floor(100*(a-2*i)/i),a>=4*i?100:a-3*i<=0?0:Math.floor(100*(a-3*i)/i),a>=5*i?100:a-4*i<=0?0:Math.floor(100*(a-4*i)/i),a>=6*i?100:a-5*i<=0?0:Math.floor(100*(a-5*i)/i)];o.forEach((function(e,t){var o=e.querySelector(".powerail-text");if(window.innerWidth,void 0!==r[t+1]&&0!==r[t+1]){var a=1-r[t+1]/100;o.style.opacity="".concat(a)}else e.style.opacity="".concat(r[t]/100);var i=n-1.5*e.clientHeight;if(e.style.top="".concat(i*r[t]/100,"px"),3===t)if(100===r[t]){var c=e.querySelector(".swap-image-1"),s=e.querySelector(".swap-image-2");c.classList.add("opacity-0"),s.classList.remove("opacity-0")}else{var d=e.querySelector(".swap-image-1"),l=e.querySelector(".swap-image-2");d.classList.remove("opacity-0"),l.classList.add("opacity-0")}}))}(e,a,n,o)}))}},t=function(){var e=document.getElementById("sonora-animation-container");if(e){var t=window.innerWidth<=1023,o=window.innerHeight*(t?5:4),n=document.getElementById("sonora-sprite-container"),a=document.querySelectorAll(".sonora-text-block"),i=[{min:0,max:10},{min:11,max:20},{min:21,max:30},{min:31,max:40},{min:41,max:50},{min:51,max:60},{min:61,max:70},{min:71,max:80},{min:81,max:90},{min:91,max:100},{min:101,max:110},{min:111,max:120},{min:121,max:130},{min:131,max:140},{min:141,max:150},{min:151,max:160},{min:161,max:170},{min:171,max:180}];document.addEventListener("scroll",(function(){e.offsetTop<=window.scrollY&&function(e,t,o,n,a){for(var i=window.scrollY-e.offsetTop,r=i>=t?100:100*i/t,c=Math.round(1.8*r),s=0,d=0;d<o.length;d++)c>=o[d].min&&c<=o[d].max&&(s=d);var l=n.clientWidth;n.style.backgroundPosition="-".concat(l*s,"px 0px");var u=window.innerWidth<=1023;2<r&&(!u||r<=25)?a[0].classList.remove("opacity-0"):a[0].classList.add("opacity-0"),25<r&&(!u||r<=50)?a[1].classList.remove("opacity-0"):a[1].classList.add("opacity-0"),50<r&&(!u||r<=75)?a[2].classList.remove("opacity-0"):a[2].classList.add("opacity-0"),r>75?a[3].classList.remove("opacity-0"):a[3].classList.add("opacity-0")}(e,o,i,n,a)}))}};document.addEventListener("DOMContentLoaded",(function(){e(),t();var o=document.querySelectorAll(".arrow-down"),n=document.querySelectorAll(".header-btn");o.forEach((function(e){e.addEventListener("click",(function(e){e.preventDefault();var t=document.querySelector(".page-header");if(t){var o=t.offsetTop+t.offsetHeight-100;window.scrollTo({top:o,behavior:"smooth"})}}))})),n.forEach((function(e){e.addEventListener("click",(function(e){e.preventDefault();var t=document.querySelector(".header-btn-scroll");if(t){var o=t.offsetTop+t.offsetHeight-100;window.scrollTo({top:o,behavior:"smooth"})}}))}))}))})()})();