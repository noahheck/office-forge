@dateField([
    'name' => $field->id,
    'label' => $field->label,
    'details' => $field->description,
    'value' => $value->value_date,
    'placeholder' => $field->placeholder,
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->id),
    'readonly' => $readonly ?? false,
])
