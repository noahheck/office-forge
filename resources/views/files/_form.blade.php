<form class="bold-labels file-form" method="POST" action="{{ $action }}">

    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @hiddenField([
        'name' => 'file_type_id',
        'value' => $file->file_type_id,
    ])

    <div class="text-center">

        <div class="file-type-icon-container">
            {!! $fileType->icon(['file-type-icon']) !!}
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

    <a class="btn btn-secondary" href="{{ url()->previous(route('projects.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
