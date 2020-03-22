@fileSelectField([
    'name' => $field->id,
    'label' => $field->label,
    'value' => (int) $value->value_file,
    'fileType' => $field->fileType,
    'files' => $field->fileType->files()->ordered()->get(),
    'placeholder' => $field->placeholder,
    'description' => $field->description,
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->id),
])
