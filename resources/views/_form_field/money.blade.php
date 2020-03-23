@moneyField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'details' => $field->description,
    'value' => old($field->fieldName(), number_format($value->value_decimal, 2, '.', '')),
    'placeholder' => '1234.56',
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
])

@errors($field->fieldName())
