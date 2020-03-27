/**
 * js/page/files/_form.js
 */

let $ = require('jquery');

// Same process as in js/page/settings/photo.js
$(() => {
    let $input = $('#new_file_photo');
    let image  = $('.upload-preview');

    $input.change(function() {

        let reader = new FileReader();

        reader.onload = (e) => {
            image.attr('src', e.target.result).addClass('in-preview');
        };

        reader.readAsDataURL(this.files[0]);

    });
});

