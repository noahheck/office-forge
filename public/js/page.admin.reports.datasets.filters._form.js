(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.admin.reports.datasets.filters._form"],{

/***/ "./resources/js/page/admin/reports/datasets/filters/_form.js":
/*!*******************************************************************!*\
  !*** ./resources/js/page/admin/reports/datasets/filters/_form.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/admin/reports/datasets/filters/_form.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

var meta = __webpack_require__(/*! Services/meta */ "./resources/js/services/meta.js");

var fieldTypeOperators = {
  'checkbox': ['checked', 'unchecked'],
  'date': ['equals', 'greater_than', 'greater_than_equals', 'less_than', 'less_than_equals', 'between', 'has_value', 'does_not_have_value'],
  'user': ['equals'],
  // 'file': ['equals', 'not_equals'],
  'range': ['equals', 'not_equals', 'greater_than_equals', 'less_than', 'less_than_equals', 'between', 'has_value', 'does_not_have_value'],
  'integer': ['equals', 'not_equals', 'greater_than_equals', 'less_than', 'less_than_equals', 'between', 'has_value', 'does_not_have_value'],
  'decimal': ['equals', 'not_equals', 'greater_than_equals', 'less_than', 'less_than_equals', 'between', 'has_value', 'does_not_have_value'],
  'money': ['equals', 'not_equals', 'greater_than_equals', 'less_than', 'less_than_equals', 'between', 'has_value', 'does_not_have_value'],
  'select': ['equals', 'not_equals']
};
var fieldOptionsContainerIds = {
  'checkbox': 'checkboxOptions',
  'date': 'dateOptions',
  'user': 'userOptions',
  'file': 'fileOptions',
  'range': 'numericOptions',
  'integer': 'numericOptions',
  'decimal': 'numericOptions',
  'money': 'numericOptions',
  'select': 'selectOptions'
};
var fieldTypeConfigurationOptions = {
  'checkbox': 'checkbox',
  'date': 'date',
  'user': 'user',
  'file': 'file',
  'range': 'numeric',
  'integer': 'numeric',
  'decimal': 'numeric',
  'money': 'numeric',
  'select': 'select'
};
var REPORT_FILTER_USER = '1';
var REPORT_FILTER_DATE_NONE = '0';
var REPORT_FILTER_DATE_DATE = '1';
var REPORT_FILTER_DATE_RANGE = '2';
var FILTER_OPERATOR_BETWEEN = 'between';
var FILTER_OPERATOR_HAS_VALUE = 'has_value';
var FILTER_OPERATOR_DOES_NOT_HAVE_VALUE = 'does_not_have_value';
var FILTER_VALUE_USER_REPORT_FILTERED_USER = 'report_filtered_user';
var FILTER_VALUE_USER_GENERATING_REPORT = 'user_generating_report';
var FILTER_VALUE_USER_SPECIFIC_USER = 'specific_user';
var FILTER_VALUE_DATE_SPECIFIC_DATE = 'specific_date';
var FILTER_VALUE_DATE_REPORT_FILTERED_DATE = 'report_filtered_date';
var FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE = 'report_filtered_date_range';

var isBooleanOperator = function isBooleanOperator(operator) {
  return [FILTER_OPERATOR_HAS_VALUE, FILTER_OPERATOR_DOES_NOT_HAVE_VALUE].indexOf(operator) !== -1;
};

