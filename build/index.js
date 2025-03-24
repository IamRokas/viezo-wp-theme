/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_tailwind_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/tailwind.scss */ \"./src/scss/tailwind.scss\");\n/* harmony import */ var _scss_index_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./scss/index.scss */ \"./src/scss/index.scss\");\n/* harmony import */ var _js_index__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/index */ \"./src/js/index.js\");\n/* eslint-disable no-undef, no-unused-vars */\n\n\n\n/* eslint-enable no-undef, no-unused-vars */\n\n//# sourceURL=webpack://viezo/./src/index.js?");

/***/ }),

/***/ "./src/js/blocks/index.js":
/*!********************************!*\
  !*** ./src/js/blocks/index.js ***!
  \********************************/
/***/ (() => {

eval("/**\n * Gutenberg Block JS\n *\n * Import JS for Gutenberg blocks.\n */\n// Custom Gutenberg Blocks.\n// import './wd';\n// import './acf';\n\n//# sourceURL=webpack://viezo/./src/js/blocks/index.js?");

/***/ }),

/***/ "./src/js/global/index.js":
/*!********************************!*\
  !*** ./src/js/global/index.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _js_enabled__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./js-enabled */ \"./src/js/global/js-enabled.js\");\n/* harmony import */ var _js_enabled__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_js_enabled__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _window_ready__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./window-ready */ \"./src/js/global/window-ready.js\");\n/* harmony import */ var _window_ready__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_window_ready__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _navbar__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./navbar */ \"./src/js/global/navbar.js\");\n/* harmony import */ var _navbar__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_navbar__WEBPACK_IMPORTED_MODULE_2__);\n/**\n * Global JS\n *\n * Import JS that applies globally.\n */\n\n\n\n\n//# sourceURL=webpack://viezo/./src/js/global/index.js?");

/***/ }),

/***/ "./src/js/global/js-enabled.js":
/*!*************************************!*\
  !*** ./src/js/global/js-enabled.js ***!
  \*************************************/
/***/ (() => {

eval("/**\n * File js-enabled.js\n *\n * If Javascript is enabled, replace the <body> class \"no-js\".\n */\ndocument.body.className = document.body.className.replace('no-js', 'js');\n\n//# sourceURL=webpack://viezo/./src/js/global/js-enabled.js?");

/***/ }),

/***/ "./src/js/global/navbar.js":
/*!*********************************!*\
  !*** ./src/js/global/navbar.js ***!
  \*********************************/
/***/ (() => {

eval("// eslint-disable-next-line eslint-comments/disable-enable-pair\n\n/* eslint-disable no-console */\nfunction navbarScrolled() {\n  if (window.scrollY > 0) {\n    // user is scrolled\n    document.body.classList.add('scrolled');\n  } else {\n    // user is at top of page\n    document.body.classList.remove('scrolled');\n  }\n}\n\ndocument.addEventListener('scroll', navbarScrolled);\ndocument.addEventListener('DOMContentLoaded', navbarScrolled);\n\n//# sourceURL=webpack://viezo/./src/js/global/navbar.js?");

/***/ }),

/***/ "./src/js/global/window-ready.js":
/*!***************************************!*\
  !*** ./src/js/global/window-ready.js ***!
  \***************************************/
/***/ (() => {

eval("/**\n * File window-ready.js\n *\n * Add a \"ready\" class to <body> when window is ready.\n *\n * @author Greg Rickaby, Corey Collins\n * @since January 31, 2020\n */\nfunction wdsWindowReady() {\n  document.body.classList.add('ready');\n}\n\nif (('complete' === document.readyState || 'loading' !== document.readyState) && !document.documentElement.doScroll) {\n  wdsWindowReady();\n} else {\n  document.addEventListener('DOMContentLoaded', wdsWindowReady);\n}\n\n//# sourceURL=webpack://viezo/./src/js/global/window-ready.js?");

/***/ }),

/***/ "./src/js/index.js":
/*!*************************!*\
  !*** ./src/js/index.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _global__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./global */ \"./src/js/global/index.js\");\n/* harmony import */ var _template_tags__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./template-tags */ \"./src/js/template-tags/index.js\");\n/* harmony import */ var _templates__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./templates */ \"./src/js/templates/index.js\");\n/* harmony import */ var _blocks__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./blocks */ \"./src/js/blocks/index.js\");\n/* harmony import */ var _blocks__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_blocks__WEBPACK_IMPORTED_MODULE_3__);\n/**\n * Site JS\n */\n\n\n\n\n\n//# sourceURL=webpack://viezo/./src/js/index.js?");

