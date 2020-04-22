/**
 * js/app/file-type.js
 */

let ajax = require('Services/ajax');

let fileType = {};


fileType.updatePanelsOrder = function(fileTypeId, panelsOrder) {

    let route = {
        name: 'admin.file-types.panels.update-order',
        params: {
            fileType: fileTypeId
        }
    };

    let data = {
        orderedPanels: panelsOrder
    };

    return ajax.post(route, data);
};


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
