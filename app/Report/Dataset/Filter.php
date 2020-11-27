<?php

namespace App\Report\Dataset;

use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    const FILTER_OPTION_TYPE_DATE = 'date';
    const FILTER_OPTION_TYPE_USER = 'user';
    const FILTER_OPTION_TYPE_FILE = 'file';
    const FILTER_OPTION_TYPE_RANGE = 'range';
    const FILTER_OPTION_TYPE_INTEGER = 'integer';
    const FILTER_OPTION_TYPE_DECIMAL = 'decimal';
    const FILTER_OPTION_TYPE_MONEY = 'money';
    const FILTER_OPTION_TYPE_CHECKBOX = 'checkbox';
    const FILTER_OPTION_TYPE_SELECT = 'select';

    const FILTER_OPERATOR_HAS_VALUE = 'has_value';
    const FILTER_OPERATOR_DOES_NOT_HAVE_VALUE = 'does_not_have_value';
    const FILTER_OPERATOR_EQUALS = 'equals';
    const FILTER_OPERATOR_NOT_EQUALS = 'not_equals';
    const FILTER_OPERATOR_GREATER_THAN = 'greater_than';
    const FILTER_OPERATOR_GREATER_THAN_EQUALS = 'greater_than_equals';
    const FILTER_OPERATOR_LESS_THAN = 'less_than';
    const FILTER_OPERATOR_LESS_THAN_EQUALS = 'less_than_equals';
    const FILTER_OPERATOR_BETWEEN = 'between';
    const FILTER_OPERATOR_CHECKED = 'checked';
    const FILTER_OPERATOR_NOT_CHECKED = 'unchecked';

    const FILTER_VALUE_DATE_SPECIFIC_DATE = 'specific_date';
    const FILTER_VALUE_DATE_REPORT_FILTERED_DATE = 'report_filtered_date';
    const FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE = 'report_filtered_date_range';

    const FILTER_VALUE_USER_REPORT_FILTERED_USER = 'report_filtered_user';
    const FILTER_VALUE_USER_GENERATING_REPORT = 'user_generating_report';
    const FILTER_VALUE_USER_SPECIFIC_USER = 'specific_user';

    protected static $filterOptionTypes = [
        self::FILTER_OPTION_TYPE_DATE,
        self::FILTER_OPTION_TYPE_USER,
//        self::FILTER_OPTION_TYPE_FILE, // not now, maybe look at doing this later
        self::FILTER_OPTION_TYPE_RANGE,
        self::FILTER_OPTION_TYPE_INTEGER,
        self::FILTER_OPTION_TYPE_DECIMAL,
        self::FILTER_OPTION_TYPE_MONEY,
        self::FILTER_OPTION_TYPE_CHECKBOX,
        self::FILTER_OPTION_TYPE_SELECT,
    ];


    protected $table = 'report_dataset_filters';

    public function dataset()
    {
        return $this->belongsTo(Dataset::class, 'dataset_id');
    }




    public static function isBooleanOperator($operator)
    {
        return in_array($operator, [self::FILTER_OPERATOR_HAS_VALUE, self::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE]);
    }

    public static function operatorOptions()
    {
        return [
            self::FILTER_OPERATOR_EQUALS => __('report.filter_operator_equals'),
            self::FILTER_OPERATOR_NOT_EQUALS => __('report.filter_operator_not_equals'),
            self::FILTER_OPERATOR_GREATER_THAN => __('report.filter_operator_greater_than'),
            self::FILTER_OPERATOR_GREATER_THAN_EQUALS => __('report.filter_operator_greater_than_equals'),
            self::FILTER_OPERATOR_LESS_THAN => __('report.filter_operator_less_than'),
            self::FILTER_OPERATOR_LESS_THAN_EQUALS => __('report.filter_operator_less_than_equals'),
            self::FILTER_OPERATOR_BETWEEN => __('report.filter_operator_between'),
            self::FILTER_OPERATOR_HAS_VALUE => __('report.filter_operator_has_value'),
            self::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE => __('report.filter_operator_does_not_have_value'),
            self::FILTER_OPERATOR_CHECKED => __('report.filter_operator_checked'),
            self::FILTER_OPERATOR_NOT_CHECKED => __('report.filter_operator_not_checked'),
        ];
    }



    public static function checkboxOperatorOptions()
    {
        return [
            self::FILTER_OPERATOR_CHECKED => __('report.filter_operator_checked'),
            self::FILTER_OPERATOR_NOT_CHECKED => __('report.filter_operator_not_checked'),
        ];
    }

    public static function selectOperatorOptions()
    {
        return [
            self::FILTER_OPERATOR_EQUALS => __('report.filter_operator_equals'),
            self::FILTER_OPERATOR_NOT_EQUALS => __('report.filter_operator_not_equals'),
            self::FILTER_OPERATOR_HAS_VALUE => __('report.filter_operator_has_value'),
            self::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE => __('report.filter_operator_does_not_have_value'),
        ];
    }

    public static function userOperatorOptions()
    {
        return [
            self::FILTER_OPERATOR_EQUALS => __('report.filter_operator_equals'),
            self::FILTER_OPERATOR_NOT_EQUALS => __('report.filter_operator_not_equals'),
            self::FILTER_OPERATOR_HAS_VALUE => __('report.filter_operator_has_value'),
            self::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE => __('report.filter_operator_does_not_have_value'),
        ];
    }

    public static function dateOperatorOptions()
    {
        return [
            self::FILTER_OPERATOR_EQUALS => __('report.filter_operator_equals'),
            self::FILTER_OPERATOR_NOT_EQUALS => __('report.filter_operator_not_equals'),
            self::FILTER_OPERATOR_GREATER_THAN => __('report.filter_operator_greater_than'),
            self::FILTER_OPERATOR_GREATER_THAN_EQUALS => __('report.filter_operator_greater_than_equals'),
            self::FILTER_OPERATOR_LESS_THAN => __('report.filter_operator_less_than'),
            self::FILTER_OPERATOR_LESS_THAN_EQUALS => __('report.filter_operator_less_than_equals'),
            self::FILTER_OPERATOR_BETWEEN => __('report.filter_operator_between'),
            self::FILTER_OPERATOR_HAS_VALUE => __('report.filter_operator_has_value'),
            self::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE => __('report.filter_operator_does_not_have_value'),
        ];
    }

    public static function numericOperatorOptions()
    {
        return [
            self::FILTER_OPERATOR_EQUALS => __('report.filter_operator_equals'),
            self::FILTER_OPERATOR_NOT_EQUALS => __('report.filter_operator_not_equals'),
            self::FILTER_OPERATOR_GREATER_THAN => __('report.filter_operator_greater_than'),
            self::FILTER_OPERATOR_GREATER_THAN_EQUALS => __('report.filter_operator_greater_than_equals'),
            self::FILTER_OPERATOR_LESS_THAN => __('report.filter_operator_less_than'),
            self::FILTER_OPERATOR_LESS_THAN_EQUALS => __('report.filter_operator_less_than_equals'),
            self::FILTER_OPERATOR_BETWEEN => __('report.filter_operator_between'),
            self::FILTER_OPERATOR_HAS_VALUE => __('report.filter_operator_has_value'),
            self::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE => __('report.filter_operator_does_not_have_value'),
        ];
    }




    public static function isValidFilterFieldType($filterType)
    {
        return in_array($filterType, self::$filterOptionTypes);
    }

    public static function makeFilterOption($value, $label, $filterType, $options)
    {
        if (!self::isValidFilterFieldType($filterType)) {

            throw new \InvalidArgumentException("$filterType is not a valid Filter type");
        }

        return [
            'value' => $value,
            'label' => $label,
            'type' => $filterType,
            'options' => $options,
        ];
    }
}
