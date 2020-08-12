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
])
--}}
<div class="form-group {{ ($required ?? false) ? 'required' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($description ?? false)
        <p>{{ $description }}</p>
    @endif
    <select class="selectpicker show-tick form-control" id="{{ $name }}" name="{{ $name }}[]" title="{{ $placeholder }}" data-live-search="true" {{ ($readonly ?? false) ? 'disabled' : '' }} {{ ($autofocus ?? false) ? 'autofocus' : '' }} multiple>
        @foreach ($options as $key => $option)
            <option value="{{ $key }}"{{ ($values->contains($key)) ? " selected" : "" }}>{{ $option }}</option>
        @endforeach
    </select>
</div>
