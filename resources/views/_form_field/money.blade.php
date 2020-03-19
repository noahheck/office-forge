@moneyField([
    'name' => $field->id,
    'label' => $field->label,
    'details' => $field->description,
    'value' => number_format($value->value_decimal, 2, '.', ''),
    'placeholder' => '1234.56',
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->id),
    'readonly' => $readonly ?? false,
])
