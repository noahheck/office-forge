/**
 * js/app/report/dataset.js
 */

let dataset = {};

dataset.updateFieldsOrder = function(reportId, datasetId, orderedFields) {
    let route = {
        name: "admin.reports.datasets.fields.update-order",
        params: {
            report: reportId,
            dataset: datasetId
        }
    }

    let data = {
        orderedFields: orderedFields
    };

    return ajax.post(route, data);
}

dataset.updateFiltersOrder = function(reportId, datasetId, orderedFilters) {
    let route = {
        name: "admin.reports.datasets.filters.update-order",
        params: {
            report: reportId,
            dataset: datasetId
        }
    }

    let data = {
        orderedFilters: orderedFilters
    };

    return ajax.post(route, data);
}

dataset.updateVisualizationsOrder = function(reportId, datasetId, orderedVisualizations) {
    let route = {
        name: "admin.reports.datasets.visualizations.update-order",
        params: {
            report: reportId,
            dataset: datasetId
        }
    };

    let data = {
        orderedVisualizations: orderedVisualizations
    };

    return ajax.post(route, data);
}

module.exports = dataset;
