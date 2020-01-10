(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.settings.photo"],{

/***/ "./resources/js/page/settings/photo.js":
/*!*********************************************!*\
  !*** ./resources/js/page/settings/photo.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/settings/photo.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  var $input = $('#new_profile_photo');
  var image = $('.upload-preview');
  $input.change(function () {
    var reader = new FileReader();

    reader.onload = function (e) {
      image.attr('src', e.target.result).addClass('in-preview');
    };

    reader.readAsDataURL(this.files[0]);
  });
});

/***/ }),

/***/ 1:
/*!***************************************************!*\
  !*** multi ./resources/js/page/settings/photo.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/settings/photo.js */"./resources/js/page/settings/photo.js");


/***/ })

},[[1,"/js/manifest","/js/vendor"]]]);