{{--
@radioGroupField([
    'name' => 'string: form field name',
    'id' => 'string: html field id',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    'checked' => 'boolean: whether the field is checked',
    'value' => 'string|number: field value to submit as field value; defaults to 1',
    'required' => 'boolean: whether the field is required',
    'error' => 'boolean: whether the field is in error state',
])

@radioGroupField([
    'name' => 'string: form field name',
    'label' => 'string: text label for group',
    'value' => 'the field's value',
    'options' => 'array: [value=>['label' => '', 'description' => '']] options to display in the field',
    'description' => 'string: additional details describing this field',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
])
--}}
<p>
    <strong>{{ $label }}</strong>
    @if ($description)
        <br>{{ $description }}
    @endif
</p>

<div class="list-group of-radio-group">

    @foreach ($options as $optValue => $details)

    <label class="list-group-item list-group-item-action" for="{{ $name }}_{{ $optValue }}">
        <div class="flex-grow-0 mr-2">
            <input type="radio" name="{{ $name }}" id="{{ $name }}_{{ $optValue }}" value="{{ $optValue }}" {{ $optValue === $value ? 'checked' : '' }}>
        </div>
        <div class="flex-grow-1">
            <strong>{{ $details['label'] }}</strong>
            @if($details['description'])
                - {{ $details['description'] }}
                @endif
        </div>
    </label>
    @endforeach
</div>

