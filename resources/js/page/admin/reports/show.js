/**
 * js/page/admin/reports/show.js
 */

let $ = require('jquery');
import Sortable from 'sortablejs';

let meta   = require('Services/meta');
let notify = require('Services/notify');

let report = require('App/report');

$(function() {

    let reportId = meta.get('reportId');


    let sortable = Sortable.create(document.getElementById('reportDatasets'), {
        handle: '.sort-handle',
        animation: 150,
        direction: 'vertical',
        onEnd: function(evt) {
            report.updateDatasetOrder(reportId, sortable.toArray()).then(response => {

                notify.success(response.data.successMessage);
            });
        }
    });

});
