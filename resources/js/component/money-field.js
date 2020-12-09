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

    if ((code >= 35 && code <= 57) || (code >= 96 && code <= 105) || ([109,173].indexOf(code) !== -1)) {
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

        let curCursorPosition = e.target.selectionStart;

        // Allow negative sign to be added at the beginning of the sequence
        if ([109,173].indexOf(charCode) !== -1) {

            if(curVal.match(/-/)) {

                return false;
            }

            return curCursorPosition === 0;
        }

        // Limit the content to 2 decimal places
        if (hasDecimal) {

            // Account for 0-based indexing
            let decimalPosition = curVal.indexOf('.') + 1;

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
    }).change(function(e) {

        // The browser doesn't let us distinguish between - and _ keycodes, so if a _ was added, we'll change it to a
        // - after the change event
        let $this = $(this);
        let curVal = $this.val();

        $this.val(curVal.replace("_", "-"));
    });

});
