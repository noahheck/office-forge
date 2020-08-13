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

    <div class="d-flex">

        <div class="flex-grow-1">

            <button type="submit" class="btn btn-primary">
                {{ __('app.save') }}
            </button>

            <a class="btn btn-secondary" href="{{ url()->previous(route('admin.processes.index')) }}">
                {{ __('app.cancel') }}
            </a>

        </div>

        @if($accessLock->id)
            <div>
                <button type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#moreOptionsContainer">
                    {{ __('app.moreOptions') }}
                    {!! \App\icon\chevronDown() !!}
                </button>
            </div>
        @endif

    </div>

</form>

@if ($accessLock->id)
    <div class="collapse text-right" id="moreOptionsContainer">

        <hr>

        <div class="dropdown">

            <button type="button" class="btn btn-outline-danger dropdown-toggle" data-toggle="dropdown" id="deleteAccessLockButton">
                {!! \App\icon\trash(['mr-1']) !!}{{ __('admin.deleteAccessLock') }}
            </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="deleteTaskButton">
                <form action="{{ route('admin.file-types.access-locks.destroy', [$fileType, $accessLock]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @hiddenField([
                        'name' => 'return',
                        'value' => old('return', url()->previous()),
                    ])
                    <button type="submit" class="dropdown-item text-danger">
                        {!! \App\icon\trash() !!}
                        {{ __('admin.deleteAccessLockForGood') }}
                    </button>
                </form>
            </div>
        </div>

    </div>
@endif