/***/ }),

/***/ "./src/js/template-tags/index.js":
/*!***************************************!*\
  !*** ./src/js/template-tags/index.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _mobile_menu__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./mobile-menu */ \"./src/js/template-tags/mobile-menu.js\");\n/* harmony import */ var _mobile_menu__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_mobile_menu__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _modal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modal */ \"./src/js/template-tags/modal.js\");\n/* harmony import */ var _modal__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_modal__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _navigation_primary__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./navigation-primary */ \"./src/js/template-tags/navigation-primary.js\");\n/* harmony import */ var _navigation_primary__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_navigation_primary__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _off_canvas__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./off-canvas */ \"./src/js/template-tags/off-canvas.js\");\n/* harmony import */ var _off_canvas__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_off_canvas__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var _table__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./table */ \"./src/js/template-tags/table.js\");\n/* harmony import */ var _table__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_table__WEBPACK_IMPORTED_MODULE_4__);\n/* harmony import */ var _video__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./video */ \"./src/js/template-tags/video.js\");\n/* harmony import */ var _video__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_video__WEBPACK_IMPORTED_MODULE_5__);\n/**\n * Template Tag JS\n *\n * JS for functions in template-tags.php.\n */\n\n\n\n\n\n\n\n//# sourceURL=webpack://viezo/./src/js/template-tags/index.js?");

/***/ }),

/***/ "./src/js/template-tags/mobile-menu.js":
/*!*********************************************!*\
  !*** ./src/js/template-tags/mobile-menu.js ***!
  \*********************************************/
/***/ (() => {

eval("/**\n * File: mobile-menu.js\n *\n * Create an accordion style dropdown.\n */\n// Make sure everything is loaded first.\nif (('complete' === document.readyState || 'loading' !== document.readyState) && !document.documentElement.doScroll) {\n  wdsMobileMenu();\n} else {\n  document.addEventListener('DOMContentLoaded', wdsMobileMenu);\n}\n/**\n * Handle our mobile menus.\n *\n * @author Corey Collins\n * @since January 31, 2020\n */\n\n\nfunction wdsMobileMenu() {\n  var subMenuParentItem = document.querySelectorAll('.mobile-menu li.menu-item-has-children, .utility-navigation li.menu-item-has-children');\n  subMenuParentItem.forEach(function (subMenuParent) {\n    var menuItem = subMenuParent.querySelector('a');\n    menuItem.innerHTML += '<button type=\"button\" aria-expanded=\"false\" class=\"parent-indicator caret-down\" aria-label=\"Open submenu\"><span class=\"down-arrow\"></span></button>';\n    var subMenuTrigger = document.querySelectorAll('.parent-indicator');\n    subMenuTrigger.forEach(function (trigger) {\n      trigger.addEventListener('click', toggleSubmenu);\n    });\n  });\n  /**\n   * Open/Close a submenu.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} event The triggered event.\n   */\n\n  function toggleSubmenu(event) {\n    event.preventDefault();\n    var targetElement = event.target,\n        targetParent = targetElement.parentNode.closest('.menu-item-has-children'),\n        subMenu = targetParent.querySelector('ul.sub-menu');\n    closeAllSubmenus(targetParent);\n    maybeOpenSubmenu(targetParent, subMenu);\n  }\n  /**\n   * Open a submenu.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} parent  The parent menu.\n   * @param {Object} subMenu The submenu.\n   */\n\n\n  function maybeOpenSubmenu(parent, subMenu) {\n    if (parent.classList.contains('is-visible')) {\n      closeSubmenu(parent, subMenu);\n      return;\n    } // Expand the list menu item, and set the corresponding button aria to true.\n\n\n    parent.classList.add('is-visible');\n    parent.querySelector('.parent-indicator').setAttribute('aria-expanded', true); // Slide the menu in.\n\n    subMenu.classList.add('is-visible', 'animated', 'slideInLeft');\n  }\n  /**\n   * Close a submenu.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} parent  The parent item.\n   * @param {Object} subMenu The submenu.\n   */\n\n\n  function closeSubmenu(parent, subMenu) {\n    parent.classList.remove('is-visible');\n    parent.querySelector('.parent-indicator').setAttribute('aria-expanded', false);\n    subMenu.classList.remove('is-visible', 'animated', 'slideInLeft');\n  }\n  /**\n   * Close all open submenus on the same\n   * level/hierarchys the menu we're trying\n   * to open.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} targetParent The target parent item.\n   */\n\n\n  function closeAllSubmenus(targetParent) {\n    var submenuSiblings = getSiblings(targetParent);\n    submenuSiblings.forEach(function (sibling) {\n      sibling.classList.remove('is-visible');\n\n      if (sibling.querySelector('.parent-indicator')) {\n        sibling.querySelector('.parent-indicator').setAttribute('aria-expanded', false);\n      }\n\n      if (sibling.querySelector('.sub-menu')) {\n        sibling.querySelector('.sub-menu').classList.remove('is-visible', 'animated', 'slideInLeft');\n      }\n    });\n  }\n  /**\n   * Find siblings of an item.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} element The element being opened.\n   * @return {Array} List of siblings.\n   */\n\n\n  var getSiblings = function getSiblings(element) {\n    var siblings = [];\n    var sibling = element.parentNode.firstChild;\n\n    while (sibling) {\n      if (1 === sibling.nodeType && sibling !== element) {\n        siblings.push(sibling);\n      }\n\n      sibling = sibling.nextSibling;\n    }\n\n    return siblings;\n  };\n}\n\n//# sourceURL=webpack://viezo/./src/js/template-tags/mobile-menu.js?");

/***/ }),

