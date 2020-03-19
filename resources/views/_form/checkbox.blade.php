{{--
@checkboxField([
    'name' => 'string: form field name',
    'id' => 'string: html field id',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    'checked' => 'boolean: whether the field is checked',
    'value' => 'string|number: field value to submit as field value; defaults to 1',
    'required' => 'boolean: whether the field is required',
    'error' => 'boolean: whether the field is in error state',
])
--}}
<div class="checkbox-field {{ ($required ?? false) ? 'required' : '' }}">
    <div class="checkbox-container">
        <input type="checkbox" value="{{ $value ?? 1 }}" id="{{ $id }}" name="{{ $name }}" {{ ($checked ?? false) ? 'checked' : '' }} {{ ($required ?? false) ? 'required' : '' }}>
    </div>
    <div class="checkbox-label-container">
        <label for="{{ $id }}">{{ $label }}</label>
        @if ($details ?? false)
            <p>{{ $details }}</p>
        @endif
    </div>
</div>
