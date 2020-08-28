@push('scripts')
    @script('js/page.drives.files._form.js')
@endpush

<form action="{{ $action }}" method="POST" class="bold-labels" enctype="multipart/form-data">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @hiddenField([
        'name' => 'return',
        'value' => old('return', url()->previous()),
    ])

    @hiddenField([
        'name' => 'folder_id',
        'value' => $mediaFile->folder_id,
    ])

    <div class="row">

        <div class="col-12">

            @if ($folder = $mediaFile->folder)

                {!! \App\icon\folder(['mr-2']) !!}{{ $folder->name }}

                <hr>

            @endif

            @errors('file', 'name', 'description')

            @fileUploadField([
                'name' => 'file',
                'label' => __('fileStore.file'),
                'details' => '',
                'placeholder' => 'string: example placeholder text',
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('file'),
                'readonly' => false,
            ])

            @textField([
                'name' => 'name',
                'label' => __('fileStore.file_name'),
                'value' => old('name', $mediaFile->name),
                'placeholder' => __('fileStore.file_nameExamples'),
                'inputGroupAppendText' => __('fileStore.file_extensionExample'),
                'required' => true,
                'autofocus' => false,
                'error' => $errors->has('name'),
            ])

            @textareaField([
                'name' => 'description',
                'label' => __('fileStore.file_description'),
                'details' => '',
                'value' => old('description', $mediaFile->description),
                'placeholder' => __('fileStore.file_descriptionExamples'),
                'rows' => '3',
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('description'),
                'readonly' => false,
            ])

        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.drives.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
