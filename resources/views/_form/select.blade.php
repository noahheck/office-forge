{{--
@selectField([
    'name' => 'string: form field name',
    'id' => 'string: form field id attribute - defaults to name if not provided',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    'value' => 'string: the field's value',
    'options' => 'array: key => value mapping; key is value sent to server, value is shown to user',
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
    <select class="custom-select {{ ($error ?? false) ? 'is-invalid' : '' }}" id="{{ $id ?? $name }}" name="{{ $name }}" {{ ($readonly ?? false) ? 'readonly disabled' : '' }} {{ ($autofocus ?? false) ? 'autofocus' : '' }}>
        @if (!($required ?? false))
            <option value="">--</option>
        @endif
        @foreach ($options as $key => $option)
            @if (is_iterable($option))
                @if ($key)
                    <optgroup{!! ($key) ? ' label="' . e($key) . '"' : ''!!}>
                @endif

                @foreach ($option as $optKey => $optText)
                    <option value="{{ $optKey }}"{{ ($value === $optKey) ? " selected" : "" }}>{{ $optText }}</option>
                @endforeach

                @if ($key)
                    </optgroup>
                @endif
            @else
                <option value="{{ $key }}"{{ ($value === $key) ? " selected" : "" }}>{{ $option }}</option>
            @endif
        @endforeach
    </select>
@unless($fieldOnly ?? false)

</div>
@endunless
