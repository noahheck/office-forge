/**
 * js/app/file-type.js
 */

let ajax = require('Services/ajax');

let formDoc = {};

formDoc.updateFieldsOrder = function(formDocId, fieldsOrder) {

    let route = {
        name: 'admin.form-docs.fields.update-order',
        params: {
            formDoc: formDocId
        }
    };

    let data = {
        orderedFields: fieldsOrder
    };

    return ajax.post(route, data);
};

module.exports = formDoc;
