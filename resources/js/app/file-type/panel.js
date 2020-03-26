/**
 * js/app/file-type/form.js
 */

let ajax = require('Services/ajax');

let panel = {};

panel.updateFieldsOrder = function(fileTypeId, panelId, fieldsOrder) {

    let route = {
        name: 'admin.file-types.panels.update-field-order',
        params: {
            fileType: fileTypeId,
            panel: panelId
        }
    };

    let data = {
        orderedFields: fieldsOrder
    };

    return ajax.post(route, data);
};

module.exports = panel;
