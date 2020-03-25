/**
 * js/page/admin/file-types/forms/show.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let meta   = require('Services/meta');
let notify = require('Services/notify');
let encoder = require('Services/html-encode');

let form = require('App/file-type/form');

function loadFieldOptions(formId) {
    let formFields = meta.get('form_' + formId, []);

    let options = "<option value=''>--</option>";
    formFields.forEach(function(field) {
        options += "<option value='" + field.id + "'>" + encoder.encode(field.label) + "</option>";
    });

    $('#field_id').html(options);
}

$(function() {

    let fileTypeId = meta.get('fileTypeId');
    let panelId    = meta.get('panelId');

    let formSelect = $('#form_id');

    formSelect.change(function() {
        loadFieldOptions(formSelect.val());
    });

    loadFieldOptions(formSelect.val());

    let $form = $('#addFieldForm');

    $form.submit(function(event) {

        let fieldSelect = $('#field_id');

        let fieldId = fieldSelect.val();

        if (!fieldId) {
            fieldSelect.attr('required', true);
            event.preventDefault();

            return false;
        }
    });

    /*let sortable = Sortable.create(document.getElementById('formFields_active'), {
        handle: '.sort-handle',
        animation: 150,
        direction: 'vertical',
        onEnd: function(evt) {
            form.updateFieldsOrder(fileTypeId, formId, sortable.toArray()).then(response => {
                notify.success(response.data.successMessage);
            });
        }
    });*/
});
