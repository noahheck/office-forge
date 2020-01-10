/**
 * js/page/settings/photo.js
 */

let $ = require('jquery');

$(() => {
    let $input = $('#new_profile_photo');
    let image  = $('.upload-preview');

    $input.change(function() {

        let reader = new FileReader();

        reader.onload = (e) => {
            image.attr('src', e.target.result).addClass('in-preview');
        };

        reader.readAsDataURL(this.files[0]);

    });
});