/***/ "./src/js/template-tags/modal.js":
/*!***************************************!*\
  !*** ./src/js/template-tags/modal.js ***!
  \***************************************/
/***/ (() => {

eval("/**\n * File modal.js\n *\n * Deal with multiple modals and their media.\n */\n// Make sure everything is loaded first.\nif (('complete' === document.readyState || 'loading' !== document.readyState) && !document.documentElement.doScroll) {\n  wdsModals();\n} else {\n  document.addEventListener('DOMContentLoaded', wdsModals);\n}\n/**\n * Fire off our modal functions.\n *\n * @author Corey Collins\n * @since January 31, 2020\n */\n\n\nfunction wdsModals() {\n  var modalTrigger = document.querySelectorAll('.modal-trigger'),\n      modalClose = document.querySelectorAll('.modal .close'),\n      pageBody = document.body; // Loop through each modal trigger on the page and add a listener for its header.\n\n  modalTrigger.forEach(function (trigger) {\n    trigger.addEventListener('click', openModal);\n  });\n  modalClose.forEach(function (trigger) {\n    trigger.addEventListener('click', closeModalOnCloseButton);\n  });\n  pageBody.addEventListener('keydown', closeOnEscape);\n  pageBody.addEventListener('click', closeOnClick);\n  /**\n   * Open a modal when we trigger it.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} event The triggered event.\n   */\n\n  function openModal(event) {\n    var thisTarget = event.target,\n        thisModalTarget = thisTarget.getAttribute('data-target'),\n        thisModal = document.querySelector(thisModalTarget),\n        focusableChildren = thisModal.querySelectorAll('a, input, button');\n    pageBody.classList.add('modal-open');\n    thisModal.classList.add('modal-open');\n    thisModal.setAttribute('aria-hidden', false);\n\n    if (0 < focusableChildren.length) {\n      focusableChildren[0].focus();\n    }\n  }\n  /**\n   * Close a modal when we hit the close button.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} event The triggered event.\n   */\n\n\n  function closeModalOnCloseButton(event) {\n    var thisTarget = event.target,\n        thisModalTarget = thisTarget.getAttribute('data-target'),\n        thisModal = document.querySelector(thisModalTarget),\n        modalIframe = thisModal.querySelector('iframe');\n    pageBody.classList.remove('modal-open');\n    thisModal.classList.remove('modal-open');\n    thisModal.setAttribute('aria-hidden', true);\n\n    if (modalIframe) {\n      var iframeURL = modalIframe.getAttribute('src');\n      modalIframe.setAttribute('src', '');\n      modalIframe.setAttribute('src', iframeURL);\n    }\n  }\n  /**\n   * Close the modal when we hit the escape key.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} event The triggered event.\n   */\n\n\n  function closeOnEscape(event) {\n    if (!pageBody.classList.contains('modal-open')) {\n      return;\n    }\n\n    var currentlyOpenModal = document.querySelector('.modal.modal-open'),\n        modalIframe = currentlyOpenModal.querySelector('iframe');\n\n    if (27 === event.keyCode) {\n      currentlyOpenModal.setAttribute('aria-hidden', true);\n      currentlyOpenModal.classList.remove('modal-open');\n      pageBody.classList.remove('modal-open');\n\n      if (modalIframe) {\n        var iframeURL = modalIframe.getAttribute('src');\n        modalIframe.setAttribute('src', '');\n        modalIframe.setAttribute('src', iframeURL);\n      }\n    }\n  }\n  /**\n   * Close the modal when we hit outside of the modal area.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} event The triggered event.\n   */\n\n\n  function closeOnClick(event) {\n    var clickedElement = event.target;\n\n    if (pageBody.classList.contains('modal-open')) {\n      if (clickedElement.classList.contains('modal-open')) {\n        var modalIframe = clickedElement.querySelector('iframe');\n        pageBody.classList.remove('modal-open');\n        clickedElement.classList.remove('modal-open');\n        clickedElement.setAttribute('aria-hidden', true);\n\n        if (modalIframe) {\n          var iframeURL = modalIframe.getAttribute('src');\n          modalIframe.setAttribute('src', '');\n          modalIframe.setAttribute('src', iframeURL);\n        }\n      }\n    }\n  }\n}\n\n//# sourceURL=webpack://viezo/./src/js/template-tags/modal.js?");

/***/ }),

