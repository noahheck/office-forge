@push('scripts')
    @script('js/page.activities._tasklist.js')
@endpush

<div class="project--task-list current-tasks list-group" id="activityOpenTasks">
    @forelse ($activity->openTasks as $task)

        @include("activities._task")

    @empty

        <p class="text-muted">
            <em>{{ __('activity.noActiveTasks') }}</em>
        </p>

    @endforelse
</div>

@if (!$activity->completed)
    @can('create', [\App\Activity\Task::class, $activity])

        <div class="collapse no-print" id="newTaskContainer">

            <div class="row justify-content-center">

                <div class="col-10 border p-3 m-2 mb-4 shadow" style="font-size: .8rem;">

                    <h4><span class="far fa-check-square mr-1"></span>{{ __('activity.newTask') }}</h4>

                    <hr>

                    @include ('activities.tasks._form', [
                        'task' => $newTask,
                        'users' => $taskUserOptions,
                        'action' => route('activities.tasks.store', [$activity]),
                    ])

                </div>
            </div>

        </div>

        <p class="no-print collapse show" id="newTaskShowButtonContainer">
            <a id="newTaskContainerToggleButton" class="btn btn-sm btn-primary" href="{{ route('activities.tasks.create', [$activity]) }}" data-toggle="collapse" data-target="#newTaskContainer, #newTaskShowButtonContainer">
                <span class="fas fa-plus-circle"></span> {{ __('activity.addTask') }}
            </a>
        </p>

    @else

        <p class="no-print">
            <button class="btn btn-sm btn-secondary disabled" data-trigger="hover focus" data-toggle="popover" data-content="{{ __('activity.onlyOwnerAndParticipantsCanEditTasks') }}">
                <span class="fas fa-plus-circle"></span> {{ __('activity.addTask') }}
            </button>
            <span class="sr-only">{{ __('activity.onlyOwnerAndParticipantsCanEditTasks') }}</span>
        </p>
    @endcan
@endif

<div class="list-group project--task-list completed-tasks">
    @foreach ($activity->completedTasks as $task)

        @if ($loop->first)
            <h5 class="separator"><span>{{ __('activity.completedTasks') }}</span></h5>
        @endif

        @include("activities._task")

    @endforeach
</div>
