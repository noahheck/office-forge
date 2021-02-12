<?php


namespace App\Report\Dataset\Filter;

use App\Report;
use App\Report\Dataset;
use App\Report\Dataset\Filter;

/**
 * Validates that the provided inputs for a Filter are acceptable based on the report, dataset, field and operator
 * Class Validator
 * @package App\Report\Dataset\Filter
 */
class Validator
{
    /**
     * @param Report $report
     * @param Dataset $dataset
     * @param $field_id
     * @param $request
     * @return array
     */
    public function getValidValuesForFilterForReportAndDataset(
        Report $report,
        Dataset $dataset,
        $field_id,
        $request
    ) {
        $field = [];
        $filterType = false;

        if (in_array($field_id, ['date', 'created_date'])) {
            $filterType = 'date';
        } elseif (in_array($field_id, ['created_by', 'creator_id'])) {
            $filterType = 'user';
        } else {
            $field = $dataset->datasetableTemplateFieldType()::find($field_id);
            $filterType = $field->field_type;
        }

        if (!$filterType) {

            return $this->response(false);
        }

        if (in_array($filterType, ['range', 'integer', 'decimal', 'money'])) {
            $filterType = 'numeric';
        }


        $processFunction = 'process' . ucfirst($filterType) . 'Values';

        return $this->$processFunction($report, $field_id, $request, $field);
    }

    private function response(
        $success = false,
        $field_id = '',
        $operator = '',
        $value_1 = null,
        $value_2 = null,
        $value_3 = null
    ) {
        return [
            'success' => $success,
            'field_id' => $field_id,
            'operator' => $operator,
            'value_1' => $value_1,
            'value_2' => $value_2,
            'value_3' => $value_3,
        ];
    }

    private function isBooleanOperator($operator)
    {
        return Filter::isBooleanOperator($operator);
    }


    private function processCheckboxValues($report, $field_id, $request, $field)
    {
        $operator = $request->checkbox_operator;

        $checkboxOperators = array_keys(Filter::checkboxOperatorOptions());

        if (!in_array($operator, $checkboxOperators)) {

            return $this->response(false);
        }

        return $this->response(true, $field_id, $operator);
    }



    private function processSelectValues($report, $field_id, $request, $field)
    {
        $operator = $request->select_operator;

        $selectOperators = array_keys(Filter::selectOperatorOptions());

        if (!in_array($operator, $selectOperators)) {

            return $this->response(false);
        }

        if ($this->isBooleanOperator($operator)) {

            return $this->response(true, $field_id, $operator);
        }

        $specifiedValue = $request->select_value;

        if (!in_array($specifiedValue, $field->options->select_options)) {

            return $this->response(false);
        }

        return $this->response(true, $field_id, $operator, $specifiedValue);
    }



    private function processUserValues($report, $field_id, $request, $field)
    {
        $operator = $request->user_operator;

        $userOperators = array_keys(Filter::userOperatorOptions());

        if (!in_array($operator, $userOperators)) {

            return $this->response(false);
        }

        if ($this->isBooleanOperator($operator)) {

            return $this->response(true, $field_id, $operator);
        }

        $value1 = $request->user_value_1;

        if ($value1 === Filter::FILTER_VALUE_USER_GENERATING_REPORT) {

            return $this->response(true, $field_id, $operator, $value1);
        }

        if ($value1 === Filter::FILTER_VALUE_USER_REPORT_FILTERED_USER && $report->filter_user) {

            return $this->response(true, $field_id, $operator, $value1);
        }

        if ($value1 === Filter::FILTER_VALUE_USER_SPECIFIC_USER && $value2 = $request->user_value_2) {

            return $this->response(true, $field_id, $operator, $value1, $value2);
        }

        return $this->response(false);
    }



    private function processDateValues($report, $field_id, $request, $field)
    {
        $operator = $request->date_operator;

        $dateOperators = array_keys(Filter::dateOperatorOptions());

        if (!in_array($operator, $dateOperators)) {

            return $this->response(false);
        }

        if ($this->isBooleanOperator($operator)) {

            return $this->response(true, $field_id, $operator);
        }

        $value1 = $request->date_value_1;
        $value2 = $request->date_value_2;
        $value3 = $request->date_value_3;

        if (
               $value1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE
            && $report->filter_date === Report::REPORT_FILTER_DATE_DATE
        ) {

            return $this->response(true, $field_id, $operator, $value1);
        }

        if (
            $value1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE
            && $report->filter_date === Report::REPORT_FILTER_DATE_RANGE
        ) {

            return $this->response(true, $field_id, $operator, $value1);
        }

        if ($value1 !== Filter::FILTER_VALUE_DATE_SPECIFIC_DATE) {

            return $this->response(false);
        }

        if ($operator === Filter::FILTER_OPERATOR_BETWEEN && $value2 && $value3) {

            return $this->response(true, $field_id, $operator, $value1, $value2, $value3);
        }

        if ($value2) {

            return $this->response(true, $field_id, $operator, $value1, $value2);
        }

        return $this->response(false);

    }



    private function processNumericValues($report, $field_id, $request, $field)
    {
        $operator = $request->numeric_operator;

        $numericOperators = array_keys(Filter::numericOperatorOptions());

        if (!in_array($operator, $numericOperators)) {

            return $this->response(false);
        }

        if ($this->isBooleanOperator($operator)) {

            return $this->response(true, $field_id, $operator);
        }

        $value1 = $request->numeric_value_1;
        $value2 = $request->numeric_value_2;

        if ($operator === Filter::FILTER_OPERATOR_BETWEEN) {

            if (!$value2) {

                return $this->response(false);
            }
        } else {
            $value2 = null;
        }

        if (!$value1) {

            return $this->response(false);
        }

        return $this->response(true, $field_id, $operator, $value1, $value2);
    }

}
