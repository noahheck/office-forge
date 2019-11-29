<form class="bold-labels" method="POST" action="{{ $action }}">

    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @errors('name', 'due_date', 'details')

    @textField([
        'name' => 'name',
        'label' => __('project.name'),
        'value' => old('name', $project->name),
        'placeholder' => __('project.nameExample'),
        'required' => true,
        'autofocus' => true,
        'error' => $errors->has('name'),
    ])

    @dateField([
        'name' => 'due_date',
        'label' => __('project.dueDate'),
        'value' => old('due_date', App\format_date($project->due_date)),
        'placeholder' => '',
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('due_date'),
    ])

    {{--@textareaField([
        'name' => 'details',
        'label' => __('project.details'),
        'value' => old('details', $project->details),
        'placeholder' => __('project.detailsExample'),
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('details'),
    ])--}}

    @textEditorField([
        'name' => 'details',
        'id' => 'details',
        'label' => __('project.details'),
        'required' => false,
        'value' => old('details', $project->details),
        'placeholder' => __('project.detailsExample'),
        'toolbar' => 'full',
        'resourceType' => get_class($project),
        'resourceId' => $project->id,
    ])

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('projects.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
