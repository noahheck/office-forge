@decimalField([
    'name' => $field->id,
    'label' => $field->label,
    'details' => $field->description,
    'value' => number_format($value->value_decimal, $field->decimalPlaces(), '.', ''),
    'decimalPlaces' => $field->decimalPlaces(),
    'placeholder' => '123',
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->id),
    'readonly' => $readonly ?? false,
])
