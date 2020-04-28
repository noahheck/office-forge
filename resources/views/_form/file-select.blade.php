{{--
@fileSelectField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'value' => "int: the field's value",
    'fileType' => '\App\FileType: the file type for the field',
    'files' => 'collection: Collection of files to display in the field',
    'placeholder' => 'string: example placeholder text',
    'description' => 'string: additional details describing this field',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
    'readonly' => 'boolean: whether the field is in read-only state',
])
--}}
<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($description ?? false)
        <p>{{ $description }}</p>
    @endif
    <div class="input-group {{ ($required ?? false) ? 'required' : '' }}">
        <div class="input-group-prepend" title="{{ $fileType->name }}">
            <span class="input-group-text">
                {!! $fileType->icon() !!}
            </span>
        </div>
        <select class="selectpicker show-tick form-control" id="{{ $name }}" name="{{ $name }}" title="{{ $placeholder }}" data-live-search="true" {{ ($readonly ?? false) ? 'disabled' : '' }} {{ ($autofocus ?? false) ? 'autofocus' : '' }}>
            @if (!($required ?? false))
                <option value="">--</option>
            @endif
            @foreach ($files as $file)
                <option value="{{ $file->id }}" {{ ($value === $file->id) ? "selected" : "" }} data-content="{{ $file->name }}">{{ $file->name }}</option>
            @endforeach
        </select>
    </div>
</div>
