/**
 * js/app/file-type.js
 */

let ajax = require('Services/ajax');

let fileType = {};

fileType.updateFormsOrder = function(fileTypeId, formsOrder) {

    let route = {
        name: 'admin.file-types.forms.update-order',
        params: {
            fileType: fileTypeId
        }
    };

    let data = {
        orderedForms: formsOrder
    };

    return ajax.post(route, data);
};

module.exports = fileType;
