/**
 * js/page/activities/tasks/_form.js
 */

let $ = require('jquery');
let meta = require('Services/meta');

$(function() {

    let userId = meta.get('userId');
    let jAssignedToSelect = $('#assigned_to');
    let jAssignToMeButton = $('#assignToMeButton');

    jAssignToMeButton.click(function() {
        jAssignedToSelect.selectpicker('val', userId);
    });

});
