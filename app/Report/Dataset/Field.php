<?php

namespace App\Report\Dataset;

use App\Report\Dataset;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    const FIELD_OPTION_TYPE_DATE = 'date';
    const FIELD_OPTION_TYPE_TEXT = 'text';
    const FIELD_OPTION_TYPE_EMAIL = 'email';
    const FIELD_OPTION_TYPE_PHONE = 'phone';
    const FIELD_OPTION_TYPE_USER = 'user';
    const FIELD_OPTION_TYPE_RANGE = 'range';
    const FIELD_OPTION_TYPE_INTEGER = 'integer';
    const FIELD_OPTION_TYPE_DECIMAL = 'decimal';
    const FIELD_OPTION_TYPE_MONEY = 'money';
    const FIELD_OPTION_TYPE_CHECKBOX = 'checkbox';
    const FIELD_OPTION_TYPE_SELECT = 'select';
    const FIELD_OPTION_TYPE_NAME = 'name';
    const FIELD_OPTION_TYPE_ADDRESS = 'address';
    const FIELD_OPTION_TYPE_FILE = 'file';

    protected static $fieldOptionTypes = [
        self::FIELD_OPTION_TYPE_DATE,
        self::FIELD_OPTION_TYPE_TEXT,
        self::FIELD_OPTION_TYPE_EMAIL,
        self::FIELD_OPTION_TYPE_PHONE,
        self::FIELD_OPTION_TYPE_USER,
        self::FIELD_OPTION_TYPE_RANGE,
        self::FIELD_OPTION_TYPE_INTEGER,
        self::FIELD_OPTION_TYPE_DECIMAL,
        self::FIELD_OPTION_TYPE_MONEY,
        self::FIELD_OPTION_TYPE_CHECKBOX,
        self::FIELD_OPTION_TYPE_SELECT,
        self::FIELD_OPTION_TYPE_NAME,
        self::FIELD_OPTION_TYPE_ADDRESS,
        self::FIELD_OPTION_TYPE_FILE,
    ];

    protected $table = 'report_dataset_fields';

    public function dataset()
    {
        return $this->belongsTo(Dataset::class, 'dataset_id');
    }

    public function field()
    {
        return $this->morphTo();
    }

    public function templateField()
    {
        return $this->morphTo('template_field', null, 'field_id');
    }


    public static function isValidReportableFieldType($fieldType)
    {

        return in_array($fieldType, self::$fieldOptionTypes);
    }

    public static function makeFieldOption($value, $label, $fieldType, $options)
    {
        if (!self::isValidReportableFieldType($fieldType)) {

            throw new \InvalidArgumentException("$fieldType is not a valid Field type");
        }

        return [
            'value' => $value,
            'label' => $label,
            'type' => $fieldType,
            'options' => $options,
        ];
    }
}
