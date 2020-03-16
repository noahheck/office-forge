/**
 * js/component/money-field.js
 */

let $ = require('jquery');

let charCodes = require('Services/character-codes');


function isCodeAllowed(code, hasDecimal) {

    if (charCodes.isControlCode(code)) {
        return true;
    }

    if (!hasDecimal && [110, 190].indexOf(code) !== -1) {
        // Decimal point hasn't been added to the field yet
        return true;
    }

    if ((code >= 35 && code <= 57) || (code >= 96 && code <= 105)) {
        return true;
    }

    return false;
}



$(function() {

    $('.money-field').keydown(function(e) {
        let curVal = $(this).val();
        let hasDecimal = curVal.match(/\./);

        let charCode = (e.which) ? e.which : e.keyCode;

        // Allow cut/copy/paste (and probably bugs...)
        if (e.ctrlKey) {
            return true;
        }

        if (charCodes.isControlCode(charCode)) {
            return true;
        }

        if (!isCodeAllowed(charCode, hasDecimal)) {
            return false;
        }

        // Limit the content to 2 decimal places
        if (hasDecimal) {

            // Account for 0-based indexing
            let decimalPosition = curVal.indexOf('.') + 1;

            let curCursorPosition = e.target.selectionStart;

            // Cursor is on the left side of the decimal
            if (curCursorPosition < decimalPosition) {
                return true;
            }

            let numCharsAfterDecimal = curVal.length - decimalPosition;

            // Already 2 characters after decimal
            if (numCharsAfterDecimal >= 2) {
                return false;
            }
        }
    });

});
