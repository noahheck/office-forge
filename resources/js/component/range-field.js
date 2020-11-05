/**
 * js/component/phone-field.js
 */

let $ = require('jquery');

function setRangeDisplayValueForElement(element) {
    let id = element.getAttribute("id");

    document.getElementById(id + "_display").innerHTML = element.value;
}

$(function() {

    let elements = document.getElementsByClassName("range-field");

    for (let e of elements) {

        setRangeDisplayValueForElement(e);

        $(e).on("input", function() {
            setRangeDisplayValueForElement(this);
        })
    }
});
