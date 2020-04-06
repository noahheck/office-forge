<form class="bold-labels" method="POST" action="{{ $action }}">

    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @if ($activity->file_id)

        <div class="d-flex align-items-center">

            {!! $file->icon(['mhw-35p mr-2', 'flex-grow-0']) !!}
            <h4 class="flex-grow-1 mb-0">{{ $file->name }}</h4>

        </div>

        <hr>

        @hiddenField([
            'name' => 'file_id',
            'value' => $activity->file_id,
        ])

    @endif

    @if ($activity->process_id)
        @hiddenField([
            'name' => 'process_id',
            'value' => $activity->process_id,
        ])
    @endif

    @errors('name', 'due_date', 'completed', 'details')

    @textField([
        'name' => 'name',
        'label' => __('activity.name'),
        'value' => old('name', $activity->name),
        'placeholder' => __('activity.nameExample'),
        'required' => true,
        'autofocus' => true,
        'error' => $errors->has('name'),
    ])

    @dateField([
        'name' => 'due_date',
        'label' => __('activity.dueDate'),
        'value' => old('due_date', App\format_date($activity->due_date)),
        'placeholder' => '',
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('due_date'),
    ])

    @if ($showCompleted ?? false)

        <hr>

        @checkboxSwitchField([
            'name' => 'completed',
            'id' => 'activity_' . $activity->id . '_completed',
            'label' => __('activity.completed'),
            'checked' => $activity->completed,
            'value' => '1',
            'required' => false,
            'error' => $errors->has('completed'),
        ])

        <hr>

    @endif

    @userSelectField([
        'name' => 'owner_id',
        'label' => __('activity.owner'),
        'value' => $activity->owner_id,
        'users' => $users,
        'placeholder' => __('activity.owner'),
        'required' => false,
        'autofocus' => false,
        'error' => $errors->has('owner_id'),
    ])

    @textEditorField([
        'name' => 'details',
        'id' => 'details',
        'label' => __('activity.details'),
        'required' => false,
        'value' => old('details', $activity->details),
        'placeholder' => __('activity.detailsExample'),
        'toolbar' => 'full',
        'resourceType' => get_class($activity),
        'resourceId' => $activity->id,
    ])

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('activities.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
