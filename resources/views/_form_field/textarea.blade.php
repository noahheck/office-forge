@textareaField([
    'name' => $field->id,
    'label' => $field->label,
    'details' => $field->description,
    'value' => $value->value_longtext,
    'placeholder' => $field->placeholder,
    'rows' => 5,
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->id),
])
