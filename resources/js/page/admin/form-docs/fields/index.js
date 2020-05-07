/**
 * js/page/admin/form-docs/fields/index.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let meta   = require('Services/meta');
let notify = require('Services/notify');

let formDoc = require('App/form-doc');

$(function() {

    let formDocId = meta.get('formDocId');

    let sortable = Sortable.create(document.getElementById('formFields_active'), {
        handle: '.sort-handle',
        animation: 150,
        direction: 'vertical',
        onEnd: function(evt) {
            formDoc.updateFieldsOrder(formDocId, sortable.toArray()).then(response => {
                notify.success(response.data.successMessage);
            });
        }
    });
});