/***/ "./src/js/template-tags/navigation-primary.js":
/*!****************************************************!*\
  !*** ./src/js/template-tags/navigation-primary.js ***!
  \****************************************************/
/***/ (() => {

eval("/**\n * File: navigation-primary.js\n *\n * Helpers for the primary navigation.\n */\n(function () {\n  var subMenuParentItem = document.querySelectorAll('.main-navigation .menu-item-has-children');\n  document.addEventListener('DOMContentLoaded', addDownArrow);\n  document.addEventListener('DOMContentLoaded', toggleFocusClass);\n  /**\n   * Adds the down arrow to parent menu items.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   */\n\n  function addDownArrow() {\n    subMenuParentItem.forEach(function (parentItem) {\n      var menuItem = parentItem.querySelector('a');\n      menuItem.innerHTML += '<span class=\"caret-down\" aria-hidden=\"true\"></span>';\n    });\n  }\n  /**\n   * Adds event listeners for tabbing in and out of parent items.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   */\n\n\n  function toggleFocusClass() {\n    subMenuParentItem.forEach(function (parentItem) {\n      parentItem.addEventListener('focusin', toggleIn);\n      parentItem.addEventListener('focusout', toggleOut);\n    });\n  }\n  /**\n   * Handle toggling a parent menu on.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} event The triggered event.\n   */\n\n\n  function toggleIn(event) {\n    var parentMenuItems = getParents(event.target.parentNode, '.menu-item-has-children');\n    parentMenuItems.forEach(function (parentItem) {\n      parentItem.classList.add('focus');\n    });\n  }\n  /**\n   * Handle toggling a parent menu off.\n   *\n   * @since January 31, 2020\n   * @author Corey Collins\n   * @param {Object} event The triggered event.\n   */\n\n\n  function toggleOut(event) {\n    var parentMenuItems = getParents(event.target.parentNode, '.menu-item-has-children');\n    parentMenuItems.forEach(function (parentItem) {\n      parentItem.classList.remove('focus');\n    });\n  }\n  /**\n   * Get all of the parents for a matching element and selector.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @see https://gomakethings.com/climbing-up-and-down-the-dom-tree-with-vanilla-javascript/#getting-all-matches-up-the-tree\n   * @param {Object} elem     The parent menu item.\n   * @param {string} selector The CSS class of the element.\n   * @return {Array} Parents.\n   */\n\n\n  var getParents = function getParents(elem, selector) {\n    // Element.matches() polyfill.\n    if (!Element.prototype.matches) {\n      Element.prototype.matches = Element.prototype.matchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector || Element.prototype.oMatchesSelector || Element.prototype.webkitMatchesSelector || function (s) {\n        var matches = (this.document || this.ownerDocument).querySelectorAll(s);\n        var i = matches.length;\n\n        while (0 >= --i && matches.item(i) !== this) {}\n\n        return -1 > i;\n      };\n    } // Setup parents array.\n\n\n    var parents = []; // Get matching parent elements.\n\n    for (; elem && elem !== document; elem = elem.parentNode) {\n      // Add matching parents to array.\n      if (selector) {\n        if (elem.matches(selector)) {\n          parents.push(elem);\n        }\n      } else {\n        parents.push(elem);\n      }\n    }\n\n    return parents;\n  };\n})();\n\n//# sourceURL=webpack://viezo/./src/js/template-tags/navigation-primary.js?");

/***/ }),

