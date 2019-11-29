/**
 * js/app.js
 */

require('./bootstrap');

let $ = require('jquery');

require('Services/meta');
require('Services/ajax');

$(function() {

    let $body = $('body');

    $('#toggleApplicationSidebarButton').click(function() {
        $body.toggleClass('sidebar-shown');
    });

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
