(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.drives.files._form"],{

/***/ "./resources/js/page/drives/files/_form.js":
/*!*************************************************!*\
  !*** ./resources/js/page/drives/files/_form.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/page/drives/files/_form.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  var extensionLabel = $('#inputGroupAppendedText_name');
  var nameField = $('#name');
  $('#file').change(function () {
    var file = this.files[0];
    var filenameDetails = parseFilenameParts(file.name);
    nameField.val(filenameDetails.name);
    extensionLabel.text(filenameDetails.extension ? '.' + filenameDetails.extension : '');
  });
});

function parseFilenameParts(fileName) {
  var filenameParts = fileName.toString().split('.');
  var extension = filenameParts.pop();
  var name = filenameParts.join('.');

  if (!name) {
    name = extension;
    extension = '';
  }

  return {
    name: name,
    extension: extension.toLowerCase()
  };
}

/***/ }),

/***/ 1:
/*!*******************************************************!*\
  !*** multi ./resources/js/page/drives/files/_form.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/drives/files/_form.js */"./resources/js/page/drives/files/_form.js");


/***/ })

},[[1,"/js/manifest","/js/vendor"]]]);