/***/ "./src/js/template-tags/off-canvas.js":
/*!********************************************!*\
  !*** ./src/js/template-tags/off-canvas.js ***!
  \********************************************/
/***/ (() => {

eval("/**\n * File: off-canvas.js\n *\n * Help deal with the off-canvas mobile menu.\n */\n// Make sure everything is loaded first.\nif (('complete' === document.readyState || 'loading' !== document.readyState) && !document.documentElement.doScroll) {\n  wdsOffCanvas();\n} else {\n  document.addEventListener('DOMContentLoaded', wdsOffCanvas);\n}\n/**\n * Kick off our off canvas functions.\n *\n * @author Corey Collins\n * @since January 31, 2020\n */\n\n\nfunction wdsOffCanvas() {\n  var offCanvasScreen = document.querySelector('.off-canvas-screen');\n\n  if (!offCanvasScreen) {\n    return;\n  }\n\n  var offCanvasContainer = document.querySelector('.off-canvas-container'),\n      offCanvasOpen = document.querySelector('.off-canvas-open'),\n      offCanvasClose = document.querySelector('.off-canvas-close');\n  offCanvasOpen.addEventListener('click', toggleOffCanvas);\n  offCanvasClose.addEventListener('click', toggleOffCanvas);\n  offCanvasScreen.addEventListener('click', closeOffCanvas);\n  document.body.addEventListener('keydown', closeOnEscape);\n  /**\n   * Close everything when we hit the escape key.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   * @param {Object} event The event trigger.\n   */\n\n  function closeOnEscape(event) {\n    if (27 === event.keyCode) {\n      closeOffCanvas();\n    }\n  }\n  /**\n   * Handle closing the off-canvas overlay.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   */\n\n\n  function closeOffCanvas() {\n    offCanvasContainer.classList.remove('is-visible');\n    offCanvasOpen.classList.remove('is-visible');\n    offCanvasClose.classList.remove('is-visible');\n    offCanvasScreen.classList.remove('is-visible');\n    offCanvasContainer.setAttribute('aria-hidden', true);\n    offCanvasOpen.setAttribute('aria-expanded', false);\n  }\n  /**\n   * Toggle the display of the off-canvas overlay.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   */\n\n\n  function toggleOffCanvas() {\n    if ('true' === offCanvasOpen.getAttribute('aria-expanded')) {\n      closeOffCanvas();\n    } else {\n      openOffCanvas();\n    }\n  }\n  /**\n   * Handle opening the off-canvas overlay.\n   *\n   * @author Corey Collins\n   * @since January 31, 2020\n   */\n\n\n  function openOffCanvas() {\n    offCanvasContainer.classList.add('is-visible');\n    offCanvasOpen.classList.add('is-visible');\n    offCanvasClose.classList.add('is-visible');\n    offCanvasScreen.classList.add('is-visible');\n    offCanvasContainer.setAttribute('aria-hidden', false);\n    offCanvasOpen.setAttribute('aria-expanded', true);\n    offCanvasClose.setAttribute('aria-expanded', true);\n  }\n}\n\n//# sourceURL=webpack://viezo/./src/js/template-tags/off-canvas.js?");

/***/ }),

/***/ "./src/js/template-tags/table.js":
/*!***************************************!*\
  !*** ./src/js/template-tags/table.js ***!
  \***************************************/
/***/ (() => {

eval("/**\n * File table.js\n *\n * Make tables responsive.\n *\n * @author Haris Zulfiqar, Corey Collins\n * @since January 31, 2020\n */\n(function () {\n  document.querySelectorAll('table').forEach(function (table) {\n    var tableHeaders = table.querySelectorAll('th'); // Bail if our table has no headers set.\n\n    if (0 === tableHeaders.length) {\n      return;\n    }\n\n    var tableRow = table.querySelectorAll('tbody tr');\n    tableRow.forEach(function (row) {\n      var tableCell = row.querySelectorAll('td');\n      tableCell.forEach(function (cell, index) {\n        if (tableHeaders[index].textContent) {\n          cell.setAttribute('data-label', tableHeaders[index].textContent);\n        }\n      });\n    });\n  });\n})();\n\n//# sourceURL=webpack://viezo/./src/js/template-tags/table.js?");

/***/ }),

