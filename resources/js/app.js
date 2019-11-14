/**
 * js/app.js
 */

require('./bootstrap');

let $ = require('jquery');

$(function() {

    let $body = $('body');

    $('#toggleApplicationSidebarButton').click(function() {
        $body.toggleClass('sidebar-shown');
    });

    $('.dt-table').DataTable();

});
