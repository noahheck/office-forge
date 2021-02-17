/**
 * js/page/admin/reports/datasets/filters/_form.js
 */

let $ = require('jquery');
let meta = require('Services/meta');

let visualizationTypeOptionsContainerMap = {
    'total_records_count': 'total_recordsOptions',
    'field_value_sum': 'sum_averageOptions',
    'field_value_average': 'sum_averageOptions',
    'single_field_aggregate': 'aggregateOptions'
};

$(function() {

    let $visualizationTypeField = $('#visualization_type');

    let $visualizationTypeOptionDivs = $(".visualization-type-options");

    function showVisualizationTypeOptionsBasedOnSelectedVisualizationType() {
        let visualizationType = $visualizationTypeField.val();

        $visualizationTypeOptionDivs.addClass('d-none');

        let visualizationTypeOptionDivToShow = visualizationTypeOptionsContainerMap[visualizationType];
        $('#' + visualizationTypeOptionDivToShow).removeClass('d-none');
    }

    $visualizationTypeField.change(showVisualizationTypeOptionsBasedOnSelectedVisualizationType);

    showVisualizationTypeOptionsBasedOnSelectedVisualizationType();

});
