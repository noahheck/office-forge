@checkboxField([
    'name' => $field->fieldName(),
    'id' => 'field_' . $field->id,
    'label' => $field->label,
    'details' => $field->description,
    'checked' => old($field->fieldName(), $value->value_boolean),
    'value' => $value->value_text1,
    'required' => false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
])

@errors($field->fieldName())
