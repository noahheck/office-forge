@rangeField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'details' => $field->description,
    'value' => old($field->fieldName(), $value->value_integer),
    'min' => $field->rangeMin(),
    'max' => $field->rangeMax(),
    'min_label' => $field->rangeMinLabel(),
    'max_label' => $field->rangeMaxLabel(),
    'required' => false,
    'autofocus' => $autofocus ?? false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
    'fieldOnly' => false,
])

@errors($field->fieldName())
