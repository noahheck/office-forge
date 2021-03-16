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
    <div class="form-group numeric-form-group {{ ($required ?? false) ? 'required' : '' }}">
        <div class="d-flex">
            <div class="flex-grow-1">
                <label for="{{ $name }}">{{ $label }}</label>
            </div>
            <div class="flex-grow-0 field-container">
@endunless
    <input type="text" data-decimal-places="{{ $decimalPlaces }}" class="decimal-field form-control {{ ($error ?? false) ? 'is-invalid' : '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '' }}" {{ ($autofocus ?? false) ? 'autofocus' : '' }} {{ ($required ?? false) ? 'required' : '' }} {{ ($readonly ?? false) ? 'readonly' : '' }}>
@unless($fieldOnly ?? false)
            </div>
        </div>

        @if ($details ?? false)
            <p>{!! nl2br(e($details)) !!}</p>
        @endif

</div>
@endunless
