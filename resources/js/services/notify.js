/**
 * services/notify.js
 */

let $ = require('jquery');

let notify = {};


let $notificationsContainer = '';

$(function() {
    $notificationsContainer = $('#notifications');
});

function addNotification(theme, icon, message, header, timeout, assertive) {

    let attrs = (assertive) ? 'role="alert" aria-live="assertive"' : 'role="status" aria-live="polite"';

    let toastMarkup = '<div class="toast ' + theme + '" ' + attrs + ' aria-atomic="true">' +
        '  <div class="toast-body">' +
        '    <strong class="mr-auto">' + icon + ' ' + header + '</strong>' +
        '    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">' +
        '      <span aria-hidden="true">&times;</span>' +
        '    </button>' +
             message +
        '  </div>' +
        '</div>';

    let $toast = $(toastMarkup);

    $notificationsContainer.append($toast);

    $toast.toast({
            autohide: (timeout) ? true : false,
            delay: (timeout) ? timeout : 0
        })
        .toast('show')
        .on('hidden.bs.toast', function () {
            $toast.remove();
        });
}


notify.success = function(message) {
    let icon = "<span class='toast-icon fas fa-check-circle'></span>";
    addNotification('success', icon, message, '', 3000);
};

notify.info = function(message) {
    let icon = "<span class='toast-icon fas fa-info-circle'></span>";
    addNotification('info', icon, message, '', 10000);
};

notify.warning = function(message) {
    let icon = "<span class='toast-icon fas fa-exclamation-circle'></span>";
    addNotification('warning', icon, message, '', 12000);
};

notify.error = function(message) {
    let icon = "<span class='fas fa-exclamation-triangle'></span>";
    addNotification('error', icon, message, 'Error: ', 0);
};




window.notify = notify;

module.exports = notify;
