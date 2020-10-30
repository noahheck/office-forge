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

            @if ($upload)

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

            @endif

            @textField([
                'name' => 'name',
                'label' => __('fileStore.file_name'),
                'value' => old('name', $mediaFile->nameWithoutExtension),
                'placeholder' => __('fileStore.file_nameExamples'),
                'inputGroupAppendText' => $mediaFile->extension ?? __('fileStore.file_extensionExample'),
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

    <div class="d-flex">

        <div class="flex-grow-1">

            <button type="submit" class="btn btn-primary">
                {{ __('app.save') }}
            </button>

            <a class="btn btn-secondary" href="{{ url()->previous(route('admin.drives.index')) }}">
                {{ __('app.cancel') }}
            </a>

        </div>

        @if($mediaFile->id && $moreOptions)
            @can('update', $mediaFile)
                <div>
                    <button type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#moreOptionsContainer">
                        {{ __('app.moreOptions') }}
                        {!! \App\icon\chevronDown() !!}
                    </button>
                </div>
            @endcan
        @endif

    </div>

</form>


@if ($mediaFile->id)
    @can('update', $mediaFile)

        <div class="collapse" id="moreOptionsContainer">

            <hr>

            <div class="d-flex">

                <div class="flex-grow-1">
                    <a class="btn btn-primary" href="{{ route('files.drives.mediaFiles.new-version', [$file, $drive, $mediaFile]) }}">
                        {{ __('fileStore.file_uploadNewVersion') }}
                    </a>
                </div>

                <div class="flex-grow-0">
                    <form class="confirm-delete-form" data-delete-item-title="{{ $mediaFile->name }}" action="{{ route('files.drives.mediaFiles.destroy', [$file, $drive, $mediaFile]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            {!! \App\icon\trash(['mr-2']) !!}{{ __('fileStore.deleteFile') }}
                        </button>
                    </form>
                </div>

            </div>

        </div>

    @endcan
@endif
