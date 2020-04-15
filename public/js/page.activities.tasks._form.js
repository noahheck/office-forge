(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.activities.tasks._form"],{

/***/ "./resources/js/page/activities/tasks/_form.js":
/*!*****************************************************!*\
  !*** ./resources/js/page/activities/tasks/_form.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/activities/tasks/_form.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

var meta = __webpack_require__(/*! Services/meta */ "./resources/js/services/meta.js");

$(function () {
  var userId = meta.get('userId');
  var jAssignedToSelect = $('#assigned_to');
  var jAssignToMeButton = $('#assignToMeButton');
  jAssignToMeButton.click(function () {
    jAssignedToSelect.selectpicker('val', userId);
  });
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

/***/ 13:
/*!***********************************************************!*\
  !*** multi ./resources/js/page/activities/tasks/_form.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/activities/tasks/_form.js */"./resources/js/page/activities/tasks/_form.js");


/***/ })

},[[13,"/js/manifest","/js/vendor"]]]);