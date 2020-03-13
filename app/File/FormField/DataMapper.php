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

        if ($field->field_type == 'textarea') {
            $value->value_longtext = $inputData[$field_id];
        }
    }
}
