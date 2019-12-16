<form class="bold-labels" method="POST" action="{{ $action }}">

    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @errors('title', 'due_date', 'completed', 'details')

    @textField([
        'name' => 'title',
        'label' => __('project.taskTitle'),
        'value' => old('title', $task->title),
        'placeholder' => __('project.taskTitleExample'),
        'required' => true,
        'autofocus' => true,
        'error' => $errors->has('title'),
    ])

    @dateField([
        'name' => 'due_date',
        'label' => __('project.taskDueDate'),
        'value' => old('due_date', App\format_date($task->due_date)),
        'placeholder' => '',
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('due_date'),
    ])

    @if ($showCompleted ?? false)

        <hr>

        @checkboxSwitchField([
            'name' => 'completed',
            'id' => 'task_' . $task->id . '_completed',
            'label' => __('project.taskCompleted'),
            'checked' => $task->completed,
            'value' => '1',
            'required' => false,
            'error' => $errors->has('completed'),
        ])

        <hr>

    @endif

    @userSelectField([
        'name' => 'assigned_to',
        'label' => 'Assigned to',
        'value' => $task->assigned_to,
        'users' => $users,
        'placeholder' => 'Assigned User',
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('assigned_to'),
    ])

    @textEditorField([
        'name' => 'details',
        'id' => 'details',
        'label' => __('project.taskDetails'),
        'required' => false,
        'value' => old('details', $task->details),
        'placeholder' => __('project.taskDetailsExample'),
        'toolbar' => 'full',
        'resourceType' => get_class($task),
        'resourceId' => $task->id,
    ])

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('projects.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
