(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.user-activity"],{

/***/ "./resources/js/page/user-activity.js":
/*!********************************************!*\
  !*** ./resources/js/page/user-activity.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * page/user-activity.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  var $workStatusField = $('#work_status');
  var $completedWorkTimeFrameContainer = $('#completedWorkTimeFrameContainer');
  $workStatusField.change(function () {
    var collapseMethod = $workStatusField.val() === 'completed' ? 'show' : 'hide';
    $completedWorkTimeFrameContainer.collapse(collapseMethod);
  });
});

/***/ }),

/***/ 2:
/*!**************************************************!*\
  !*** multi ./resources/js/page/user-activity.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/user-activity.js */"./resources/js/page/user-activity.js");


/***/ })

},[[2,"/js/manifest","/js/vendor"]]]);