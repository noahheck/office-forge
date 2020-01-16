<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12">

            @errors('name', 'active', 'details')

            @textField([
                'name' => 'name',
                'label' => __('process.task_name'),
                'value' => old('name', $task->name),
                'placeholder' => __('process.task_nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            @if ($showActive ?? false)

                <hr>

                @checkboxSwitchField([
                    'name' => 'active',
                    'id' => 'task_active',
                    'label' => __('process.task_active'),
                    'checked' => $task->active,
                    'value' => '1',
                    'required' => false,
                    'error' => $errors->has('active'),
                ])

                <hr>

            @endif


            @textEditorField([
                'name' => 'details',
                'id' => 'task_details',
                'label' => __('process.task_details'),
                'required' => false,
                'value' => $task->details,
                'placeholder' => __('process.task_detailsExamples'),
                'description' => __('process.task_detailsDescription') . ' ' . __('admin.task_description'),
                'toolbar' => 'full',
                'resourceType' => get_class($task),
                'resourceId' => $task->id,
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
