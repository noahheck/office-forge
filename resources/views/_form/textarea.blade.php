{{--
@textareaField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    'value' => 'string: the field's value',
    'placeholder' => 'string: example placeholder text',
    'rows' => 'int: number of rows tall to display the field',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
    'readonly' => 'boolean: whether the field is in read-only state',
])
--}}
<div class="form-group {{ ($required ?? false) ? 'required' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($details ?? false)
        - {{ $details }}
    @endif
    <textarea rows="{{ $rows ?? 10 }}" class="form-control {{ ($error ?? false) ? 'is-invalid' : '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" {{ ($autofocus ?? false) ? 'autofocus' : '' }} {{ ($required ?? false) ? 'required' : '' }} {{ ($readonly ?? false) ? 'readonly' : '' }}>{{ $value ?? '' }}</textarea>
</div>
