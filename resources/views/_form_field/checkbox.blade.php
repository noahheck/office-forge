@checkboxField([
    'name' => $field->id,
    'id' => 'field_' . $field->id,
    'label' => $field->label,
    'details' => $field->description,
    'checked' => $value->value_boolean,
    'value' => $value->value_text1,
    'required' => false,
    'error' => $errors->has($field->id),
])
