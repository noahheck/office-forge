/**
 * js/page/admin/file-types/forms/fields/_form.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let fieldOptionContainers;

function showFieldTypeOptions(fieldType) {
    fieldOptionContainers.hide();

    $('#form-field-options_' + fieldType).show();
}





function addSelectOption() {
    let $newOptionTextBox = $('#newSelectOption');
    let newOption = $newOptionTextBox.val();

    if (!newOption) {
        return;
    }

    let li = $('#newSelectOptionTemplate').clone(true, true);

    li.attr('id', '');
    li.find('.select-option-text').text(newOption);
    li.find('input').val(newOption);

    $('#selectOptionsList').append(li);

    $newOptionTextBox.val('').focus();
}



$(function() {

    fieldOptionContainers = $('.form-field-option');

    let $fieldTypeSelect = $('#field_type');

    showFieldTypeOptions($fieldTypeSelect.val());

    $fieldTypeSelect.change(function() {
        showFieldTypeOptions($(this).val());
    });

    $('#addNewSelectOption').click(addSelectOption);
    $('#newSelectOption').keypress(function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();

            addSelectOption();
        }
    });

    Sortable.create(document.getElementById('selectOptionsList'), {
        handle: '.sort-handle'
    });

    $('.select-option-item .delete-button').click(function() {
        $(this).parent().remove();
    });
});
