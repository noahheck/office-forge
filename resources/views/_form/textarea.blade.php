{{--
@textareaField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'value' => 'string: the field's value',
    'placeholder' => 'string: example placeholder text',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
])
--}}
<div class="form-group {{ ($required ?? false) ? 'required' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea rows="10" class="form-control {{ ($error ?? false) ? 'is-invalid' : '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" {{ ($autofocus ?? false) ? 'autofocus' : '' }} {{ ($required ?? false) ? 'required' : '' }}>{{ $value ?? '' }}</textarea>
{{--    <input type="text" class="form-control {{ ($error ?? false) ? 'is-invalid' : '' }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '' }}" {{ ($autofocus ?? false) ? 'autofocus' : '' }} {{ ($required ?? false) ? 'required' : '' }}>--}}
</div>
