/**
 * js/page/activities/show.js
 */

let $ = require('jquery');

$(function() {

    let $newTaskButton = $('#newTaskContainerToggleButton');

    $('#taskFormCancelButton').click(function(event) {
        event.preventDefault();

        $newTaskButton.click();
    });

});
