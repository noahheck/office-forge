/**
 * js/page/admin/processes/tasks/actions/index.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let meta   = require('Services/meta');
let notify = require('Services/notify');

let process = require('App/process');
let task = require('App/process/task');

$(function() {

    let processId = meta.get('processId');
    let taskId    = meta.get('taskId');

    let sortable = Sortable.create(document.getElementById('taskActions'), {
        handle: '.sort-handle',
        animation: 150,
        direction: 'vertical',
        onEnd: function(evt) {
            task.updateActionsOrder(processId, taskId, sortable.toArray()).then(response => {
                notify.success(response.data.successMessage);
            });
        }
    });
});

