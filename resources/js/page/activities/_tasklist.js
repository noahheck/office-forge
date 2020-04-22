/**
 * js/page/activities/_tasklist.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let meta   = require('Services/meta');
let notify = require('Services/notify');

let activity = require('App/activity');

$(function() {

    let activityId = meta.get('activityId');

    let $newTaskButton = $('#newTaskContainerToggleButton');
    let $newTaskContainerCollapse = $('#newTaskContainer');
    let $newTaskShowButtonContainer = $('#newTaskShowButtonContainer');
    let $newTaskTitleField = $('#title');

    $newTaskContainerCollapse.on('shown.bs.collapse', function () {
        $newTaskTitleField.focus();
    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27) {
            $newTaskContainerCollapse.collapse('hide');
            $newTaskShowButtonContainer.collapse('show');
        }
    });

    $('#taskFormCancelButton').click(function(event) {
        event.preventDefault();

        $newTaskButton.click();
    });

    let sortable = Sortable.create(document.getElementById('activityOpenTasks'), {
        handle: '.sort-handle',
        animation: 150,
        direction: 'vertical',
        onEnd: function(evt) {
            activity.updateTasksOrder(activityId, sortable.toArray()).then(response => {
                notify.success(response.data.successMessage);
            });
        }
    });

});
