{{--
@dateField([
    'name' => $field->fieldName(),
    'label' => $field->label,
    'details' => $field->description,
    'value' => old($field->fieldName(), $value->value_date),
    'placeholder' => $field->placeholder,
    'required' => false,
    'autofocus' => false,
    'error' => $errors->has($field->fieldName()),
    'readonly' => $readonly ?? false,
])

@errors($field->fieldName())
--}}

<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {{ ($preview ?? false) ? \App\misc_date() : $value->value_date }}
    </div>
</div>
