(()=>{var t={20:()=>{!function(){function t(t){var e=t.target.parentNode,n=e.querySelector(".video-background");e.classList.toggle("video-toggled"),e.classList.contains("video-toggled")?n.pause():n.play()}document.querySelectorAll(".video-toggle").forEach((function(e){e.addEventListener("click",t)}))}()},25:()=>{function t(){function t(t){t.preventDefault();var n=t.target.parentNode.closest(".menu-item-has-children"),o=n.querySelector("ul.sub-menu");!function(t){var n=e(t);n.forEach((function(t){t.classList.remove("is-visible"),t.querySelector(".parent-indicator")&&t.querySelector(".parent-indicator").setAttribute("aria-expanded",!1),t.querySelector(".sub-menu")&&t.querySelector(".sub-menu").classList.remove("is-visible","animated","slideInLeft")}))}(n),function(t,e){if(t.classList.contains("is-visible"))return void function(t,e){t.classList.remove("is-visible"),t.querySelector(".parent-indicator").setAttribute("aria-expanded",!1),e.classList.remove("is-visible","animated","slideInLeft")}(t,e);t.classList.add("is-visible"),t.querySelector(".parent-indicator").setAttribute("aria-expanded",!0),e.classList.add("is-visible","animated","slideInLeft")}(n,o)}document.querySelectorAll(".mobile-menu li.menu-item-has-children, .utility-navigation li.menu-item-has-children").forEach((function(e){e.querySelector("a").innerHTML+='<button type="button" aria-expanded="false" class="parent-indicator caret-down" aria-label="Open submenu"><span class="down-arrow"></span></button>',document.querySelectorAll(".parent-indicator").forEach((function(e){e.addEventListener("click",t)}))}));var e=function(t){for(var e=[],n=t.parentNode.firstChild;n;)1===n.nodeType&&n!==t&&e.push(n),n=n.nextSibling;return e}}"complete"!==document.readyState&&"loading"===document.readyState||document.documentElement.doScroll?document.addEventListener("DOMContentLoaded",t):t()},77:()=>{document.body.classList.contains("page-template-powerail")},110:()=>{!function(){var t=document.querySelectorAll(".main-navigation .menu-item-has-children");function e(t){o(t.target.parentNode,".menu-item-has-children").forEach((function(t){t.classList.add("focus")}))}function n(t){o(t.target.parentNode,".menu-item-has-children").forEach((function(t){t.classList.remove("focus")}))}document.addEventListener("DOMContentLoaded",(function(){t.forEach((function(t){t.querySelector("a").innerHTML+='<span class="caret-down" aria-hidden="true"></span>'}))})),document.addEventListener("DOMContentLoaded",(function(){t.forEach((function(t){t.addEventListener("focusin",e),t.addEventListener("focusout",n)}))}));var o=function(t,e){Element.prototype.matches||(Element.prototype.matches=Element.prototype.matchesSelector||Element.prototype.mozMatchesSelector||Element.prototype.msMatchesSelector||Element.prototype.oMatchesSelector||Element.prototype.webkitMatchesSelector||function(t){for(var e=(this.document||this.ownerDocument).querySelectorAll(t),n=e.length;0>=--n&&e.item(n)!==this;);return-1>n});for(var n=[];t&&t!==document;t=t.parentNode)e?t.matches(e)&&n.push(t):n.push(t);return n}}()},282:()=>{function t(){document.body.classList.add("ready")}"complete"!==document.readyState&&"loading"===document.readyState||document.documentElement.doScroll?document.addEventListener("DOMContentLoaded",t):t()},519:()=>{document.querySelectorAll("table").forEach((function(t){var e=t.querySelectorAll("th");0!==e.length&&t.querySelectorAll("tbody tr").forEach((function(t){t.querySelectorAll("td").forEach((function(t,n){e[n].textContent&&t.setAttribute("data-label",e[n].textContent)}))}))}))},578:()=>{function t(){window.scrollY>0?document.body.classList.add("scrolled"):document.body.classList.remove("scrolled")}document.addEventListener("scroll",t),document.addEventListener("DOMContentLoaded",t)},635:()=>{document.body.className=document.body.className.replace("no-js","js")},831:()=>{function t(){var t=document.querySelector(".off-canvas-screen");if(t){var e=document.querySelector(".off-canvas-container"),n=document.querySelector(".off-canvas-open"),o=document.querySelector(".off-canvas-close");n.addEventListener("click",i),o.addEventListener("click",i),t.addEventListener("click",r),document.body.addEventListener("keydown",(function(t){27===t.keyCode&&r()}))}function r(){e.classList.remove("is-visible"),n.classList.remove("is-visible"),o.classList.remove("is-visible"),t.classList.remove("is-visible"),e.setAttribute("aria-hidden",!0),n.setAttribute("aria-expanded",!1)}function i(){"true"===n.getAttribute("aria-expanded")?r():(e.classList.add("is-visible"),n.classList.add("is-visible"),o.classList.add("is-visible"),t.classList.add("is-visible"),e.setAttribute("aria-hidden",!1),n.setAttribute("aria-expanded",!0),o.setAttribute("aria-expanded",!0))}}"complete"!==document.readyState&&"loading"===document.readyState||document.documentElement.doScroll?document.addEventListener("DOMContentLoaded",t):t()},846:()=>{function t(){var t=document.querySelectorAll(".modal-trigger"),e=document.querySelectorAll(".modal .close"),n=document.body;function o(t){var e=t.target.getAttribute("data-target"),o=document.querySelector(e),r=o.querySelectorAll("a, input, button");n.classList.add("modal-open"),o.classList.add("modal-open"),o.setAttribute("aria-hidden",!1),0<r.length&&r[0].focus()}function r(t){var e=t.target.getAttribute("data-target"),o=document.querySelector(e),r=o.querySelector("iframe");if(n.classList.remove("modal-open"),o.classList.remove("modal-open"),o.setAttribute("aria-hidden",!0),r){var i=r.getAttribute("src");r.setAttribute("src",""),r.setAttribute("src",i)}}t.forEach((function(t){t.addEventListener("click",o)})),e.forEach((function(t){t.addEventListener("click",r)})),n.addEventListener("keydown",(function(t){if(!n.classList.contains("modal-open"))return;var e=document.querySelector(".modal.modal-open"),o=e.querySelector("iframe");if(27===t.keyCode&&(e.setAttribute("aria-hidden",!0),e.classList.remove("modal-open"),n.classList.remove("modal-open"),o)){var r=o.getAttribute("src");o.setAttribute("src",""),o.setAttribute("src",r)}})),n.addEventListener("click",(function(t){var e=t.target;if(n.classList.contains("modal-open")&&e.classList.contains("modal-open")){var o=e.querySelector("iframe");if(n.classList.remove("modal-open"),e.classList.remove("modal-open"),e.setAttribute("aria-hidden",!0),o){var r=o.getAttribute("src");o.setAttribute("src",""),o.setAttribute("src",r)}}}))}"complete"!==document.readyState&&"loading"===document.readyState||document.documentElement.doScroll?document.addEventListener("DOMContentLoaded",t):t()}},e={};function n(o){var r=e[o];if(void 0!==r)return r.exports;var i=e[o]={exports:{}};return t[o](i,i.exports,n),i.exports}(()=>{"use strict";n(635),n(282),n(578);function t(t){return"number"==typeof t}function e(t){return"string"==typeof t}function o(t){return"boolean"==typeof t}function r(t){return"[object Object]"===Object.prototype.toString.call(t)}function i(t){return Math.abs(t)}function c(t){return Math.sign(t)}function s(t,e){return i(t-e)}function a(t){return m(t).map(Number)}function u(t){return t[d(t)]}function d(t){return Math.max(0,t.length-1)}function l(t,e){return e===d(t)}function f(t,e=0){return Array.from(Array(t),((t,n)=>e+n))}function m(t){return Object.keys(t)}function p(t,e){return[t,e].reduce(((t,e)=>(m(e).forEach((n=>{const o=t[n],i=e[n],c=r(o)&&r(i);t[n]=c?p(o,i):i})),t)),{})}function g(t,e){return void 0!==e.MouseEvent&&t instanceof e.MouseEvent}function v(){let t=[];const e={add:function(n,o,r,i={passive:!0}){let c;if("addEventListener"in n)n.addEventListener(o,r,i),c=()=>n.removeEventListener(o,r,i);else{const t=n;t.addListener(r),c=()=>t.removeListener(r)}return t.push(c),e},clear:function(){t=t.filter((t=>t()))}};return e}function h(t,e,n,o){const r=v(),i=1e3/60;let c=null,s=0,a=0;function u(t){if(!a)return;c||(c=t,n(),n());const r=t-c;for(c=t,s+=r;s>=i;)n(),s-=i;o(s/i),a&&(a=e.requestAnimationFrame(u))}function d(){e.cancelAnimationFrame(a),c=null,s=0,a=0}return{init:function(){r.add(t,"visibilitychange",(()=>{t.hidden&&(c=null,s=0)}))},destroy:function(){d(),r.clear()},start:function(){a||(a=e.requestAnimationFrame(u))},stop:d,update:n,render:o}}function y(t=0,e=0){const n=i(t-e);function o(e){return e<t}function r(t){return t>e}function c(t){return o(t)||r(t)}return{length:n,max:e,min:t,constrain:function(n){return c(n)?o(n)?t:e:n},reachedAny:c,reachedMax:r,reachedMin:o,removeOffset:function(t){return n?t-n*Math.ceil((t-e)/n):t}}}function L(t,e,n){const{constrain:o}=y(0,t),r=t+1;let c=s(e);function s(t){return n?i((r+t)%r):o(t)}function a(){return c}function u(){return L(t,a(),n)}const d={get:a,set:function(t){return c=s(t),d},add:function(t){return u().set(a()+t)},clone:u};return d}function b(t,e,n,r,a,u,d,l,f,m,p,h,L,b,S,x,E,w,A){const{cross:q,direction:M}=t,D=["INPUT","SELECT","TEXTAREA"],k={passive:!1},I=v(),T=v(),O=y(50,225).constrain(b.measure(20)),H={mouse:300,touch:400},C={mouse:500,touch:600},F=S?43:25;let P=!1,N=0,z=0,B=!1,V=!1,R=!1,W=!1;function j(t){if(!g(t,r)&&t.touches.length>=2)return G(t);const e=u.readPoint(t),n=u.readPoint(t,q),o=s(e,N),i=s(n,z);if(!V&&!W){if(!t.cancelable)return G(t);if(V=o>i,!V)return G(t)}const c=u.pointerMove(t);o>x&&(R=!0),m.useFriction(.3).useDuration(.75),l.start(),a.add(M(c)),t.preventDefault()}function G(t){const e=p.byDistance(0,!1).index!==h.get(),n=u.pointerUp(t)*(S?C:H)[W?"mouse":"touch"],o=function(t,e){const n=h.add(-1*c(t)),o=p.byDistance(t,!S).distance;return S||i(t)<O?o:E&&e?.5*o:p.byIndex(n.get(),0).distance}(M(n),e),r=function(t,e){if(0===t||0===e)return 0;if(i(t)<=i(e))return 0;const n=s(i(t),i(e));return i(n/t)}(n,o),a=F-10*r,d=w+r/50;V=!1,B=!1,T.clear(),m.useDuration(a).useFriction(d),f.distance(o,!S),W=!1,L.emit("pointerUp")}function Y(t){R&&(t.stopPropagation(),t.preventDefault(),R=!1)}const U={init:function(t){if(!A)return;function i(i){(o(A)||A(t,i))&&function(t){const o=g(t,r);if(W=o,R=S&&o&&!t.buttons&&P,P=s(a.get(),d.get())>=2,o&&0!==t.button)return;if(function(t){const e=t.nodeName||"";return D.includes(e)}(t.target))return;B=!0,u.pointerDown(t),m.useFriction(0).useDuration(0),a.set(d),function(){const t=W?n:e;T.add(t,"touchmove",j,k).add(t,"touchend",G).add(t,"mousemove",j,k).add(t,"mouseup",G)}(),N=u.readPoint(t),z=u.readPoint(t,q),L.emit("pointerDown")}(i)}const c=e;I.add(c,"dragstart",(t=>t.preventDefault()),k).add(c,"touchmove",(()=>{}),k).add(c,"touchend",(()=>{})).add(c,"touchstart",i).add(c,"mousedown",i).add(c,"touchcancel",G).add(c,"contextmenu",G).add(c,"click",Y,!0)},destroy:function(){I.clear(),T.clear()},pointerDown:function(){return B}};return U}function S(t,e){let n,o;function r(t){return t.timeStamp}function c(n,o){const r="client"+("x"===(o||t.scroll)?"X":"Y");return(g(n,e)?n:n.touches[0])[r]}return{pointerDown:function(t){return n=t,o=t,c(t)},pointerMove:function(t){const e=c(t)-c(o),i=r(t)-r(n)>170;return o=t,i&&(n=t),e},pointerUp:function(t){if(!n||!o)return 0;const e=c(o)-c(n),s=r(t)-r(n),a=r(t)-r(o)>170,u=e/s;return s&&!a&&i(u)>.1?u:0},readPoint:c}}function x(t,e,n,r,c,s,a){const u=[t].concat(r);let d,l,f=[],m=!1;function p(t){return c.measureSize(a.measure(t))}const g={init:function(c){s&&(l=p(t),f=r.map(p),d=new ResizeObserver((n=>{(o(s)||s(c,n))&&function(n){for(const o of n){if(m)return;const n=o.target===t,s=r.indexOf(o.target),a=n?l:f[s];if(i(p(n?t:r[s])-a)>=.5){c.reInit(),e.emit("resize");break}}}(n)})),n.requestAnimationFrame((()=>{u.forEach((t=>d.observe(t)))})))},destroy:function(){m=!0,d&&d.disconnect()}};return g}function E(t,e,n,o,r){const c=r.measure(10),s=r.measure(50),a=y(.1,.99);let u=!1;function d(){return!u&&(!!t.reachedAny(n.get())&&!!t.reachedAny(e.get()))}return{shouldConstrain:d,constrain:function(r){if(!d())return;const u=t.reachedMin(e.get())?"min":"max",l=i(t[u]-e.get()),f=n.get()-e.get(),m=a.constrain(l/s);n.subtract(f*m),!r&&i(f)<c&&(n.set(t.constrain(n.get())),o.useDuration(25).useBaseFriction())},toggleActive:function(t){u=!t}}}function w(t,e,n,o){const r=e.min+.1,i=e.max+.1,{reachedMin:c,reachedMax:s}=y(r,i);return{loop:function(e){if(!function(t){return 1===t?s(n.get()):-1===t&&c(n.get())}(e))return;const r=t*(-1*e);o.forEach((t=>t.add(r)))}}}function A(t,e,n,o,r){const{reachedAny:s,removeOffset:a,constrain:d}=o;function l(t){return t.concat().sort(((t,e)=>i(t)-i(e)))[0]}function f(e,o){const r=[e,e+n,e-n];if(!t)return e;if(!o)return l(r);const i=r.filter((t=>c(t)===o));return i.length?l(i):u(r)-n}return{byDistance:function(n,o){const c=r.get()+n,{index:u,distance:l}=function(n){const o=t?a(n):d(n),r=e.map(((t,e)=>({diff:f(t-o,0),index:e}))).sort(((t,e)=>i(t.diff)-i(e.diff))),{index:c}=r[0];return{index:c,distance:o}}(c),m=!t&&s(c);return!o||m?{index:u,distance:n}:{index:u,distance:n+f(e[u]-l,0)}},byIndex:function(t,n){return{index:t,distance:f(e[t]-r.get(),n)}},shortcut:f}}function q(e,n,r,i,c,s,a,u){const d={passive:!0,capture:!0};let l=0;function f(t){"Tab"===t.code&&(l=(new Date).getTime())}const m={init:function(m){u&&(s.add(document,"keydown",f,!1),n.forEach(((n,f)=>{s.add(n,"focus",(n=>{(o(u)||u(m,n))&&function(n){if((new Date).getTime()-l>10)return;a.emit("slideFocusStart"),e.scrollLeft=0;const o=r.findIndex((t=>t.includes(n)));t(o)&&(c.useDuration(0),i.index(o,0),a.emit("slideFocus"))}(f)}),d)})))}};return m}function M(e){let n=e;function o(e){return t(e)?e:e.get()}return{get:function(){return n},set:function(t){n=o(t)},add:function(t){n+=o(t)},subtract:function(t){n-=o(t)}}}function D(t,e){const n="x"===t.scroll?function(t){return`translate3d(${t}px,0px,0px)`}:function(t){return`translate3d(0px,${t}px,0px)`},o=e.style;let r=null,i=!1;return{clear:function(){i||(o.transform="",e.getAttribute("style")||e.removeAttribute("style"))},to:function(e){if(i)return;const c=(s=t.direction(e),Math.round(100*s)/100);var s;c!==r&&(o.transform=n(c),r=c)},toggleActive:function(t){i=!t}}}function k(t,e,n,o,r,i,c,s,u){const d=a(r),l=a(r).reverse(),f=function(){const t=c[0];return g(p(l,t),n,!1)}().concat(function(){const t=e-c[0]-1;return g(p(d,t),-n,!0)}());function m(t,e){return t.reduce(((t,e)=>t-r[e]),e)}function p(t,e){return t.reduce(((t,n)=>m(t,e)>0?t.concat([n]):t),[])}function g(r,c,a){const d=function(t){return i.map(((n,r)=>({start:n-o[r]+.5+t,end:n+e-.5+t})))}(c);return r.map((e=>{const o=a?0:-n,r=a?n:0,i=a?"end":"start",c=d[e][i];return{index:e,loopPoint:c,slideLocation:M(-1),translate:D(t,u[e]),target:()=>s.get()>c?o:r}}))}return{canLoop:function(){return f.every((({index:t})=>m(d.filter((e=>e!==t)),e)<=.1))},clear:function(){f.forEach((t=>t.translate.clear()))},loop:function(){f.forEach((t=>{const{target:e,translate:n,slideLocation:o}=t,r=e();r!==o.get()&&(n.to(r),o.set(r))}))},loopPoints:f}}function I(t,e,n){let r,i=!1;const c={init:function(c){n&&(r=new MutationObserver((t=>{i||(o(n)||n(c,t))&&function(t){for(const n of t)if("childList"===n.type){c.reInit(),e.emit("slidesChanged");break}}(t)})),r.observe(t,{childList:!0}))},destroy:function(){r&&r.disconnect(),i=!0}};return c}function T(t,e,n,o){const r={};let i,c=null,s=null,a=!1;return{init:function(){i=new IntersectionObserver((t=>{a||(t.forEach((t=>{const n=e.indexOf(t.target);r[n]=t})),c=null,s=null,n.emit("slidesInView"))}),{root:t.parentElement,threshold:o}),e.forEach((t=>i.observe(t)))},destroy:function(){i&&i.disconnect(),a=!0},get:function(t=!0){if(t&&c)return c;if(!t&&s)return s;const e=function(t){return m(r).reduce(((e,n)=>{const o=parseInt(n),{isIntersecting:i}=r[o];return(t&&i||!t&&!i)&&e.push(o),e}),[])}(t);return t&&(c=e),t||(s=e),e}}}function O(e,n,o,r,c,s,l,f,m){const{startEdge:p,endEdge:g,direction:v}=e,h=t(o);return{groupSlides:function(t){return h?function(t,e){return a(t).filter((t=>t%e==0)).map((n=>t.slice(n,n+e)))}(t,o):function(t){return t.length?a(t).reduce(((e,o,a)=>{const h=u(e)||0,y=0===h,L=o===d(t),b=c[p]-s[h][p],S=c[p]-s[o][g],x=!r&&y?v(l):0,E=i(S-(!r&&L?v(f):0)-(b+x));return a&&E>n+m&&e.push(o),L&&e.push(t.length),e}),[]).map(((e,n,o)=>{const r=Math.max(o[n-1]||0);return t.slice(r,e)})):[]}(t)}}}function H(t,n,o,r,m,p,g){const{align:H,axis:C,direction:F,startIndex:P,loop:N,duration:z,dragFree:B,dragThreshold:V,inViewThreshold:R,slidesToScroll:W,skipSnaps:j,containScroll:G,watchResize:Y,watchSlides:U,watchDrag:$,watchFocus:Q}=p,X={measure:function(t){const{offsetTop:e,offsetLeft:n,offsetWidth:o,offsetHeight:r}=t;return{top:e,right:n+o,bottom:e+r,left:n,width:o,height:r}}},_=X.measure(n),J=o.map(X.measure),K=function(t,e){const n="rtl"===e,o="y"===t,r=!o&&n?-1:1;return{scroll:o?"y":"x",cross:o?"x":"y",startEdge:o?"top":n?"right":"left",endEdge:o?"bottom":n?"left":"right",measureSize:function(t){const{height:e,width:n}=t;return o?e:n},direction:function(t){return t*r}}}(C,F),Z=K.measureSize(_),tt=function(t){return{measure:function(e){return t*(e/100)}}}(Z),et=function(t,n){const o={start:function(){return 0},center:function(t){return r(t)/2},end:r};function r(t){return n-t}return{measure:function(r,i){return e(t)?o[t](r):t(n,r,i)}}}(H,Z),nt=!N&&!!G,ot=N||!!G,{slideSizes:rt,slideSizesWithGaps:it,startGap:ct,endGap:st}=function(t,e,n,o,r,c){const{measureSize:s,startEdge:a,endEdge:d}=t,f=n[0]&&r,m=function(){if(!f)return 0;const t=n[0];return i(e[a]-t[a])}(),p=function(){if(!f)return 0;const t=c.getComputedStyle(u(o));return parseFloat(t.getPropertyValue(`margin-${d}`))}(),g=n.map(s),v=n.map(((t,e,n)=>{const o=!e,r=l(n,e);return o?g[e]+m:r?g[e]+p:n[e+1][a]-t[a]})).map(i);return{slideSizes:g,slideSizesWithGaps:v,startGap:m,endGap:p}}(K,_,J,o,ot,m),at=O(K,Z,W,N,_,J,ct,st,2),{snaps:ut,snapsAligned:dt}=function(t,e,n,o,r){const{startEdge:c,endEdge:s}=t,{groupSlides:a}=r,d=a(o).map((t=>u(t)[s]-t[0][c])).map(i).map(e.measure),l=o.map((t=>n[c]-t[c])).map((t=>-i(t))),f=a(l).map((t=>t[0])).map(((t,e)=>t+d[e]));return{snaps:l,snapsAligned:f}}(K,et,_,J,at),lt=-u(ut)+u(it),{snapsContained:ft,scrollContainLimit:mt}=function(t,e,n,o,r){const i=y(-e+t,0),c=n.map(((t,e)=>{const{min:o,max:r}=i,c=i.constrain(t),s=!e,a=l(n,e);return s?r:a||d(o,c)?o:d(r,c)?r:c})).map((t=>parseFloat(t.toFixed(3)))),a=function(){const t=c[0],e=u(c);return y(c.lastIndexOf(t),c.indexOf(e)+1)}();function d(t,e){return s(t,e)<=1}return{snapsContained:function(){if(e<=t+r)return[i.max];if("keepSnaps"===o)return c;const{min:n,max:s}=a;return c.slice(n,s)}(),scrollContainLimit:a}}(Z,lt,dt,G,2),pt=nt?ft:dt,{limit:gt}=function(t,e,n){const o=e[0];return{limit:y(n?o-t:u(e),o)}}(lt,pt,N),vt=L(d(pt),P,N),ht=vt.clone(),yt=a(o),Lt=h(r,m,(()=>(({dragHandler:t,scrollBody:e,scrollBounds:n,options:{loop:o}})=>{o||n.constrain(t.pointerDown()),e.seek()})(Ht)),(t=>(({scrollBody:t,translate:e,location:n,offsetLocation:o,previousLocation:r,scrollLooper:i,slideLooper:c,dragHandler:s,animation:a,eventHandler:u,scrollBounds:d,options:{loop:l}},f)=>{const m=t.settled(),p=!d.shouldConstrain(),g=l?m:m&&p;g&&!s.pointerDown()&&(a.stop(),u.emit("settle")),g||u.emit("scroll");const v=n.get()*f+r.get()*(1-f);o.set(v),l&&(i.loop(t.direction()),c.loop()),e.to(o.get())})(Ht,t))),bt=pt[vt.get()],St=M(bt),xt=M(bt),Et=M(bt),wt=M(bt),At=function(t,e,n,o,r,s){let a=0,u=0,d=r,l=s,f=t.get(),m=0;function p(t){return d=t,v}function g(t){return l=t,v}const v={direction:function(){return u},duration:function(){return d},velocity:function(){return a},seek:function(){const e=o.get()-t.get();let r=0;return d?(n.set(t),a+=e/d,a*=l,f+=a,t.add(a),r=f-m):(a=0,n.set(o),t.set(o),r=e),u=c(r),m=f,v},settled:function(){return i(o.get()-e.get())<.001},useBaseFriction:function(){return g(s)},useBaseDuration:function(){return p(r)},useFriction:g,useDuration:p};return v}(St,Et,xt,wt,z,.68),qt=A(N,pt,lt,gt,wt),Mt=function(t,e,n,o,r,i,c){function s(r){const s=r.distance,a=r.index!==e.get();i.add(s),s&&(o.duration()?t.start():(t.update(),t.render(1),t.update())),a&&(n.set(e.get()),e.set(r.index),c.emit("select"))}return{distance:function(t,e){s(r.byDistance(t,e))},index:function(t,n){const o=e.clone().set(t);s(r.byIndex(o.get(),n))}}}(Lt,vt,ht,At,qt,wt,g),Dt=function(t){const{max:e,length:n}=t;return{get:function(t){return n?(t-e)/-n:0}}}(gt),kt=v(),It=T(n,o,g,R),{slideRegistry:Tt}=function(t,e,n,o,r,i){const{groupSlides:c}=r,{min:s,max:a}=o;return{slideRegistry:function(){const o=c(i),r=!t||"keepSnaps"===e;return 1===n.length?[i]:r?o:o.slice(s,a).map(((t,e,n)=>{const o=!e,r=l(n,e);return o?f(u(n[0])+1):r?f(d(i)-u(n)[0]+1,u(n)[0]):t}))}()}}(nt,G,pt,mt,at,yt),Ot=q(t,o,Tt,Mt,At,kt,g,Q),Ht={ownerDocument:r,ownerWindow:m,eventHandler:g,containerRect:_,slideRects:J,animation:Lt,axis:K,dragHandler:b(K,t,r,m,wt,S(K,m),St,Lt,Mt,At,qt,vt,g,tt,B,V,j,.68,$),eventStore:kt,percentOfView:tt,index:vt,indexPrevious:ht,limit:gt,location:St,offsetLocation:Et,previousLocation:xt,options:p,resizeHandler:x(n,g,m,o,K,Y,X),scrollBody:At,scrollBounds:E(gt,Et,wt,At,tt),scrollLooper:w(lt,gt,Et,[St,Et,xt,wt]),scrollProgress:Dt,scrollSnapList:pt.map(Dt.get),scrollSnaps:pt,scrollTarget:qt,scrollTo:Mt,slideLooper:k(K,Z,lt,rt,it,ut,pt,Et,o),slideFocus:Ot,slidesHandler:I(n,g,U),slidesInView:It,slideIndexes:yt,slideRegistry:Tt,slidesToScroll:at,target:wt,translate:D(K,n)};return Ht}const C={align:"center",axis:"x",container:null,slides:null,containScroll:"trimSnaps",direction:"ltr",slidesToScroll:1,inViewThreshold:0,breakpoints:{},dragFree:!1,dragThreshold:10,loop:!1,skipSnaps:!1,duration:25,startIndex:0,active:!0,watchDrag:!0,watchResize:!0,watchSlides:!0,watchFocus:!0};function F(t){function e(t,e){return p(t,e||{})}const n={mergeOptions:e,optionsAtMedia:function(n){const o=n.breakpoints||{},r=m(o).filter((e=>t.matchMedia(e).matches)).map((t=>o[t])).reduce(((t,n)=>e(t,n)),{});return e(n,r)},optionsMediaQueries:function(e){return e.map((t=>m(t.breakpoints||{}))).reduce(((t,e)=>t.concat(e)),[]).map(t.matchMedia)}};return n}function P(t,n,o){const r=t.ownerDocument,i=r.defaultView,c=F(i),s=function(t){let e=[];const n={init:function(n,o){return e=o.filter((({options:e})=>!1!==t.optionsAtMedia(e).active)),e.forEach((e=>e.init(n,t))),o.reduce(((t,e)=>Object.assign(t,{[e.name]:e})),{})},destroy:function(){e=e.filter((t=>t.destroy()))}};return n}(c),a=v(),u=function(){let t,e={};function n(t){return e[t]||[]}const o={init:function(e){t=e},emit:function(e){return n(e).forEach((n=>n(t,e))),o},off:function(t,r){return e[t]=n(t).filter((t=>t!==r)),o},on:function(t,r){return e[t]=n(t).concat([r]),o},clear:function(){e={}}};return o}(),{mergeOptions:d,optionsAtMedia:l,optionsMediaQueries:f}=c,{on:m,off:p,emit:g}=u,h=D;let y,L,b,S,x=!1,E=d(C,P.globalOptions),w=d(E),A=[];function q(e){const n=H(t,b,S,r,i,e,u);if(e.loop&&!n.slideLooper.canLoop()){return q(Object.assign({},e,{loop:!1}))}return n}function M(n,o){x||(E=d(E,n),w=l(E),A=o||A,function(){const{container:n,slides:o}=w,r=e(n)?t.querySelector(n):n;b=r||t.children[0];const i=e(o)?b.querySelectorAll(o):o;S=[].slice.call(i||b.children)}(),y=q(w),f([E,...A.map((({options:t})=>t))]).forEach((t=>a.add(t,"change",D))),w.active&&(y.translate.to(y.location.get()),y.animation.init(),y.slidesInView.init(),y.slideFocus.init(O),y.eventHandler.init(O),y.resizeHandler.init(O),y.slidesHandler.init(O),y.options.loop&&y.slideLooper.loop(),b.offsetParent&&S.length&&y.dragHandler.init(O),L=s.init(O,A)))}function D(t,e){const n=T();k(),M(d({startIndex:n},t),e),u.emit("reInit")}function k(){y.dragHandler.destroy(),y.eventStore.clear(),y.translate.clear(),y.slideLooper.clear(),y.resizeHandler.destroy(),y.slidesHandler.destroy(),y.slidesInView.destroy(),y.animation.destroy(),s.destroy(),a.clear()}function I(t,e,n){w.active&&!x&&(y.scrollBody.useBaseFriction().useDuration(!0===e?0:w.duration),y.scrollTo.index(t,n||0))}function T(){return y.index.get()}const O={canScrollNext:function(){return y.index.add(1).get()!==T()},canScrollPrev:function(){return y.index.add(-1).get()!==T()},containerNode:function(){return b},internalEngine:function(){return y},destroy:function(){x||(x=!0,a.clear(),k(),u.emit("destroy"),u.clear())},off:p,on:m,emit:g,plugins:function(){return L},previousScrollSnap:function(){return y.indexPrevious.get()},reInit:h,rootNode:function(){return t},scrollNext:function(t){I(y.index.add(1).get(),t,-1)},scrollPrev:function(t){I(y.index.add(-1).get(),t,1)},scrollProgress:function(){return y.scrollProgress.get(y.location.get())},scrollSnapList:function(){return y.scrollSnapList},scrollTo:I,selectedScrollSnap:T,slideNodes:function(){return S},slidesInView:function(){return y.slidesInView.get()},slidesNotInView:function(){return y.slidesInView.get(!1)}};return M(n,o),setTimeout((()=>u.emit("init")),0),O}P.globalOptions=void 0;var N=document.querySelector(".embla");if(N){var z=N.querySelector(".embla__viewport");if(z)P(z,{loop:!1})}n(25),n(846),n(110),n(831),n(519),n(20),n(77);var B=function(){var t=document.getElementById("powerail-animation-container");if(t){var e=t.querySelector(".sticky"),n=e.clientHeight,o=e.querySelectorAll(".powerail-card"),r=window.innerHeight*(window.innerWidth<=1023?5:4);document.addEventListener("scroll",(function(){t.offsetTop<=window.scrollY&&function(t,e,n,o){var r=window.scrollY-t.offsetTop,i=e/5,c=[r>=i?100:Math.round(100*r/i),r>=2*i?100:r-i<=0?0:Math.floor(100*(r-i)/i),r>=3*i?100:r-2*i<=0?0:Math.floor(100*(r-2*i)/i),r>=4*i?100:r-3*i<=0?0:Math.floor(100*(r-3*i)/i),r>=5*i?100:r-4*i<=0?0:Math.floor(100*(r-4*i)/i),r>=6*i?100:r-5*i<=0?0:Math.floor(100*(r-5*i)/i)];n.forEach((function(t,e){var n=t.querySelector(".powerail-text");if(window.innerWidth,void 0!==c[e+1]&&0!==c[e+1]){var r=1-c[e+1]/100;n.style.opacity="".concat(r)}else t.style.opacity="".concat(c[e]/100);var i=o-1.5*t.clientHeight;if(t.style.top="".concat(i*c[e]/100,"px"),3===e)if(100===c[e]){var s=t.querySelector(".swap-image-1"),a=t.querySelector(".swap-image-2");s.classList.add("opacity-0"),a.classList.remove("opacity-0")}else{var u=t.querySelector(".swap-image-1"),d=t.querySelector(".swap-image-2");u.classList.remove("opacity-0"),d.classList.add("opacity-0")}}))}(t,r,o,n)}))}},V=function(){var t=document.getElementById("sonora-animation-container");if(t){var e=window.innerWidth<=1023,n=window.innerHeight*(e?5:4),o=document.getElementById("sonora-sprite-container"),r=document.querySelectorAll(".sonora-text-block"),i=[{min:0,max:10},{min:11,max:20},{min:21,max:30},{min:31,max:40},{min:41,max:50},{min:51,max:60},{min:61,max:70},{min:71,max:80},{min:81,max:90},{min:91,max:100},{min:101,max:110},{min:111,max:120},{min:121,max:130},{min:131,max:140},{min:141,max:150},{min:151,max:160},{min:161,max:170},{min:171,max:180}];document.addEventListener("scroll",(function(){t.offsetTop<=window.scrollY&&function(t,e,n,o,r){for(var i=window.scrollY-t.offsetTop,c=i>=e?100:100*i/e,s=Math.round(1.8*c),a=0,u=0;u<n.length;u++)s>=n[u].min&&s<=n[u].max&&(a=u);var d=o.clientWidth;o.style.backgroundPosition="-".concat(d*a,"px 0px");var l=window.innerWidth<=1023;2<c&&(!l||c<=25)?r[0].classList.remove("opacity-0"):r[0].classList.add("opacity-0"),25<c&&(!l||c<=50)?r[1].classList.remove("opacity-0"):r[1].classList.add("opacity-0"),50<c&&(!l||c<=75)?r[2].classList.remove("opacity-0"):r[2].classList.add("opacity-0"),c>75?r[3].classList.remove("opacity-0"):r[3].classList.add("opacity-0")}(t,n,i,o,r)}))}};document.addEventListener("DOMContentLoaded",(function(){B(),V();var t=document.querySelectorAll(".arrow-down"),e=document.querySelectorAll(".header-btn");t.forEach((function(t){t.addEventListener("click",(function(t){t.preventDefault();var e=document.querySelector(".page-header");if(e){var n=e.offsetTop+e.offsetHeight-100;window.scrollTo({top:n,behavior:"smooth"})}}))})),e.forEach((function(t){t.addEventListener("click",(function(t){t.preventDefault();var e=document.querySelector(".header-btn-scroll");if(e){var n=e.offsetTop+e.offsetHeight-100;window.scrollTo({top:n,behavior:"smooth"})}}))}))}))})()})();