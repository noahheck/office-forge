/**
 * js/component/money-field.js
 */

let $ = require('jquery');

let charCodes = require('Services/character-codes');




function isCodeAllowed(code) {

    if (charCodes.isControlCode(code)) {
        return true;
    }

    if ((code >= 35 && code <= 57) || (code >= 96 && code <= 105)) {
        return true;
    }

    return false;
}



$(function() {

    $('.integer-field').keydown(function(e) {
        let curVal = $(this).val();

        let charCode = (e.which) ? e.which : e.keyCode;

        // Allow cut/copy/paste (and probably bugs...)
        if (e.ctrlKey) {
            return true;
        }

        if (charCodes.isControlCode(charCode)) {
            return true;
        }

        if (!isCodeAllowed(charCode)) {
            return false;
        }
    });

});
