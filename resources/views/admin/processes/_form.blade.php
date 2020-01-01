<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12 col-md-9 order-2 order-md-1">

            @errors('name')

            @textField([
                'name' => 'name',
                'label' => __('process.name'),
                'value' => old('name', $process->name),
                'placeholder' => __('process.nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

        </div>

        <div class="col-12 col-md-3 order-1 order-md-2">

            @checkboxSwitchField([
                'name' => 'active',
                'id' => 'process_active',
                'label' => __('process.active'),
                'checked' => $process->active,
                'value' => '1',
                'required' => false,
                'error' => $errors->has('active'),
            ])

        </div>

    </div>

    <div class="row">

        <div class="col-12 col-md-9">

            @textEditorField([
                'name' => 'details',
                'id' => 'process_details',
                'label' => __('process.details'),
                'required' => false,
                'value' => $process->details,
                'placeholder' => __('process.detailsExamples'),
                'description' => __('process.detailsDescription'),
                'toolbar' => 'full',
                'resourceType' => get_class($process),
                'resourceId' => $process->id,
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
