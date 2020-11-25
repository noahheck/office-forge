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

        let sortable = Sortable.create(fields, {
            handle: '.sort-handle',
            animation: 150,
            direction: 'vertical',
            onEnd: function(evt) {
                dataset.updateFieldsOrder(reportId, datasetId, sortable.toArray()).then(response => {

                    notify.success(response.data.successMessage);
                }).catch(error => {

                });
            }
        });

    }

});
