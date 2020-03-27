@textareaField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'details' => $field->description,
    'value' => old($field->fieldName(), $value->value_longtext),
    'placeholder' => $field->placeholder,
    'rows' => 5,
    'required' => false,
    'autofocus' => $autofocus ?? false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
])

@errors($field->fieldName())
