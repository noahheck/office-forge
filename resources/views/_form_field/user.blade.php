@userSelectField([
    'name' => $field->id,
    'label' => $field->label,
    'value' => $value->value_user,
    'users' => $memberProvider->membersOfTeam($field->userTeam()),
    'placeholder' => $field->placeholder,
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->id),
    'readonly' => $readonly ?? false,
])
