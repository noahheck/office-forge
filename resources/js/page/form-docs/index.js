/**
 * js/page/form-docs/index.js
 */

let $ = require('jquery');

$(function() {

    let $filtersContainer = $("#formDocsFiltersContainer");
    let $filtersDisplayButton = $("#formDocsFiltersDisplayButton");

    $filtersDisplayButton.click(function() {
        $filtersContainer.toggleClass('shown');
        $filtersDisplayButton.toggleClass('shown');
    });

});
