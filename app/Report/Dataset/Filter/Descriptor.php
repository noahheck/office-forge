<?php


namespace App\Report\Dataset\Filter;


use App\Report\Dataset\Filter;
use App\User;

class Descriptor
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function descriptorForFilter(Filter $filter)
    {
        $filterField = $this->getFilterField($filter);

        $fieldDescriptor = $this->getFieldDescriptor($filterField);

        $operatorDescriptor = strtolower($this->getOperatorDescriptor($filter));

        $valueDescriptor = strtolower($this->getValueDescriptor($filter, $filterField));

        return $fieldDescriptor . ' ' . $operatorDescriptor . ' ' . $valueDescriptor;
    }


    private function getFilterField($filter)
    {
        $fieldGroupOptions = $filter->dataset->datasetable->filterableFieldOptions();

        $filterField = '';

        foreach ($fieldGroupOptions as $fieldGroup) {
            foreach ($fieldGroup as $field) {
                if ($field['value'] == $filter->field_id) {
                    $filterField = $field;
                    break 2;
                }
            }
        }

        return $filterField;
    }

    private function getFieldDescriptor($filterField)
    {
        return $filterField['label'];
    }

    private function getOperatorDescriptor($filter)
    {
        return Filter::operatorOptions()[$filter->operator] ?? "";
    }

    private function getValueDescriptor($filter, $filterField)
    {
        if (Filter::isBooleanOperator($filter->operator)) {

            return '';
        }

        $fieldType = $filterField['type'];

        if (in_array($fieldType, ['range', 'integer', 'decimal', 'money'])) {
            $fieldType = 'numeric';
        }

        $valueDescriptorFunction = $fieldType . 'Descriptor';

        return $this->$valueDescriptorFunction($filter, $filterField);
    }


    private function checkboxDescriptor($filter, $filterField)
    {
        return '';
    }

    private function selectDescriptor($filter, $filterField)
    {

        return $filter->value_1;
    }

    private function userDescriptor($filter, $filterField)
    {
        if ($filter->value_1 === Filter::FILTER_VALUE_USER_SPECIFIC_USER) {
            $user = $this->user->find($filter->value_2);

            return $user->name;
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_USER_GENERATING_REPORT) {

            return __('admin.filter_descriptor_userUserGeneratingReport');
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_USER_REPORT_FILTERED_USER) {

            return __('admin.filter_descriptor_userReportFilteredUser');
        }

        return '';
    }

    private function dateDescriptor($filter, $filterField)
    {
        if ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE) {

            return __('admin.filter_descriptor_dateReportFilteredDate');
        }

        if ($filter->value_1 === Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE) {

            return __('admin.filter_descriptor_dateReportFilteredDateRange');
        }

        if ($filter->operator === Filter::FILTER_OPERATOR_BETWEEN) {

            return $filter->value_2 . ' ' . __('app.and') . ' ' . $filter->value_3;
        }

        return $filter->value_2;
    }

    private function numericDescriptor($filter, $filterField)
    {
        if ($filter->operator === Filter::FILTER_OPERATOR_BETWEEN) {

            return $filter->value_1 . ' ' . __('app.and') . ' ' . $filter->value_2;
        }

        return $filter->value_1;
    }
}
