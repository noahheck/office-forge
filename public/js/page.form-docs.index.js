(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.form-docs.index"],{

/***/ "./resources/js/page/form-docs/index.js":
/*!**********************************************!*\
  !*** ./resources/js/page/form-docs/index.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/form-docs/index.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  var $filtersContainer = $("#formDocsFiltersContainer");
  var $filtersDisplayButton = $("#formDocsFiltersDisplayButton");
  $filtersDisplayButton.click(function () {
    $filtersContainer.toggleClass('shown');
    $filtersDisplayButton.toggleClass('shown');
  });
  var $listContainer = $("#formDocsListColumn");
  var $listButton = $("#formDocsListDisplayButton");
  $listButton.click(function () {
    $listContainer.toggleClass('shown');
    $listButton.toggleClass('shown');
  });
});

/***/ }),

/***/ 2:
/*!****************************************************!*\
  !*** multi ./resources/js/page/form-docs/index.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/form-docs/index.js */"./resources/js/page/form-docs/index.js");


/***/ })

},[[2,"/js/manifest","/js/vendor"]]]);