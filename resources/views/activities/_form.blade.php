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

    @errors('name', 'due_date', 'details', 'private')

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


    @userSelectField([
        'name' => 'owner_id',
        'label' => __('activity.owner'),
        'value' => $activity->owner_id,
        'users' => $users,
        'placeholder' => __('activity.owner'),
        'required' => true,
        'autofocus' => false,
        'error' => $errors->has('owner_id'),
    ])

    @unless ($activity->process_id)

        @checkboxSwitchField([
            'name' => 'private',
            'id' => 'activity_private',
            'label' => __('activity.private'),
            'details' => __('activity.privateDescription'),
            'checked' => old('private', $activity->private),
            'value' => '1',
            'required' => false,
            'error' => $errors->has('private'),
        ])

        <hr>

    @endunless

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

    <div class="d-flex">

        <div class="flex-grow-1">

            <button type="submit" class="btn btn-primary">
                {{ __('app.save') }}
            </button>

            <a class="btn btn-secondary" href="{{ url()->previous(route('activities.index')) }}">
                {{ __('app.cancel') }}
            </a>

        </div>

        @can('delete', $activity)

            <div>
                <button type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#moreOptionsContainer">
                    {{ __('app.moreOptions') }}
                    <span class="fas fa-chevron-down"></span>
                </button>
            </div>

        @endcan

    </div>

</form>

@can('delete', $activity)
    <div class="collapse text-right" id="moreOptionsContainer">

        <hr>

        <div class="dropdown">

            <button type="button" class="btn btn-outline-danger dropdown-toggle" data-toggle="dropdown" id="deleteTaskButton">
                <span class="far fa-trash-alt mr-1"></span>{{ __('activity.deleteActivity') }}
            </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="deleteTaskButton">
                <form action="{{ route("activities.destroy", [$activity]) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">
                        <span class="far fa-trash-alt"></span>
                        {{ __('activity.deleteActivityForGood') }}
                    </button>
                </form>
            </div>
        </div>

    </div>
@endcan
