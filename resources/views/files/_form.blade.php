@push('scripts')
    @script('js/page.files._form.js')
@endpush

<form class="bold-labels file-form" method="POST" action="{{ $action }}" enctype="multipart/form-data" >

    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @hiddenField([
        'name' => 'file_type_id',
        'value' => $file->file_type_id,
    ])

    <div class="text-center mb-3">

        <div class="file-type-thumbnail-container">
            {!! $file->thumbnail(["upload-preview"]) !!}
        </div>

        @errors('new_file_photo')

        <div class="custom-file">
            <input type="file" class="custom-file-input" id="new_file_photo" name="new_file_photo">
            <label class="custom-file-label" for="new_file_photo">{{ __('settings.photo_selectPhoto') }}</label>
        </div>

    </div>

    @errors('name')

    @textField([
        'name' => 'name',
        'label' => __('file.name'),
        'value' => old('name', $file->name),
        'placeholder' => '',
        'required' => true,
        'autofocus' => true,
        'error' => $errors->has('name'),
    ])

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('files.index', ['file_type' => $fileType->id])) }}">
        {{ __('app.cancel') }}
    </a>

</form>
