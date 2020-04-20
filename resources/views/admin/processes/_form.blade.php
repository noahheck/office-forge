<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @errors('name', 'active', 'file_type_id', 'teams', 'details')

    @hiddenField([
        'name' => 'return',
        'value' => url()->previous(),
    ])

    @checkboxSwitchField([
        'name' => 'active',
        'id' => 'process_active',
        'label' => __('process.active'),
        'checked' => $process->active,
        'value' => '1',
        'required' => false,
        'error' => $errors->has('active'),
    ])

    <hr>

    @textField([
        'name' => 'name',
        'label' => __('process.name'),
        'value' => old('name', $process->name),
        'placeholder' => __('process.nameExamples'),
        'required' => true,
        'autofocus' => true,
        'error' => $errors->has('name'),
    ])


    @fileTypeSelectField([
        'name' => 'file_type_id',
        'label' => __('process.fileType'),
        'value' => old('file_type_id', $process->file_type_id),
        'fileTypes' => $fileTypeOptions,
        'placeholder' => '',
        'description' => __('process.fileTypeDescription'),
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('file_type_id'),
    ])

    @teamMultiSelectField([
        'name' => 'teams',
        'label' => __('process.creatingTeams'),
        'values' => $process->creatingTeams,
        'multiple' => true,
        'teams' => $teamOptions,
        'placeholder' => 'Select teams',
        'description' => __('process.teamsDescription'),
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('teams'),
    ])

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

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.processes.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
