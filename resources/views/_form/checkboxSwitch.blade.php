{{--
@checkboxSwitchField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'checked' => 'boolean: whether the field is checked',
    'required' => 'boolean: whether the field is required',
    'error' => 'boolean: whether the field is in error state',
])
--}}
<div class="custom-control custom-switch {{ ($required ?? false) ? 'required' : '' }}">
    <input type="checkbox" class="custom-control-input" value="1" id="{{ $name }}" name="{{ $name }}" {{ ($checked ?? false) ? 'checked' : '' }} {{ ($required ?? false) ? 'required' : '' }}>
    <label class="custom-control-label" for="{{ $name }}">{{ $label }}</label>
    @if ($details ?? false)
        <p>{{ $details }}</p>
    @endif
</div>
