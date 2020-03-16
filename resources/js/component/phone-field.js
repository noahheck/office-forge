/**
 * js/component/phone-field.js
 */

let $ = require('jquery');


$(function() {

    $(".phone-field").keyup(function() {

        // Get current cursor position to put it back in the right place when the formatting is done

        let $this = $(this);
        let val = $this.val();

        let onlyNumbers = val.replace(/[^0-9]/gi, '');

        let areaCode = onlyNumbers;
        let firstSet = '';
        let lastSet = '';
        let ext = '';

        let numChars = onlyNumbers.length;

        if (numChars > 3) {
            areaCode = '(' + onlyNumbers.substr(0, 3) + ') ';
        }

        if (numChars >=4) {
            firstSet = onlyNumbers.substr(3, 3);
        }

        if (numChars >= 7) {
            lastSet = '-' + onlyNumbers.substr(6, 4);
        }

        if (numChars >= 11) {
            ext = ' x' + onlyNumbers.substr(10);
        }

        let newVal = areaCode + firstSet + lastSet + ext;

        $this.val(newVal);
    });
});
