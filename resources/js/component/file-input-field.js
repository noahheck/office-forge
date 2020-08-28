/**
 * js/component/file-input-field.js
 */

let $ = require('jquery');

$(function() {

    $('.file-upload-field-input').change(function() {

        let file = this.files[0];

        let inputName = $(this).attr('name');

        var labelId = "customFileLabel_" + inputName;

        $('#' + labelId).text(file.name);

        let imagePreviewContainer = $('#fileUploadImagePreviewContainer_'+ inputName);

        if (file.type.toString().match(/^image\//)) {

            let image = $('#fileUploadImagePreview_' + inputName);
            let reader = new FileReader();

            reader.onload = (e) => {
                image.attr('src', e.target.result);
            };

            reader.readAsDataURL(this.files[0]);

            imagePreviewContainer.addClass('previewing-image');

        } else {

            imagePreviewContainer.removeClass('previewing-image');

        }

    });

});
