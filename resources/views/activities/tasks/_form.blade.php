@push('scripts')
    @script('js/page.activities.tasks._form.js')
@endpush

<form class="bold-labels" method="POST" action="{{ $action }}">

    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @errors('title', 'due_date', 'completed', 'details')

    @textField([
        'name' => 'title',
        'label' => __('activity.taskTitle'),
        'value' => old('title', $task->title),
        'placeholder' => __('activity.taskTitleExample'),
        'required' => true,
        'autofocus' => true,
        'error' => $errors->has('title'),
    ])

    @dateField([
        'name' => 'due_date',
        'label' => __('activity.taskDueDate'),
        'value' => old('due_date', App\format_date($task->due_date)),
        'placeholder' => '',
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('due_date'),
    ])

    @userSelectField([
        'name' => 'assigned_to',
        'label' => __('activity.taskAssignedTo'),
        'value' => $task->assigned_to,
        'users' => $users,
        'placeholder' => __('activity.taskAssignedTo'),
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('assigned_to'),
    ])

    <button class="btn btn-sm mt-0 mb-3 btn-link" type="button" id="assignToMeButton">
        {{ __('activity.task_assignToMe') }}
    </button>

    @textEditorField([
        'name' => 'details',
        'id' => 'details',
        'label' => __('activity.taskDetails'),
        'required' => false,
        'value' => old('details', $task->details),
        'placeholder' => __('activity.taskDetailsExample'),
        'toolbar' => $toolbar ?? 'full',
        'resourceType' => get_class($task),
        'resourceId' => $task->id,
    ])

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('activities.index')) }}" id="taskFormCancelButton">
        {{ __('app.cancel') }}
    </a>

</form>
