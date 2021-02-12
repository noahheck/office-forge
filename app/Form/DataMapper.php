<?php


namespace App\Form;

class DataMapper
{
    public function __construct()
    {

    }

    public function getFieldValueColumn($field)
    {
        if (in_array($field->field_type, ['text', 'email', 'phone', 'select'])) {
            return 'value_text1';
        }

        if (in_array($field->field_type, ['money', 'decimal'])) {
            return 'value_decimal';
        }

        if (in_array($field->field_type, ['integer', 'range'])) {
            return 'value_integer';
        }

        if ($field->field_type === 'user') {

            return 'value_user';
        }

        if ($field->field_type === 'file') {

            return 'value_file';
        }

        if ($field->field_type === 'date') {
            return 'value_date';
        }

        if ($field->field_type === 'checkbox') {
            return 'value_boolean';
        }

        if ($field->field_type === 'textarea') {
            return 'value_longtext';
        }

        if ($field->field_type === 'name') {

            return $field->valueName();
        }

        if ($field->field_type === 'address') {

            return $field->valueAddress();
        }
    }

    public function getFieldValue($field)
    {
        if (in_array($field->field_type, ['text', 'email', 'phone', 'select'])) {
            return $field->value_text1;
        }

        if (in_array($field->field_type, ['money', 'decimal'])) {
            return $field->value_decimal;
        }

        if (in_array($field->field_type, ['integer', 'range'])) {
            return $field->value_integer;
        }

        if ($field->field_type === 'user') {

            return $field->valueUser;
        }

        if ($field->field_type === 'file') {

            return $field->valueFile;
        }

        if ($field->field_type === 'date') {
            return $field->valueDate;
        }

        if ($field->field_type === 'checkbox') {
            return $field->value_boolean;
        }

        if ($field->field_type === 'textarea') {
            return $field->value_longtext;
        }

        if ($field->field_type === 'name') {

            return $field->valueName();
        }

        if ($field->field_type === 'address') {

            return $field->valueAddress();
        }
    }


    public function updateFieldValue($field, $value, $inputData)
    {
        $field_id = $field->id;

        if (in_array($field->field_type, ['text', 'email', 'phone', 'select'])) {
            $value->value_text1 = $inputData['field_' . $field_id] ?? null;
        }

        if (in_array($field->field_type, ['money', 'decimal'])) {
            $value->value_decimal = $inputData['field_' . $field_id] ?? null;
        }

        if (in_array($field->field_type, ['integer', 'range'])) {
            $value->value_integer = $inputData['field_' . $field_id] ?? null;
        }

        if ($field->field_type === 'user') {
            $value->value_user = $inputData['field_' . $field_id] ?? null;
        }

        if ($field->field_type === 'file') {
            $value->value_file = $inputData['field_' . $field_id] ?? null;
        }

        if ($field->field_type === 'date') {
            $value->value_date = $inputData['field_' . $field_id] ?? null;
        }

        if ($field->field_type === 'checkbox') {
            $value->value_boolean = isset($inputData['field_' . $field_id]) && $inputData['field_' . $field_id];
        }

        if ($field->field_type === 'textarea') {
            $value->value_longtext = $inputData['field_' . $field_id] ?? null;
        }

        if ($field->field_type === 'name') {
            $value->value_text1 = $inputData['field_' . $field_id . '_1'] ?? null;
            $value->value_text2 = $inputData['field_' . $field_id . '_2'] ?? null;
            $value->value_text3 = $inputData['field_' . $field_id . '_3'] ?? null;
            $value->value_text4 = $inputData['field_' . $field_id . '_4'] ?? null;
        }

        if ($field->field_type === 'address') {
            $value->value_text1 = $inputData['field_' . $field_id . '_1'] ?? null;
            $value->value_text2 = $inputData['field_' . $field_id . '_2'] ?? null;
            $value->value_text3 = $inputData['field_' . $field_id . '_3'] ?? null;
            $value->value_text4 = $inputData['field_' . $field_id . '_4'] ?? null;
            $value->value_text5 = $inputData['field_' . $field_id . '_5'] ?? null;
        }
    }
}
