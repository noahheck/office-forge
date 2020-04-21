(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.activities.show"],{

/***/ "./resources/js/page/activities/show.js":
/*!**********************************************!*\
  !*** ./resources/js/page/activities/show.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/activities/show.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  var $newTaskButton = $('#newTaskContainerToggleButton');
  $('#taskFormCancelButton').click(function (event) {
    event.preventDefault();
    $newTaskButton.click();
  });
});

/***/ }),

/***/ 2:
/*!****************************************************!*\
  !*** multi ./resources/js/page/activities/show.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/activities/show.js */"./resources/js/page/activities/show.js");


/***/ })

},[[2,"/js/manifest","/js/vendor"]]]);