{{--
@textField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    'value' => 'string: the field's value',
    'placeholder' => 'string: example placeholder text',
    'inputGroupAppendText' => 'string: text for appended input group',
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
    @if ($inputGroupAppendText ?? false)
        <div class="input-group">
    @endif
        <input type="text" class="form-control {{ ($error ?? false) ? 'is-invalid' : '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '' }}" {{ ($autofocus ?? false) ? 'autofocus' : '' }} {{ ($required ?? false) ? 'required' : '' }} {{ ($readonly ?? false) ? 'readonly' : '' }}>

    @if ($inputGroupAppendText ?? false)
            <div class="input-group-append">
                <span class="input-group-text" id="inputGroupAppendedText_{{ $name }}">{{ $inputGroupAppendText }}</span>
            </div>
        </div>
    @endif
</div>
