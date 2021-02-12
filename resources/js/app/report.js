/**
 * js/app/report.js
 */

let ajax = require('Services/ajax');

let report = {};

report.updateDatasetOrder = function(reportId, datasetOrder) {

    let route = {
        name: "admin.reports.datasets.update-order",
        params: {
            report: reportId
        }
    }

    let data = {
        orderedDatasets: datasetOrder
    };

    return ajax.post(route, data);
}

module.exports = report;
