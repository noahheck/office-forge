@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Show($activity))
])

@section('content')

    <div class="row project {{ ($activity->isOverdue()) ? 'overdue' : '' }} justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">
            <div class="card shadow document">
                <div class="card-body">

                    <div class="border-bottom mb-3">

                        <h1 class="h3">
                            @if ($activity->process_id)
                                <span class="fas fa-clipboard-list"></span> {{ $activity->process_name }} - {{ $activity->name }}
                            @else
                                <span class="fas fa-project-diagram"></span> {{ $activity->name }}
                            @endif
                            <small class="text-muted">#{{ $activity->id }}</small>
                        </h1>

                        @if ($file ?? false)
                            <div class="d-flex align-items-center mb-2">
                                {!! $file->icon(['mhw-35p', 'mr-3', 'ml-2']) !!}
                                <h5 class="mb-0"><a href="{{ route("files.show", [$file]) }}">{{ $file->name }}</a></h5>
                            </div>
                        @endif

                    </div>
                    <div class="row">

                        <div class="col-12">

                            <div class="d-flex align-items-center">

                                @can('update', $activity)

                                    <div class="flex-grow-1">

                                        @if ($activity->completed)
                                            <span class="project--completed-indicator">
                                                <span class="fas fa-check-circle"></span> {{ __('activity.completed') }}
                                            </span>
                                        @else
                                            <form action="{{ route('activities.complete', [$activity]) }}" method="POST" class="no-print">
                                                @csrf
                                                <button type="submit" class="btn btn-light">
                                                    <span class="far fa-square fa-lg"></span>
                                                    {{ __('activity.complete') }}
                                                </button>
                                            </form>
                                        @endif

                                    </div>

                                    <div>

                                        @if ($activity->completed)
                                            <form action="{{ route('activities.uncomplete', [$activity]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-light btn-sm no-print">
                                                    <span class="fas fa-undo"></span>
                                                    {{ __('activity.reopen') }}
                                                </button>
                                            </form>
                                        @else
                                            <a class="btn btn-primary btn-sm no-print" href="{{ route('activities.edit', [$activity]) }}">
                                                <span class="fas fa-edit"></span> {{ __('activity.editActivity') }}
                                            </a>
                                        @endif

                                    </div>

                                @else
                                    <div class="flex-grow-1">
                                        @if ($activity->completed)
                                            <span class="project--completed-indicator">
                                                <span class="fas fa-check-circle"></span> {{ __('activity.completed') }}
                                            </span>
                                        @else
                                            &nbsp;
                                        @endif
                                    </div>
                                    <div>
                                        <button class="btn btn-secondary disabled btn-sm" data-trigger="hover focus" data-toggle="popover" data-content="{{ __('activity.onlyActivityOwnerCanEdit') }}">
                                            <span class="fas fa-edit"></span> {{ __('activity.editActivity') }}
                                        </button>
                                        <span class="sr-only">{{ __('activity.onlyActivityOwnerCanEdit') }}</span>
                                    </div>
                                @endcan
                            </div>

                            <hr class="hide-if-overdue">

                            @if ($activity->private)
                                <p class="text-muted">
                                    <span class="fas fa-user-shield"></span>
                                    {{ __('activity.thisActivityPrivateVisibility') }}
                                </p>

                                <hr class="hide-if-overdue">
                            @endif

                            <dl class="row project-details">
                                <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.owner') }}</dt>
                                <dd class="col-12 col-sm-9 col-xl-10">
                                    {!! $activity->owner->iconAndName() !!}
                                    <hr>
                                </dd>

                                <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.dueDate') }}</dt>
                                <dd class="col-12 col-sm-9 col-xl-10 project--due-date">
                                    {{ App\format_date($activity->due_date) }}
                                    <hr>
                                </dd>

                                <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">
                                    <a href="{{ $participantRoute }}">{{ __('activity.participants') }}</a>
                                </dt>
                                <dd class="col-12 col-sm-9 col-xl-10">
                                    @forelse ($activity->participants as $participant)
                                        {!! $participant->user->icon() !!}
                                        <span class="sr-only">{{ $participant->user->name }}</span>
                                    @empty
                                        <em class="text-muted">{{ __('activity.noParticipants') }}</em>
                                    @endforelse
                                </dd>

                            </dl>

                            <hr class="hide-if-overdue">

                            @if ($activity->process_id && $activity->process_details)
                                <div class="editor-content">
                                    {!! App\safe_text_editor_content($activity->process_details) !!}
                                </div>

                                <hr>

                            @endif


                            @if ($activity->details)
                                <div class="editor-content">
                                    {!! App\safe_text_editor_content($activity->details) !!}
                                </div>
                            @else
                                <p class="text-muted">
                                    <em>{{ __('activity.noDetails') }}</em>
                                </p>
                            @endif




                            <h4 class="separator">
                                <span><span class="fas fa-tasks"></span> Tasks</span>
                            </h4>

                            <div class="project--task-list current-tasks list-group">
                                @forelse ($activity->tasks->where('completed', false) as $task)

                                    <div class="list-group-item p-0 task @if(!$activity->completed && $task->isDueToday()) due-today @elseif(!$activity->completed && $task->isOverdue()) overdue @endif">

                                        <div class="d-flex p-1 align-items-center task-header">

                                            <div class="pr-sm-1">
                                                @can('update', $task)
                                                    <form action="{{ route('activities.tasks.complete', [$activity, $task]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-light" data-toggle="tooltip" data-delay='{"show":300}' data-placement="bottom" title="{{ __('activity.completeTask') }}">
                                                            <span class="far fa-square fa-lg"></span>
                                                            <span class="sr-only">{{ __('activity.completeTask') }}</span>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>

                                            <a class="flex-grow-1 pl-2" data-toggle="collapse" data-target="#task_content_{{ $task->id }}" href="{{ route('activities.tasks.show', [$activity, $task]) }}">
                                                <span class="task-title">{{ $task->title }}</span>

                                                <div class="task-attributes">
                                                    @if ($task->assigned_to)
                                                        {!! $task->assignedTo->icon() !!}
                                                    @endif
                                                    @if ($task->details)
                                                        <span class="fas fa-align-left"></span>
                                                    @endif
                                                    @if ($task->due_date)
                                                        <span class="project--task--due-date"><span class="far fa-calendar-alt calendar-icon"></span> {{ App\format_date($task->due_date) }}</span>
                                                    @endif
                                                </div>

                                            </a>

                                        </div>

                                        <div class="collapse" id="task_content_{{ $task->id }}">

                                            <div class="p-1 pt-2 mt-1 ml-5 border-top pb-3">

                                                <dl class="row">
                                                    <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.taskAssigned') }}</dt>
                                                    <dd class="col-12 col-sm-9 col-xl-10">
                                                        @if ($task->assigned_to)
                                                            {!! $task->assignedTo->iconAndName() !!}
                                                        @endif
                                                    </dd>

                                                    <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.taskDueDate') }}</dt>
                                                    <dd class="col-12 col-sm-9 col-xl-10 task--due-date due-date">{{ App\format_date($task->due_date) }}</dd>

                                                </dl>

                                                <hr>

                                                @if ($task->details)
                                                    <div class="editor-content pr-2">
                                                        {!! \App\safe_text_editor_content($task->details) !!}
                                                    </div>
                                                @else
                                                    <em>{{ __('activity.noDetails') }}</em>
                                                @endif

                                                <hr class="no-print">

                                                <div class="d-flex no-print">

                                                    <div class="flex-grow-1">
                                                        <a href="{{ route('activities.tasks.show', [$activity, $task]) }}" class="btn btn-link btn-sm">
                                                            {{ __('activity.viewTask') }}<span class="far fa-arrow-alt-circle-right ml-1"></span>
                                                        </a>
                                                    </div>

                                                    <div>

                                                        @can('update', $task)
                                                            <a href="{{ route('activities.tasks.edit', [$activity, $task]) }}" class="btn btn-sm btn-primary">
                                                                <span class="fas fa-edit mr-1"></span>{{ __('app.edit') }}</a>
                                                        @endcan

                                                        <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target="#task_content_{{ $task->id }}">
                                                            {{ __('app.close') }}
                                                        </button>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <p class="text-muted">
                                        <em>{{ __('activity.noActiveTasks') }}</em>
                                    </p>

                                @endforelse
                            </div>

                            <p class="no-print">
                                @can('create', [\App\Activity\Task::class, $activity])
                                    <a class="btn btn-sm btn-primary" href="{{ route('activities.tasks.create', [$activity]) }}">
                                        <span class="fas fa-plus-circle"></span> {{ __('activity.addTask') }}
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-secondary disabled" data-trigger="hover focus" data-toggle="popover" data-content="{{ __('activity.onlyOwnerAndParticipantsCanEditTasks') }}">
                                        <span class="fas fa-plus-circle"></span> {{ __('activity.addTask') }}
                                    </button>
                                    <span class="sr-only">{{ __('activity.onlyOwnerAndParticipantsCanEditTasks') }}</span>
                                @endcan
                            </p>

                            <div class="list-group project--task-list completed-tasks">
                                @foreach ($activity->tasks->where('completed', true) as $task)

                                    <a class="list-group-item p-1 task d-block" href="{{ route('activities.tasks.show', [$activity, $task]) }}">
                                        <span class="far fa-check-square"></span> <span class="task-title">{{ $task->title }}</span>

                                        <div class="task-attributes pl-3">
                                            @if ($task->assigned_to)
                                                {!! $task->assignedTo->icon() !!}
                                            @endif
                                            @if ($task->details)
                                                <span class="fas fa-align-left"></span>
                                            @endif
                                            @if ($task->due_date)
                                                <span class="far fa-calendar-alt calendar-icon"></span>
                                            @endif
                                        </div>

                                    </a>

                                @endforeach
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
