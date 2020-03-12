/**
 * js/page/admin/file-types/forms/index.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let meta   = require('Services/meta');
let notify = require('Services/notify');

let fileType = require('App/file-type');

$(function() {

    let fileTypeId = meta.get('fileTypeId');

    let sortable = Sortable.create(document.getElementById('fileTypeForms'), {
        handle: '.sort-handle',
        animation: 150,
        direction: 'vertical',
        onEnd: function(evt) {
            fileType.updateFormsOrder(fileTypeId, sortable.toArray()).then(response => {

                notify.success(response.data.successMessage);
            });
        }
    });

});
