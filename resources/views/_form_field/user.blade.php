@userSelectField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'value' => old($field->fieldName(), $value->value_user),
    'users' => $memberProvider->membersOfTeam($field->userTeam()),
    'placeholder' => $field->placeholder,
    'required' => false,
    'autofocus' => $autofocus ?? false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
])

@errors($field->fieldName())
