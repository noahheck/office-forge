(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.admin.file-types.forms.fields._form"],{

/***/ "./resources/js/page/admin/file-types/forms/fields/_form.js":
/*!******************************************************************!*\
  !*** ./resources/js/page/admin/file-types/forms/fields/_form.js ***!
  \******************************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var sortablejs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! sortablejs */ "./node_modules/sortablejs/modular/sortable.complete.esm.js");
/**
 * js/page/admin/file-types/forms/fields/_form.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");


var fieldOptionContainers;

function showFieldTypeOptions(fieldType) {
  fieldOptionContainers.hide();
  $('#form-field-options_' + fieldType).show();
}

function addSelectOption() {
  var $newOptionTextBox = $('#newSelectOption');
  var newOption = $newOptionTextBox.val();

  if (!newOption) {
    return;
  }

  var li = $('#newSelectOptionTemplate').clone(true, true);
  li.attr('id', '');
  li.find('.select-option-text').text(newOption);
  li.find('input').val(newOption);
  $('#selectOptionsList').append(li);
  $newOptionTextBox.val('').focus();
}

$(function () {
  fieldOptionContainers = $('.form-field-option');
  var $fieldTypeSelect = $('#field_type');
  showFieldTypeOptions($fieldTypeSelect.val());
  $fieldTypeSelect.change(function () {
    showFieldTypeOptions($(this).val());
  });
  $('#addNewSelectOption').click(addSelectOption);
  $('#newSelectOption').keypress(function (e) {
    if (e.keyCode === 13) {
      e.preventDefault();
      addSelectOption();
    }
  });
  sortablejs__WEBPACK_IMPORTED_MODULE_0__["default"].create(document.getElementById('selectOptionsList'), {
    handle: '.sort-handle',
    animation: 150,
    direction: 'vertical'
  });
  $('.select-option-item .delete-button').click(function () {
    $(this).parent().remove();
  });
});

/***/ }),

/***/ 20:
/*!************************************************************************!*\
  !*** multi ./resources/js/page/admin/file-types/forms/fields/_form.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/admin/file-types/forms/fields/_form.js */"./resources/js/page/admin/file-types/forms/fields/_form.js");


/***/ })

},[[20,"/js/manifest","/js/vendor"]]]);