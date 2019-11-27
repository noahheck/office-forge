<form class="bold-labels" method="POST" action="{{ $action }}">

    @errors('name')

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

</form>
