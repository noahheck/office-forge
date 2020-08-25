<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12">

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

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.drives.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
