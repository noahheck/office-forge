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
                'label' => __('process.action_name'),
                'value' => old('name', $taskAction->name),
                'placeholder' => __('process.action_nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            @if ($showActive ?? false)

                <hr>

                @checkboxSwitchField([
                    'name' => 'active',
                    'id' => 'action_active',
                    'label' => __('process.action_active'),
                    'checked' => $taskAction->active,
                    'value' => '1',
                    'required' => false,
                    'error' => $errors->has('active'),
                ])

                <hr>

            @endif


            @textEditorField([
                'name' => 'details',
                'id' => 'action_details',
                'label' => __('process.action_details'),
                'required' => false,
                'value' => $taskAction->details,
                'placeholder' => __('process.action_detailsExamples'),
                'description' => __('process.action_detailsDescription'),
                'toolbar' => 'full',
                'resourceType' => get_class($taskAction),
                'resourceId' => $taskAction->id,
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
