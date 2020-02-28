/**
 * js/app/process/task.js
 */

let ajax = require('Services/ajax');

let form = {};

form.updateFieldsOrder = function(fileTypeId, formId, fieldsOrder) {

    let route = {
        name: 'admin.file-types.forms.fields.update-order',
        params: {
            fileType: fileTypeId,
            form: formId
        }
    };

    let data = {
        orderedFields: fieldsOrder
    };

    return ajax.post(route, data);
};

module.exports = form;
