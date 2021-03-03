{{--
@decimalField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    'value' => 'string: the field's value',
    'decimalPlaces' => 'int: number of decimal places to allow for this field',
    'placeholder' => 'string: example placeholder text',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
    'readonly' => 'boolean: whether the field is in read-only state',
    'fieldOnly' => 'boolean: whether the field should be wrapped in a div.form-group with label',
])
--}}
@unless($fieldOnly ?? false)
    <div class="form-group {{ ($required ?? false) ? 'required' : '' }}">
        <label for="{{ $name }}">{{ $label }}</label>
        @if ($details ?? false)
            <p>{!! nl2br(e($details)) !!}</p>
        @endif
@endunless
    <input type="text" data-decimal-places="{{ $decimalPlaces }}" class="decimal-field form-control {{ ($error ?? false) ? 'is-invalid' : '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '' }}" {{ ($autofocus ?? false) ? 'autofocus' : '' }} {{ ($required ?? false) ? 'required' : '' }} {{ ($readonly ?? false) ? 'readonly' : '' }}>
@unless($fieldOnly ?? false)

</div>
@endunless
