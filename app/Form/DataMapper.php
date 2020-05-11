<?php


namespace App\Form;

class DataMapper
{
    public function __construct()
    {

    }


    public function updateFieldValue($field, $value, $inputData)
    {
        $field_id = $field->id;

        if (in_array($field->field_type, ['text', 'email', 'phone', 'select'])) {
            $value->value_text1 = $inputData['field_' . $field_id];
        }

        if (in_array($field->field_type, ['money', 'decimal'])) {
            $value->value_decimal = $inputData['field_' . $field_id];
        }

        if ($field->field_type === 'user') {
            $value->value_user = $inputData['field_' . $field_id];
        }

        if ($field->field_type === 'file') {
            $value->value_file = $inputData['field_' . $field_id];
        }

        if ($field->field_type === 'integer') {
            $value->value_integer = $inputData['field_' . $field_id];
        }

        if ($field->field_type === 'date') {
            $value->value_date = $inputData['field_' . $field_id];
        }

        if ($field->field_type === 'checkbox') {
            $value->value_boolean = isset($inputData['field_' . $field_id]) && $inputData['field_' . $field_id];
        }

        if ($field->field_type === 'textarea') {
            $value->value_longtext = $inputData['field_' . $field_id];
        }

        if ($field->field_type === 'name') {
            $value->value_text1 = $inputData['field_' . $field_id . '_1'];
            $value->value_text2 = $inputData['field_' . $field_id . '_2'];
            $value->value_text3 = $inputData['field_' . $field_id . '_3'];
            $value->value_text4 = $inputData['field_' . $field_id . '_4'];
        }

        if ($field->field_type === 'address') {
            $value->value_text1 = $inputData['field_' . $field_id . '_1'];
            $value->value_text2 = $inputData['field_' . $field_id . '_2'];
            $value->value_text3 = $inputData['field_' . $field_id . '_3'];
            $value->value_text4 = $inputData['field_' . $field_id . '_4'];
            $value->value_text5 = $inputData['field_' . $field_id . '_5'];
        }
    }
}
