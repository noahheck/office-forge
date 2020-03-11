@textareaField([
    'name' => 'field_' . $field->id,
    'label' => $field->label,
    'details' => $field->description,
    'value' => $value->longtext,
    'placeholder' => $field->placeholder,
    'rows' => 5,
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->id),
])
