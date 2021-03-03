{{--
@fileUploadField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'details' => 'string: additional text details to output alongside label',
    // 'value' => 'string: the field's value',
    'placeholder' => 'string: example placeholder text',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
    'fieldOnly' => 'boolean: whether the field should be wrapped in a div.form-group with label',
])
--}}
@unless($fieldOnly ?? false)
    <div class="form-group file-upload-group {{ ($required ?? false) ? 'required' : '' }}">
        <label for="{{ $name }}">{{ $label }}</label>
        @if ($details ?? false)
            <p>{!! nl2br(e($details)) !!}</p>
        @endif
        <div class="file-upload-image-preview-container" id="fileUploadImagePreviewContainer_{{ $name }}">
            <img id="fileUploadImagePreview_{{ $name }}" alt="" src="">
        </div>
@endunless
    <div class="custom-file">
        <input type="file" class="custom-file-input file-upload-field-input {{ ($error ?? false) ? 'is-invalid' : '' }}" id="{{ $name }}" name="{{ $name }}" required>
        <label class="custom-file-label" id="customFileLabel_{{ $name }}" for="{{ $name }}">{{ $label }}</label>
    </div>
@unless($fieldOnly ?? false)
    </div>
@endunless
