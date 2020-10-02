/**
 * js/app.js
 */

require('./bootstrap');

let $ = require('jquery');

let meta = require('Services/meta');
require('Services/ajax');
require('Services/notify');
let confirm = require('Services/confirm');

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

    $('[data-toggle="popover"]').popover();

    $('[data-toggle="tooltip"]').tooltip();

    $('.dt-table').DataTable();

    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        disableTouchKeyboard: true,
        todayBtn: 'linked',
        clearBtn: true,
        zIndexOffset: 1031,
    });

    let $autoFocusFields = $("[autofocus]");

    console.log($autoFocusFields);

    if (!$autoFocusFields.length) {
        $('.dataTables_filter input[type=search]').focus();
    } else {
        $autoFocusFields.blur()[0].focus();
    }

    $('.confirm-delete-form').submit(async function(e) {
        let $form = $(this);

        if ($form.data('deleteConfirmed')) {
            return true;
        }

        e.preventDefault();

        let confirmed = await confirm.delete($form.data('deleteItemTitle'));

        if (confirmed) {
            $form.data('deleteConfirmed', true);
            $form.submit();
        }
    });

});
