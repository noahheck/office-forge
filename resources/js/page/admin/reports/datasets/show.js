/**
 * js/page/admin/reports/datasets/show.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let meta   = require('Services/meta');
let notify = require('Services/notify');

let dataset = require('App/report/dataset');

$(function() {

    let reportId = meta.get('reportId');
    let datasetId = meta.get('datasetId');


    let fields = document.getElementById('datasetFields');

    if (fields) {

        let fieldSortable = Sortable.create(fields, {
            handle: '.sort-handle',
            animation: 150,
            direction: 'vertical',
            onEnd: function(evt) {
                dataset.updateFieldsOrder(reportId, datasetId, fieldSortable.toArray()).then(response => {

                    notify.success(response.data.successMessage);
                }).catch(error => {

                });
            }
        });

    }


    let filters = document.getElementById('datasetFilters');

    if (filters) {

        let filterSortable = Sortable.create(filters, {
            handle: '.sort-handle',
            animation: 150,
            direction: 'vertical',
            onEnd: function(evt) {
                dataset.updateFiltersOrder(reportId, datasetId, filterSortable.toArray()).then(response => {

                    notify.success(response.data.successMessage);
                }).catch(error => {

                });
            }
        });

    }


    let visualizations = document.getElementById('datasetVisualizations');

    if (visualizations) {

        let visualizationSortable = Sortable.create(visualizations, {
            handle: '.sort-handle',
            animation: 150,
            direction: 'vertical',
            onEnd: function(evt) {
                dataset.updateVisualizationsOrder(reportId, datasetId, visualizationSortable.toArray()).then(response => {

                    notify.success(response.data.successMessage);
                }).catch(error => {

                });
            }
        });
    }

});