var fieldTypeConfigurations = {
  checkbox: function checkbox(options) {},
  select: function select(options) {
    var initialValue = meta.get("filter_value-1");
    var selectOptionsSelect = $("#select_value");
    var optionsString = "";
    options.select_options.forEach(function (option) {
      var selected = initialValue === option ? "selected" : "";
      optionsString += "<option " + selected + ">" + option + "</option>";
    });
    selectOptionsSelect.html(optionsString);
  },
  user: function user(options) {},
  date: function date(options) {},
  numeric: function numeric(options) {}
};
$(function () {
  var fieldSelect = $('#field_id');
  var fieldTypeOptionDivs = $(".field-type-options");

  function showFieldTypeOptions(fieldType) {
    fieldTypeOptionDivs.addClass("d-none");
    var fieldOptionId = fieldOptionsContainerIds[fieldType];

    if (fieldOptionId) {
      fieldTypeOptionDivs.filter("#" + fieldOptionId).removeClass("d-none");
    }
  }

  function showAndPopulateFieldOptionsForFieldType(fieldType, options) {
    showFieldTypeOptions(fieldType);
    var configCallback = fieldTypeConfigurationOptions[fieldType];

    if (configCallback) {
      fieldTypeConfigurations[configCallback](options);
    }
  }

  function showDetailsForSelectedFilterField() {
    var selectedOption = fieldSelect.find("option:selected");
    var fieldType = selectedOption.data('type');
    var fieldOptions = selectedOption.data('options');
    showAndPopulateFieldOptionsForFieldType(fieldType, fieldOptions);
  }

  fieldSelect.change(showDetailsForSelectedFilterField);
  showDetailsForSelectedFilterField(); // Set up Select field type callbacks and behaviors

  var $selectOperator = $("#select_operator");
  var $selectValueContainer = $("#selectValueContainer");

  function toggleSelectValueContainerDisplay() {
    var value = $selectOperator.val();

    if (!value || isBooleanOperator(value)) {
      $selectValueContainer.addClass('d-none');
    } else {
      $selectValueContainer.removeClass('d-none');
    }
  }

  $selectOperator.change(toggleSelectValueContainerDisplay);
  toggleSelectValueContainerDisplay(); // Set up User field type callbacks and behaviors

  var $userOperator = $("#user_operator");
  var $userValue1 = $("#user_value_1");
  var $userValuesContainer = $("#userValuesContainer");
  var $userValue2Container = $("#userValue2Container");

  function toggleUserValueContainerDisplay() {
    var operator = $userOperator.val();
    var value = $userValue1.val();

    if (!operator || isBooleanOperator(operator)) {
      $userValuesContainer.addClass("d-none");
    } else {
      $userValuesContainer.removeClass("d-none");
    }

    if (FILTER_VALUE_USER_SPECIFIC_USER === value) {
      $userValue2Container.removeClass("d-none");
    } else {
      $userValue2Container.addClass("d-none");
    }
  }

  $userOperator.change(toggleUserValueContainerDisplay);
  $userValue1.change(toggleUserValueContainerDisplay);
  toggleUserValueContainerDisplay(); // Set up Date field type callbacks and behaviors

  var $dateOperator = $("#date_operator");
  var $dateValue1 = $("#date_value_1");
  var $dateValuesContainer = $("#dateValuesContainer");
  var $datepickerValuesContainer = $("#datepickerValuesContainer");
  var $datepickerValue2Container = $("#datepickerValue2Container");

  function toggleDateValueContainerDisplay() {
    var operator = $dateOperator.val();
    var value1 = $dateValue1.val();

    if (!operator || isBooleanOperator(operator)) {
      $dateValuesContainer.addClass("d-none");
    } else {
      $dateValuesContainer.removeClass("d-none");
    }

    if (!value1 || FILTER_VALUE_DATE_SPECIFIC_DATE !== value1) {
      $datepickerValuesContainer.addClass("d-none");
    } else {
      $datepickerValuesContainer.removeClass("d-none");
    }

    if (operator === FILTER_OPERATOR_BETWEEN) {
      $datepickerValue2Container.removeClass("d-none");
    } else {
      $datepickerValue2Container.addClass("d-none");
    }
  }

  $dateOperator.change(toggleDateValueContainerDisplay);
  $dateValue1.change(toggleDateValueContainerDisplay);
  toggleDateValueContainerDisplay(); // Set up Numeric field type callbacks and behaviors

  var $numericOperator = $("#numeric_operator");
  var $numericValuesContainer = $("#numericValuesContainer");
  var $numericValue2Container = $("#numericValue2Container");

  function toggleNumericValueContainerDisplay() {
    var operator = $numericOperator.val();

    if (!operator || isBooleanOperator(operator)) {
      $numericValuesContainer.addClass("d-none");
    } else {
      $numericValuesContainer.removeClass("d-none");
    }

    if (operator === FILTER_OPERATOR_BETWEEN) {
      $numericValue2Container.removeClass("d-none");
    } else {
      $numericValue2Container.addClass("d-none");
    }
  }

  $numericOperator.change(toggleNumericValueContainerDisplay);
  toggleNumericValueContainerDisplay();
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

/***/ 27:
/*!*************************************************************************!*\
  !*** multi ./resources/js/page/admin/reports/datasets/filters/_form.js ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/admin/reports/datasets/filters/_form.js */"./resources/js/page/admin/reports/datasets/filters/_form.js");


/***/ })

},[[27,"/js/manifest","/js/vendor"]]]);