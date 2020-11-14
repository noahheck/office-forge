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

    protected static $filterOptionTypes = [
        self::FILTER_OPTION_TYPE_DATE,
        self::FILTER_OPTION_TYPE_USER,
        self::FILTER_OPTION_TYPE_FILE,
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
        ];
    }

    public static function isValidFilterFieldType($filterType)
    {
        return in_array($filterType, self::$filterOptionTypes);
    }

    public static function makeFilterOption($value, $label, $filterType)
    {
        if (!self::isValidFilterFieldType($filterType)) {

            throw new \InvalidArgumentException("$filterType is not a valid Filter type");
        }

        return [
            'value' => $value,
            'label' => $label,
            'type' => $filterType,
        ];
    }
}
