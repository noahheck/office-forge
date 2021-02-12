/**
 * js/page/reports/_reports.js
 */

let $ = require('jquery');

$(function() {

    let $reportSelectField = $("#report_id");

    let $userSelectContainer = $("#userSelect");
    let $userSelectField = $("#user_id");

    let $dateSelect1Container = $("#dateSelect1");
    let $dateSelect1Field = $("#date");

    let $dateSelect2Container = $("#dateSelect2");
    let $dateSelect2Field1 = $("#date_from");
    let $dateSelect2Field2 = $("#date_to");


    function hideUserField() {
        $userSelectContainer.addClass("d-none");
        $userSelectField.attr('disabled', true);
    }

    function showUserField() {
        $userSelectContainer.removeClass("d-none");
        $userSelectField.removeAttr('disabled');
    }

    function hideDate1Field() {
        $dateSelect1Container.addClass("d-none");
        $dateSelect1Field.attr('disabled', true);
    }

    function showDate1Field() {
        $dateSelect1Container.removeClass("d-none");
        $dateSelect1Field.removeAttr('disabled');
    }

    function hideDate2Fields() {
        $dateSelect2Container.addClass("d-none");
        $dateSelect2Field1.attr('disabled', true);
        $dateSelect2Field2.attr('disabled', true);
    }

    function showDate2Fields() {
        $dateSelect2Container.removeClass("d-none");
        $dateSelect2Field1.removeAttr('disabled');
        $dateSelect2Field2.removeAttr('disabled');
    }


    function showFormFieldsForReport() {

        let reportSelected = $reportSelectField.val();

        if (!reportSelected) {
            hideUserField();
            hideDate1Field();
            hideDate2Fields();

            return;
        }

        let selectedOption = $reportSelectField.find("option:selected");

        let userSelect = selectedOption.data("filterUser");

        if (userSelect) {
            showUserField();
        } else {
            hideUserField();
        }

        let dateSelect = selectedOption.data('filterDate');

        if (dateSelect === 0) {

            hideDate1Field();
            hideDate2Fields();
        } else if (dateSelect === 1) {

            showDate1Field();
            hideDate2Fields();
        } else if (dateSelect === 2) {

            hideDate1Field();
            showDate2Fields();
        }

    }


    showFormFieldsForReport();

    $reportSelectField.change(showFormFieldsForReport);

});
