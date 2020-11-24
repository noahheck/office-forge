(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.admin.reports.datasets.fields._form"],{

/***/ "./resources/js/page/admin/reports/datasets/fields/_form.js":
/*!******************************************************************!*\
  !*** ./resources/js/page/admin/reports/datasets/fields/_form.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/admin/reports/datasets/fields/_form.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  var fieldSelect = $('#field_id');
  var fieldLabel = $('#label');
  fieldSelect.change(function () {
    var optText = $(this).find("option:selected").text();
    fieldLabel.val(optText);
  });
});

/***/ }),

/***/ 24:
/*!************************************************************************!*\
  !*** multi ./resources/js/page/admin/reports/datasets/fields/_form.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/admin/reports/datasets/fields/_form.js */"./resources/js/page/admin/reports/datasets/fields/_form.js");


/***/ })

},[[24,"/js/manifest","/js/vendor"]]]);