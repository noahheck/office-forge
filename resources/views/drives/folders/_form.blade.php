<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @hiddenField([
        'name' => 'parent_folder_id',
        'value' => $folder->parent_folder_id,
    ])

    <div class="row">

        <div class="col-12">

            @if ($parent = $folder->parentFolder)

                {!! \App\icon\folder(['mr-2']) !!}{{ __('fileStore.folder_childFolderOf', ['parent' => $parent->name]) }}

                <hr>

            @endif

            @errors('name', 'description')

            @textField([
                'name' => 'name',
                'label' => __('fileStore.folder_name'),
                'value' => old('name', $folder->name),
                'placeholder' => __('fileStore.folder_nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            @textareaField([
                'name' => 'description',
                'label' => __('fileStore.folder_description'),
                'details' => '',
                'value' => old('description', $folder->description),
                'placeholder' => __('fileStore.folder_descriptionExamples'),
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


        @if ($folder->id)
            @can('delete', $folder)
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


@if ($folder->id)
    @can('delete', $folder)

        <div class="collapse text-right" id="moreOptionsContainer">

            <hr>

            <form class="confirm-delete-form" data-delete-item-title="{{ $folder->name }}" action="{{ route('drives.folders.destroy', [$drive, $folder]) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    {!! \App\icon\trash(['mr-2']) !!}{{ __('fileStore.deleteFolder') }}
                </button>
            </form>

        </div>

    @endcan
@endif
