/**
 * js/app.js
 */

require('./bootstrap');

let $ = require('jquery');

let meta = require('Services/meta');
require('Services/ajax');
require('Services/notify');

$(async function() {

    let $body = $('body');

    $('#toggleApplicationSidebarButton').click(function() {
        $body.toggleClass('sidebar-shown');
    });

    if (meta.get('check-notifications', false)) {

        let notifications = await ajax.get('notifications');

        notifications.data.success.forEach(message => {
            notify.success(message);
        });

        notifications.data.info.forEach(message => {
            notify.info(message);
        });

        notifications.data.warning.forEach(message => {
            notify.warning(message);
        });

        notifications.data.error.forEach(message => {
            notify.error(message);
        });
    }

    $('.dt-table').DataTable();

    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        disableTouchKeyboard: true,
        todayBtn: 'linked',
        clearBtn: true,
        zIndexOffset: 1031,
    });

});
