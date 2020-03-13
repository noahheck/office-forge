<?php


namespace App\File\FormField;


use App\FileType\Form\Field;

class DataMapper
{
    public function __construct()
    {

    }


    public function updateFieldValue(Field $field, Value $value, $inputData)
    {
        $field_id = $field->id;

        if (in_array($field->field_type,  ['text', 'email'])) {
            $value->value_text1 = $inputData[$field_id];
        }

        if ($field->field_type === 'date') {
            $value->value_date = $inputData[$field_id];
        }

        if ($field->field_type === 'textarea') {
            $value->value_longtext = $inputData[$field_id];
        }

        if ($field->field_type === 'name') {
            $value->value_text1 = $inputData[$field_id . '_1'];
            $value->value_text2 = $inputData[$field_id . '_2'];
            $value->value_text3 = $inputData[$field_id . '_3'];
            $value->value_text4 = $inputData[$field_id . '_4'];
        }

        if ($field->field_type === 'address') {
            $value->value_text1 = $inputData[$field_id . '_1'];
            $value->value_text2 = $inputData[$field_id . '_2'];
            $value->value_text3 = $inputData[$field_id . '_3'];
            $value->value_text4 = $inputData[$field_id . '_4'];
            $value->value_text5 = $inputData[$field_id . '_5'];
        }
    }
}