/***/ "./src/js/template-tags/video.js":
/*!***************************************!*\
  !*** ./src/js/template-tags/video.js ***!
  \***************************************/
/***/ (() => {

eval("/**\n * File video.js\n *\n * Deal with video playback.\n */\n(function () {\n  var videoButtons = document.querySelectorAll('.video-toggle'); // Toggle playback on background videos.\n\n  videoButtons.forEach(function (videoButton) {\n    videoButton.addEventListener('click', toggleVideoPlayback);\n  });\n  /**\n   * Toggle video playback when the button is pressed.\n   *\n   * @author Jo Murgel, Corey Collins\n   * @since January 31, 2020\n   * @param {Object} event The triggered event.\n   */\n\n  function toggleVideoPlayback(event) {\n    var targetParent = event.target.parentNode,\n        targetElement = targetParent.querySelector('.video-background');\n    targetParent.classList.toggle('video-toggled');\n\n    if (targetParent.classList.contains('video-toggled')) {\n      targetElement.pause();\n    } else {\n      targetElement.play();\n    }\n  }\n})();\n\n//# sourceURL=webpack://viezo/./src/js/template-tags/video.js?");

/***/ }),

/***/ "./src/js/templates/index.js":
/*!***********************************!*\
  !*** ./src/js/templates/index.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _powerrail__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./powerrail */ \"./src/js/templates/powerrail.js\");\n/* harmony import */ var _powerrail__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_powerrail__WEBPACK_IMPORTED_MODULE_0__);\n/**\n * Template JS\n *\n * JS for WordPress template files.\n * See https://developer.wordpress.org/themes/basics/template-files/.\n */\n\n\n//# sourceURL=webpack://viezo/./src/js/templates/index.js?");

/***/ }),

/***/ "./src/js/templates/powerrail.js":
/*!***************************************!*\
  !*** ./src/js/templates/powerrail.js ***!
  \***************************************/
