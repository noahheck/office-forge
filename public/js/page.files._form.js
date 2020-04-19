(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.files._form"],{

/***/ "./resources/js/page/files/_form.js":
/*!******************************************!*\
  !*** ./resources/js/page/files/_form.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/files/_form.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js"); // Same process as in js/page/settings/photo.js


$(function () {
  var $input = $('#new_file_photo');
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

/***/ 4:
/*!************************************************!*\
  !*** multi ./resources/js/page/files/_form.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/files/_form.js */"./resources/js/page/files/_form.js");


/***/ })

},[[4,"/js/manifest","/js/vendor"]]]);