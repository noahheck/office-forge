/**
 * js/page/admin/file-types/forms/show.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let meta   = require('Services/meta');
let notify = require('Services/notify');

let form = require('App/file-type/form');

$(function() {

    let fileTypeId = meta.get('fileTypeId');
    let formId    = meta.get('formId');

    let sortable = Sortable.create(document.getElementById('formFields_active'), {
        handle: '.sort-handle',
        animation: 150,
        direction: 'vertical',
        onEnd: function(evt) {
            form.updateFieldsOrder(fileTypeId, formId, sortable.toArray()).then(response => {
                notify.success(response.data.successMessage);
            });
        }
    });
});
