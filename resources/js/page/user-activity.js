/**
 * page/user-activity.js
 */

let $ = require('jquery');

$(function() {

    let $workStatusField = $('#work_status');
    let $completedWorkTimeFrameContainer = $('#completedWorkTimeFrameContainer');

    $workStatusField.change(function() {

        let collapseMethod = ($workStatusField.val() === 'completed') ? 'show' : 'hide';

        $completedWorkTimeFrameContainer.collapse(collapseMethod);

    });

});
