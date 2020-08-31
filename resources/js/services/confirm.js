/**
 * js/services/confirm.js
 */

let $ = require('jquery');
let meta = require('Services/meta');

let confirm = {};

let popupsContainer = '';
let confirmVocab = 'Confirm';
let cancelVocab = 'Cancel';
let confirmDeleteVocab = 'Confirm Delete';
let sureDeleteThisVocab = 'Are you sure you want to delete this?';

$(function() {
    popupsContainer = $('#popups');
    confirmVocab = meta.get('vocab-confirm');
    cancelVocab = meta.get('vocab-cancel');
    confirmDeleteVocab = meta.get('vocab-confirm-delete');
    sureDeleteThisVocab = meta.get('vocab-sure-delete-this');
});

function showPopup(title, message) {

    return new Promise(function(resolve, reject) {

        let modalMarkup = '<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
            '  <div class="modal-dialog">' +
            '    <div class="modal-content shadow">' +
            '      <div class="modal-header">' +
            '        <h5 class="modal-title" id="confirmModalLabel">' + title + '</h5>' +
            '      </div>' +
            '      <div class="modal-body">' +
            message +
            '      </div>' +
            '      <div class="modal-footer">' +
            '        <button type="button" class="btn btn-secondary" id="confirmModal_cancelButton">' + cancelVocab + '</button>' +
            '        <button type="button" class="btn btn-warning" id="confirmModal_confirmButton">' + confirmVocab + '</button>' +
            '      </div>' +
            '    </div>' +
            '  </div>' +
            '</div>';

        popupsContainer.html(modalMarkup);

        let modal = $('#confirmModal');

        $('#confirmModal_confirmButton').click(function() {
            resolve(true);
            modal.modal('hide');
        });

        $('#confirmModal_cancelButton').click(function() {
            resolve(false);
            modal.modal('hide');
        });

        modal.modal({
            backdrop: 'static'
        }).on('hidden.bs.modal', function() {
            $(this).remove();
        });

    });
}

confirm.delete = function(item) {
    return showPopup('<span class="fas fa-trash-alt text-danger mr-2"></span>' + confirmDeleteVocab, sureDeleteThisVocab + '<div class="text-center mt-4 mb-4 fs-16px">' + item + '</div>');
}

module.exports = confirm;
