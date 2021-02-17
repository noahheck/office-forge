(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.admin.reports.datasets.visualizations._form"],{

/***/ "./resources/js/page/admin/reports/datasets/visualizations/_form.js":
/*!**************************************************************************!*\
  !*** ./resources/js/page/admin/reports/datasets/visualizations/_form.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/admin/reports/datasets/filters/_form.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

var meta = __webpack_require__(/*! Services/meta */ "./resources/js/services/meta.js");

var visualizationTypeOptionsContainerMap = {
  'total_records_count': 'total_recordsOptions',
  'field_value_sum': 'sum_averageOptions',
  'field_value_average': 'sum_averageOptions',
  'single_field_aggregate': 'aggregateOptions'
};
$(function () {
  var $visualizationTypeField = $('#visualization_type');
  var $visualizationTypeOptionDivs = $(".visualization-type-options");

  function showVisualizationTypeOptionsBasedOnSelectedVisualizationType() {
    var visualizationType = $visualizationTypeField.val();
    $visualizationTypeOptionDivs.addClass('d-none');
    var visualizationTypeOptionDivToShow = visualizationTypeOptionsContainerMap[visualizationType];
    $('#' + visualizationTypeOptionDivToShow).removeClass('d-none');
  }

  $visualizationTypeField.change(showVisualizationTypeOptionsBasedOnSelectedVisualizationType);
  showVisualizationTypeOptionsBasedOnSelectedVisualizationType();
});

/***/ }),

/***/ "./resources/js/services/meta.js":
/*!***************************************!*\
  !*** ./resources/js/services/meta.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/services/meta.js
 *
 * Loads content from html meta tags with the data-piglet attribute (i.e. those created with the Blade directive)
 * - loads all tags into memory on page load and wraps in the closure to prevent modification
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

var metaData = {};
var meta = {};

meta.get = function (name, fallback) {
  return metaData[name] ? metaData[name] : fallback;
};

$(function () {
  $("meta").each(function () {
    var $this = $(this);
    var name = $this.attr('name');
    var content = $this.attr('content');

    if ($this.data('json')) {
      content = JSON.parse(content);
    }

    metaData[name] = content;
  });
});
window.meta = meta;
module.exports = meta;

/***/ }),

/***/ 28:
/*!********************************************************************************!*\
  !*** multi ./resources/js/page/admin/reports/datasets/visualizations/_form.js ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/admin/reports/datasets/visualizations/_form.js */"./resources/js/page/admin/reports/datasets/visualizations/_form.js");


/***/ })

},[[28,"/js/manifest","/js/vendor"]]]);