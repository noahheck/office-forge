@emailField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'details' => $field->description,
    'value' => old($field->fieldName(), $value->value_text1),
    'placeholder' => __('file.field_fieldTypeEmailPreviewPlaceholder'),
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
])

@errors($field->fieldName())
