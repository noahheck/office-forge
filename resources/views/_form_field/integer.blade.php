@integerField([
    'name' => $field->id,
    'label' => $field->label,
    'details' => $field->description,
    'value' => $value->value_integer,
    'placeholder' => '123',
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->id),
    'readonly' => $readonly ?? false,
])
