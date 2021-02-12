(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.admin.reports.datasets._form"],{

/***/ "./resources/js/page/admin/reports/datasets/_form.js":
/*!***********************************************************!*\
  !*** ./resources/js/page/admin/reports/datasets/_form.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/admin/reports/datasets/_form.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  var $datasetableType = $('#datasetable_type');

  function showOptionsForDatasetableType() {
    var selectedValue = $datasetableType.val().replace(/\\/gi, '_');
    $(".datasetable_type_option_container").addClass('d-none');
    $("#" + selectedValue + "_datasetable_type_option_container").removeClass('d-none');
  }

  $datasetableType.change(showOptionsForDatasetableType);
  showOptionsForDatasetableType();
});

/***/ }),

/***/ 25:
/*!*****************************************************************!*\
  !*** multi ./resources/js/page/admin/reports/datasets/_form.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/admin/reports/datasets/_form.js */"./resources/js/page/admin/reports/datasets/_form.js");


/***/ })

},[[25,"/js/manifest","/js/vendor"]]]);