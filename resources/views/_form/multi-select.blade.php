{{--
@multiSelectField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'values' => 'collection: the field's value',
    'options' => 'collection: collection of key=>value options to display in the field',
    'placeholder' => 'string: example placeholder text',
    'description' => 'string: additional details describing this field',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
    'fieldOnly' => 'boolean: whether the field should be wrapped in a div.form-group with label',
])
--}}
@unless($fieldOnly ?? false)
    <div class="form-group {{ ($required ?? false) ? 'required' : '' }}">
        @if ($label)
            <label for="{{ $name }}">{{ $label }}</label>
        @endif
        @if ($description ?? false)
            <p>{{ $description }}</p>
        @endif
@endunless
    <select class="selectpicker show-tick form-control" id="{{ $name }}" name="{{ $name }}[]" title="{{ $placeholder }}" data-live-search="true" {{ ($readonly ?? false) ? 'disabled' : '' }} {{ ($autofocus ?? false) ? 'autofocus' : '' }} data-display="static" multiple>
        @foreach ($options as $key => $option)
            @if(is_array($option))
                <optgroup{!! ($key) ? ' label="' . e($key) . '"' : "" !!}>
                    @foreach($option as $optKey => $optText)
                        <option value="{{ $optKey }}"{{ ($values->contains($optKey)) ? " selected" : "" }}>{{ $optText }}</option>
                    @endforeach
                </optgroup>
            @else
                <option value="{{ $key }}"{{ ($values->contains($key)) ? " selected" : "" }}>{{ $option }}</option>
            @endif
        @endforeach
    </select>
@unless($fieldOnly ?? false)
    </div>
@endunless
