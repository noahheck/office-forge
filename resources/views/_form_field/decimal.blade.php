@decimalField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'details' => $field->description,
    'value' => old($field->fieldName(), number_format($value->value_decimal, $field->decimalPlaces(), '.', '')),
    'decimalPlaces' => $field->decimalPlaces(),
    'placeholder' => '123',
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
])

@errors($field->fieldName())
