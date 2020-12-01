(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.reports"],{

/***/ "./resources/js/page/reports/reports.js":
/*!**********************************************!*\
  !*** ./resources/js/page/reports/reports.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/reports/reports.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  var $reportSelectField = $("#report_id");
  var $userSelectContainer = $("#userSelect");
  var $userSelectField = $("#user_id");
  var $dateSelect1Container = $("#dateSelect1");
  var $dateSelect1Field = $("#date");
  var $dateSelect2Container = $("#dateSelect2");
  var $dateSelect2Field1 = $("#date_from");
  var $dateSelect2Field2 = $("#date_to");

  function hideUserField() {
    $userSelectContainer.addClass("d-none");
    $userSelectField.attr('disabled', true);
  }

  function showUserField() {
    $userSelectContainer.removeClass("d-none");
    $userSelectField.removeAttr('disabled');
  }

  function hideDate1Field() {
    $dateSelect1Container.addClass("d-none");
    $dateSelect1Field.attr('disabled', true);
  }

  function showDate1Field() {
    $dateSelect1Container.removeClass("d-none");
    $dateSelect1Field.removeAttr('disabled');
  }

  function hideDate2Fields() {
    $dateSelect2Container.addClass("d-none");
    $dateSelect2Field1.attr('disabled', true);
    $dateSelect2Field2.attr('disabled', true);
  }

  function showDate2Fields() {
    $dateSelect2Container.removeClass("d-none");
    $dateSelect2Field1.removeAttr('disabled');
    $dateSelect2Field2.removeAttr('disabled');
  }

  function showFormFieldsForReport() {
    var reportSelected = $reportSelectField.val();

    if (!reportSelected) {
      hideUserField();
      hideDate1Field();
      hideDate2Fields();
      return;
    }

    var selectedOption = $reportSelectField.find("option:selected");
    var userSelect = selectedOption.data("filterUser");

    if (userSelect) {
      showUserField();
    } else {
      hideUserField();
    }

    var dateSelect = selectedOption.data('filterDate');

    if (dateSelect === 0) {
      hideDate1Field();
      hideDate2Fields();
    } else if (dateSelect === 1) {
      showDate1Field();
      hideDate2Fields();
    } else if (dateSelect === 2) {
      hideDate1Field();
      showDate2Fields();
    }
  }

  showFormFieldsForReport();
  $reportSelectField.change(showFormFieldsForReport);
});

/***/ }),

/***/ 12:
/*!****************************************************!*\
  !*** multi ./resources/js/page/reports/reports.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/reports/reports.js */"./resources/js/page/reports/reports.js");


/***/ })

},[[12,"/js/manifest","/js/vendor"]]]);