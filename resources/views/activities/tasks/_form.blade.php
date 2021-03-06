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

    <div class="d-flex">

        <div class="flex-grow-1">

            <button type="submit" class="btn btn-primary">
                {{ __('app.save') }}
            </button>

            <a class="btn btn-secondary" href="{{ url()->previous(route('activities.index')) }}" id="taskFormCancelButton">
                {{ __('app.cancel') }}
            </a>

        </div>

        @can('delete', $task)

            <div>
                <button type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#moreOptionsContainer">
                    {{ __('app.moreOptions') }}
                    {!! \App\icon\chevronDown() !!}
                </button>
            </div>

        @endcan
    </div>

</form>

@can('delete', $task)
    <div class="collapse text-right" id="moreOptionsContainer">

        <hr>

        <form action="{{ route("activities.tasks.destroy", [$activity, $task]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $task->title }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                {!! \App\icon\trash() !!}
                {{ __('activity.deleteTask') }}
            </button>
        </form>

    </div>
@endcan
