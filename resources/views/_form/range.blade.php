{{--
@rangeField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    'value' => 'string: the field's value',
    'min' => 'int: lowest selectable value - default 0',
    'max' => 'int: highest selectable value - default 10',
    'min_label' => 'string: label to use for low end of range',
    'max_label' => 'string: label to use for high end of range',
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
            - {{ $details }}
        @endif
        <div class="d-flex">
            <div class="flex-grow-1 d-flex flex-column align-items-center">
                @if(($min_label ?? false) || ($max_label ?? false))
                    <div class="d-flex w-100 range-field-labels">
                        <div class="flex-grow-1">
                            {{ $min_label ?? '' }}
                        </div>
                        <div class="flex-grow-0">
                            {{ $max_label ?? '' }}
                        </div>
                    </div>
                @endif
@endunless
                <input type="range" class="custom-range range-field {{ ($error ?? false) ? 'is-invalid' : '' }}" min="{{ $min ?? '0' }}" max="{{ $max ?? '10' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '0' }}" {{ ($autofocus ?? false) ? 'autofocus' : '' }} {{ ($required ?? false) ? 'required' : '' }} {{ ($readonly ?? false) ? 'readonly' : '' }}>
@unless($fieldOnly ?? false)
            </div>
            <div class="flex-grow-0">
                <div class="range-field-display" id="{{ $name }}_display">
                    {{ $value ?? '0' }}
                </div>
            </div>
        </div>
    </div>
@endunless
