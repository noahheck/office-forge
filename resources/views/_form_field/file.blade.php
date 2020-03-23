@fileSelectField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'value' => old($field->fieldName(), (int) $value->value_file),
    'fileType' => $field->fileType,
    'files' => $field->fileType->files()->ordered()->get(),
    'placeholder' => $field->placeholder,
    'description' => $field->description,
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->fieldName()),
])

@errors($field->fieldName())
