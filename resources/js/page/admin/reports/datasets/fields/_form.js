/**
 * js/page/admin/reports/datasets/fields/_form.js
 */

let $ = require('jquery');

$(function() {

    let fieldSelect = $('#field_id');
    let fieldLabel = $('#label');

    fieldSelect.change(function() {

        let optText = $(this).find("option:selected").text();

        fieldLabel.val(optText);

    });

});
