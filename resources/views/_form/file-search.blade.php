{{--
@fileSearchField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'value' => "\App\File: the field's current value",
    'fileType' => '\App\FileType: the file type for the field',
    'placeholder' => 'string: example placeholder text',
    'description' => 'string: additional details describing this field',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
    'readonly' => 'boolean: whether the field is in read-only state',
    'fieldOnly' => 'boolean: whether the field should be wrapped in a div.form-group with label',
])
--}}
@unless($fieldOnly ?? false)
    <div class="form-group">
        <label for="{{ $name }}">{{ $label }}</label>
        @if ($description ?? false)
            <p>{{ $description }}</p>
        @endif
@endunless
    <div class="input-group {{ ($required ?? false) ? 'required' : '' }}">
        <div class="input-group-prepend" title="{{ ($fileType ?? false) ? $fileType->name : 'File Search' }}">
            <span class="input-group-text">
                {!! ($fileType ?? false) ? $fileType->icon() : \App\icon\files([]) !!}
            </span>
        </div>
        <select data-display="static" class="file-search show-tick form-control" id="{{ $name }}" name="{{ $name }}" title="{{ $placeholder }}" data-live-search="true" {{ ($required ?? false) ? 'required' : '' }} {{ ($readonly ?? false) ? 'disabled' : '' }} {{ ($autofocus ?? false) ? 'autofocus' : '' }} data-file-type-id="{{ ($fileType ?? false) ? $fileType->id : "" }}">
            @if ($value)
                <option value="{{ $value->id }}" selected data-content="{!! $value->icon(['mr-2']) !!}{{ $value->name }}">{{ $value->name }}</option>
            @endif
        </select>
    </div>
@unless($fieldOnly ?? false)
    </div>
@endunless
