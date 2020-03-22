{{--
@fileTypeSelectField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'value' => "int: the field's value",
    'fileTypes' => 'collection: Collection of fileTypes to display in the field',
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
    <select class="selectpicker show-tick form-control" id="{{ $name }}" name="{{ $name }}" title="{{ $placeholder }}" data-live-search="true">
        @if (!($required ?? false))
            <option value="">--</option>
        @endif
        @foreach ($fileTypes as $fileType)
            <option value="{{ $fileType->id }}" {{ ($value === $fileType->id) ? "selected" : "" }} data-content="{!! $fileType->icon() !!} {{ $fileType->name }}">{{ $fileType->name }}</option>
        @endforeach
    </select>
</div>
