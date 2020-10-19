@fileSearchField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'value' => $value->valueFile,
    'fileType' => $field->fileType,
    'placeholder' => $field->placeholder ?? __("app.searchItems", ['itemName' => Str::plural($field->fileType->name)]),
    'description' => $field->description,
    'required' => false,
    'autofocus' => $autofocus ?? false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
    'fieldOnly' => false,
])

@errors($field->fieldName())
