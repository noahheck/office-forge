<form class="bold-labels" method="POST" action="{{ $action }}">

    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @hiddenField([
        'name' => 'process_id',
        'value' => $instance->process_id,
    ])

    <div class="editor-content">
        {!! App\safe_text_editor_content($instance->process_details) !!}
    </div>

    <hr>

    @errors('name', 'completed', 'details')

    @textField([
        'name' => 'name',
        'label' => __('process.name'),
        'value' => old('name', $instance->name),
        'placeholder' => '',
        'required' => true,
        'autofocus' => true,
        'error' => $errors->has('name'),
    ])

    {{--@dateField([
        'name' => 'due_date',
        'label' => __('project.dueDate'),
        'value' => old('due_date', App\format_date($project->due_date)),
        'placeholder' => '',
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('due_date'),
    ])--}}

    @if ($showCompleted ?? false)

        <hr>

        @checkboxSwitchField([
            'name' => 'completed',
            'id' => 'instance_' . $instance->id . '_completed',
            'label' => __('process.instance_completed'),
            'checked' => $instance->completed,
            'value' => '1',
            'required' => false,
            'error' => $errors->has('completed'),
        ])

        <hr>

    @endif

    @userSelectField([
        'name' => 'owner_id',
        'label' => __('process.instance_owner'),
        'value' => $instance->owner_id,
        'users' => $ownerOptions,
        'placeholder' => __('process.instance_owner'),
        'required' => true,
        'autofocus' => false,
        'error' => $errors->has('owner_id'),
    ])

    @textEditorField([
        'name' => 'details',
        'id' => 'details',
        'label' => __('process.details'),
        'required' => false,
        'value' => old('details', $instance->details),
        'placeholder' => __('process.detailsExamples'),
        'toolbar' => 'full',
        'resourceType' => get_class($instance),
        'resourceId' => $instance->id,
    ])

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('projects.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
