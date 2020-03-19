{{--
@moneyField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    'value' => 'string: the field's value',
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
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <span class="fas fa-dollar-sign"></span>
            </div>
        </div>
        <input type="tel" class="money-field form-control {{ ($error ?? false) ? 'is-invalid' : '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value ?? '' }}" {{ ($autofocus ?? false) ? 'autofocus' : '' }} {{ ($required ?? false) ? 'required' : '' }} {{ ($readonly ?? false) ? 'readonly' : '' }}>
    </div>
</div>
