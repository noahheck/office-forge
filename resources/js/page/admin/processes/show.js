/**
 * page/admin/processes/show.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let meta   = require('Services/meta');
let notify = require('Services/notify');

let process = require('App/process');

$(function() {

    let processId = meta.get('processId');

    let sortable = Sortable.create(document.getElementById('processTasks'), {
        handle: '.sort-handle',
        animation: 150,
        direction: 'vertical',
        onEnd: function(evt) {
            process.updateTasksOrder(processId, sortable.toArray()).then(response => {
                notify.success(response.data.successMessage);
            });
        }
    });
});