/***/ (() => {

eval("function calculatorPage() {\n  function numberAnimations() {\n    // How long you want the animation to take, in ms\n    var animationDuration = 2000; // Calculate how long each ‘frame’ should last if we want to update the animation 60 times per second\n\n    var frameDuration = 1000 / 60; // Use that to calculate how many frames we need to complete the animation\n\n    var totalFrames = Math.round(animationDuration / frameDuration); // An ease-out function that slows the count as it progresses\n\n    var easeOutQuad = function easeOutQuad(t) {\n      return t * (2 - t);\n    }; // The animation function, which takes an Element\n\n\n    var animateCountUp = function animateCountUp(el) {\n      var frame = 0;\n      var countTo = parseInt(el.dataset.number, 10);\n      el.style.visibility = \"visible\"; // Start the animation running 60 times per second\n\n      var counter = setInterval(function () {\n        frame++; // Calculate our progress as a value between 0 and 1\n        // Pass that value to our easing function to get our\n        // progress on a curve\n\n        var progress = easeOutQuad(frame / totalFrames); // Use the progress value to calculate the current count\n\n        var currentCount = Math.round(countTo * progress); // If the current count has changed, update the element\n\n        if (parseInt(el.dataset.value, 10) !== currentCount) {\n          el.innerHTML = currentCount.toLocaleString('lt-LT');\n          el.dataset.value = currentCount;\n        } // If we’ve reached our last frame, stop the animation\n\n\n        if (frame === totalFrames) {\n          clearInterval(counter);\n        }\n      }, frameDuration);\n    }; // Run the animation on all elements with a class of ‘countup’\n\n\n    var runAnimations = function runAnimations() {\n      var countupEls = document.querySelectorAll('.countup');\n      countupEls.forEach(animateCountUp);\n    };\n\n    runAnimations();\n  }\n\n  function setBubble(range, bubble) {\n    var val = range.value;\n    var min = range.min ? range.min : 0;\n    var max = range.max ? range.max : 100;\n    var newVal = Number((val - min) * 100 / (max - min));\n    var newPosition = 12 - newVal * 0.2;\n    bubble.innerHTML = val + '<span>K km</span>';\n    range.style.backgroundSize = newVal + '% 100%'; // Sorta magic numbers based on size of the native UI thumb\n\n    bubble.style.left = \"calc(\".concat(newVal, \"% + (\").concat(newPosition, \"px))\");\n  }\n\n  var range = document.querySelector(\"#average-mileage\");\n  var bubble = document.querySelector(\"#mileage-bubble\");\n  range.addEventListener(\"input\", function () {\n    setBubble(range, bubble);\n  });\n  setBubble(range, bubble);\n\n  function calculation() {\n    document.querySelector(\"#calculate-button\").addEventListener('click', function (e) {\n      e.preventDefault();\n      var form = document.querySelector(\".calculator form\");\n      form.querySelector('.loader').classList.add('is-active');\n      form.querySelector(\"#calculate-button\").disabled = true;\n      var isValid = form.querySelector(\"#fleet-size\").checkValidity();\n\n      if (!isValid) {\n        form.querySelector(\"#fleet-size\").reportValidity();\n        form.querySelector('.loader').classList.remove('is-active');\n        form.querySelector(\"#calculate-button\").disabled = false;\n        return;\n      }\n\n      var col1 = document.querySelector('.col-1');\n\n      if (col1) {\n        document.querySelector('.col-1').classList.remove('animated');\n        setTimeout(requestReplace, 400);\n      } else {\n        requestReplace();\n      }\n    });\n  }\n\n  function requestReplace() {\n    var form = document.querySelector(\".calculator form\");\n    var request = new XMLHttpRequest();\n    var reqUrl = form.action;\n    var formData = new FormData(form);\n    formData.append('getCalculations', 1);\n    formData[\"delete\"]('_wpcf7');\n    request.open('POST', reqUrl, true);\n    request.responseType = 'document';\n\n    request.onload = function () {\n      if (this.status >= 200 && this.status < 400) {\n        var resp = this.response;\n        var results = document.querySelector('.calc-results');\n        results.innerHTML = resp.querySelector('.calc-results').innerHTML; //scroll to results\n\n        setTimeout(toggleResults, 200);\n        setTimeout(numberAnimations, 1500);\n        setTimeout(toggleForm, 3500);\n        form.querySelector('.loader').classList.remove('is-active');\n      }\n    };\n\n    request.onerror = function () {// There was a connection error of some sort\n    };\n\n    request.send(formData);\n  }\n\n  function fleetSizeInput() {\n    document.querySelector(\"#fleet-size\").addEventListener('change', function (e) {\n      var inputs = document.querySelector(\"#axles-inputs\");\n\n      if (!inputs.classList.contains('to-open')) {\n        inputs.classList.add('to-open');\n        setTimeout(function () {\n          document.querySelector(\"#axles-inputs\").classList.remove('overflow-hidden');\n        }, 1300);\n      }\n    });\n  }\n\n  fleetSizeInput();\n  calculation();\n}\n\nfunction toggleResults() {\n  var col1 = document.querySelector('.col-1');\n  col1.classList.toggle('animated');\n  setTimeout(function () {\n    var results = document.querySelector('.col-1');\n    window.scrollBy({\n      top: results.getBoundingClientRect().top + results.clientHeight,\n      left: 0,\n      behavior: 'smooth'\n    });\n  }, 150);\n}\n\nfunction toggleForm() {\n  document.querySelector('.col-2').classList.toggle('animated-2');\n  document.querySelector('.col-1').classList.toggle('animated-2');\n  document.querySelector('.col-1 .heading').classList.toggle('to-left');\n  document.querySelector(\"#calculate-button\").disabled = false; //document.querySelector(\"#fleet-size\").disabled = true;\n}\n\nif (document.body.classList.contains('page-template-powerail')) {\n  calculatorPage();\n}\n\n//# sourceURL=webpack://viezo/./src/js/templates/powerrail.js?");

/***/ }),

/***/ "./src/scss/index.scss":
/*!*****************************!*\
  !*** ./src/scss/index.scss ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://viezo/./src/scss/index.scss?");

/***/ }),

/***/ "./src/scss/tailwind.scss":
/*!********************************!*\
  !*** ./src/scss/tailwind.scss ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://viezo/./src/scss/tailwind.scss?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/index.js");
/******/ 	
/******/ })()
;