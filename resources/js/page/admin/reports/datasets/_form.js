/**
 * js/page/admin/reports/datasets/_form.js
 */

let $ = require('jquery');


$(function() {

    let $datasetableType = $('#datasetable_type')

    function showOptionsForDatasetableType() {

        let selectedValue = $datasetableType.val().replace(/\\/gi, '_');

        $(".datasetable_type_option_container").addClass('d-none');
        $("#" + selectedValue + "_datasetable_type_option_container").removeClass('d-none');
    }

    $datasetableType.change(showOptionsForDatasetableType);

    showOptionsForDatasetableType();

});
