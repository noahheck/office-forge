@textField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'details' => $field->description,
    'value' => old($field->fieldName(), $value->value_text1),
    'placeholder' => $field->placeholder,
    'required' => false,
    'autofocus' => $autofocus ?? false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
])

@errors($field->fieldName())
