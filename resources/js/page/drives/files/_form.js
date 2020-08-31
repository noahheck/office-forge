/**
 * js/page/drives/files/_form.js
 */

let $ = require('jquery');

$(function() {

    let extensionLabel = $('#inputGroupAppendedText_name');
    let nameField = $('#name');

    $('#file').change(function() {

        let file = this.files[0];

        let filenameDetails = parseFilenameParts(file.name);

        nameField.val(filenameDetails.name);
        extensionLabel.text( (filenameDetails.extension) ? '.' + filenameDetails.extension : '');
    });

});

function parseFilenameParts(fileName) {

    let filenameParts = fileName.toString().split('.');

    let extension = filenameParts.pop();

    let name = filenameParts.join('.');

    if (!name) {
        name = extension;
        extension = '';
    }

    return {
        name: name,
        extension: extension.toLowerCase()
    };
}
