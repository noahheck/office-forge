{{--
@selectField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    'value' => 'string: the field's value',
    'options' => 'array: key => value mapping; key is value sent to server, value is shown to user',
    'placeholder' => 'string: example placeholder text',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
])
--}}
<div class="form-group {{ ($required ?? false) ? 'required' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($details ?? false)
        - {{ $details }}
    @endif
    <select class="custom-select" id="{{ $name }}" name="{{ $name }}">
        @if (!($required ?? false))
            <option value="">--</option>
        @endif
        @foreach ($options as $key => $text)
            <option value="{{ $key }}"{{ ($value === $key) ? " selected" : "" }}>{{ $text }}</option>
        @endforeach
    </select>
</div>
