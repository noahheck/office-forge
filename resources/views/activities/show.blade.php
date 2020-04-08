@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Show($activity))
])

@section('content')

    <div class="row project {{ ($activity->isOverdue()) ? 'overdue' : '' }} justify-content-center">

        <div class="col-12 col-md-10" style="max-width: 900px;">
            <div class="card shadow">
                <div class="card-body">

                    <div class="border-bottom mb-3">

                        <h1 class="h3">
                            @if ($activity->process_id)
                                <span class="fas fa-clipboard-list"></span> {{ $activity->process_name }} - {{ $activity->name }}
                            @else
                                <span class="fas fa-project-diagram"></span> {{ $activity->name }}
                            @endif
                        </h1>

                        @if ($file ?? false)
                            <div class="d-flex align-items-center mb-2">
                                {!! $file->icon(['mhw-35p', 'mr-3', 'ml-2']) !!}
                                <h5 class="mb-0"><a href="{{ route("files.show", [$file]) }}">{{ $file->name }}</a></h5>
                            </div>
                        @endif

                    </div>
                    <div class="row">

                        <div class="col-12 col-md-3 order-md-2">

                            <dl class="project-details">
                                <dt>{{ __('activity.owner') }}</dt>
                                <dd>
                                    @if ($activity->owner_id)
                                        {!! $activity->owner->iconAndName() !!}
                                    @endif
                                </dd>

                                <dt>{{ __('activity.dueDate') }}</dt>
                                <dd class="project--due-date">{{ App\format_date($activity->due_date) }}</dd>

                                <dt><a href="{{ route('activities.participants.index', [$activity]) }}">{{ __('activity.participants') }}</a></dt>
                                <dd>
                                    @forelse ($activity->participants as $participant)

                                        @if ($loop->first)
                                            <ul class="list-group">
                                        @endif

                                            <li class="list-group-item">
                                                {!! $participant->user->iconAndName() !!}
                                            </li>

                                        @if ($loop->last)
                                            </ul>
                                        @endif

                                    @empty
                                        <em>{{ __('activity.noParticipants') }}</em>
                                    @endforelse
                                </dd>

                            </dl>

                        </div>

                        <div class="col-12 col-md-9 order-md-1">



                            <p>
                                <a class="btn btn-primary btn-sm float-right" href="{{ route('activities.edit', [$activity]) }}">
                                    <span class="fas fa-edit"></span> {{ __('activity.editActivity') }}
                                </a>

                                @if ($activity->completed)
                                    <span class="project--completed-indicator">
                                        <span class="fas fa-check-circle"></span> {{ __('activity.completed') }}
                                    </span>
                                @endif
                                &nbsp;
                            </p>

                            <hr>

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

                            <div class="project--task-list current-tasks">
                                @forelse ($activity->tasks->where('completed', false) as $task)

                                    <a class="task d-block @if($task->isDueToday()) due-today @elseif($task->isOverdue()) overdue @endif" href="{{ route('activities.tasks.show', [$activity, $task]) }}">
                                        <span class="far fa-square"></span> <span class="task-title">{{ $task->title }}</span>

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

                                @empty

                                    <p class="text-muted">
                                        <em>{{ __('activity.noActiveTasks') }}</em>
                                    </p>

                                @endforelse
                            </div>

                            <p>
                                <a class="btn btn-sm btn-primary" href="{{ route('activities.tasks.create', [$activity]) }}">
                                    <span class="fas fa-plus-circle"></span> {{ __('activity.addTask') }}
                                </a>
                            </p>

                            <div class="project--task-list completed-tasks">
                                @foreach ($activity->tasks->where('completed', true) as $task)

                                    <a class="task d-block" href="{{ route('activities.tasks.show', [$activity, $task]) }}">
                                        <span class="far fa-check-square"></span> <span class="task-title">{{ $task->title }}</span>

                                        <div class="task-attributes">
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
