<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12">

            @errors('name', 'details')

            @hiddenField([
                'name' => 'return',
                'value' => old('return', url()->previous()),
            ])

            @textField([
                'name' => 'name',
                'label' => __('file.accessLock_name'),
                'value' => old('name', $accessLock->name),
                'placeholder' => __('file.accessLock_nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            @textareaField([
                'name' => 'details',
                'label' => __('file.accessLock_details'),
                'details' => __('file.accessLock_detailsDescription'),
                'value' => old('details', $accessLock->details),
                'placeholder' => '',
                'rows' => '3',
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('details'),
                'readonly' => false,
            ])

        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.processes.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
