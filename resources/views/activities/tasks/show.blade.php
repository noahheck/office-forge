@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Tasks\Show($activity, $task))
])

@push('meta')
    @meta('activity.id', $activity->id)
    @meta('activity.name', $activity->name)
    @meta('task.id', $task->id)
    @meta('task.title', $task->title)
    @meta('task.due_date', \App\format_date($task->due_date))
@endpush

@section('content')

    <div class="row justify-content-center task {{ (!$activity->completed && $task->isOverdue()) ? 'overdue' : '' }}">

        <div class="col-12 col-md-9 col-lg-8">
            <div class="card shadow">
                <div class="card-body">

                    <h2 class="h6 overflow-x-ellipsis">
                        <a href="{{ route('activities.show', [$activity]) }}">
                            <span class="fas fa-project-diagram"></span> {{ $activity->name }}
                        </a>
                    </h2>

                    <hr>

                    <div class="d-flex">

                        <div class="flex-grow-1">

                            @if ($task->completed)
                                <span class="project--completed-indicator">
                                    <span class="fas fa-check"></span> {{ __('activity.completed') }}
                                </span>
                            @else
                                @can('update', $task)
                                    <form action="{{ route('activities.tasks.complete', [$activity, $task]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-light">
                                            <span class="far fa-square fa-lg"></span>
                                            {{ __('activity.completeTask') }}
                                        </button>
                                    </form>
                                @endcan
                            @endif

                        </div>

                        <div class="">
                            @can('update', $task)


                                @if ($task->completed)
                                    <form action="{{ route('activities.tasks.uncomplete', [$activity, $task]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-light btn-sm">
                                            <span class="fas fa-undo"></span>
                                            {{ __('activity.reopenTask') }}
                                        </button>
                                    </form>
                                @else
                                    <a class="btn btn-sm btn-primary" href="{{ route('activities.tasks.edit', [$activity, $task]) }}" title="{{ __('activity.editTask') }}">
                                        <span class="fas fa-edit"></span>
                                        <span class="d-none d-sm-inline">{{ __('app.edit') }} {{ __('activity.task') }}</span>
                                    </a>
                                @endif

                            @else
                                @if (!$task->completed)
                                    <button class="btn btn-sm btn-secondary disabled" data-trigger="hover focus" data-toggle="popover" data-content="{{ __('activity.onlyOwnerAndParticipantsCanEditTasks') }}">
                                        <span class="fas fa-edit"></span>
                                        <span class="d-none d-sm-inline">{{ __('app.edit') }} {{ __('activity.task') }}</span>
                                    </button>
                                    <span class="sr-only">{{ __('activity.onlyOwnerAndParticipantsCanEditTasks') }}</span>
                                @endif
                            @endcan
                        </div>
                    </div>

                    <div class="task-details">

                        <h3>
                            {{ $task->title }}
                        </h3>

                        <dl class="row">
                            <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.taskAssigned') }}</dt>
                            <dd class="col-12 col-sm-9 col-xl-10">
                                @if ($task->assigned_to)
                                    {!! $task->assignedTo->iconAndName() !!}
                                @endif
                            </dd>

                            <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.taskDueDate') }}</dt>
                            <dd class="col-12 col-sm-9 col-xl-10 task--due-date">{{ App\format_date($task->due_date) }}</dd>

                        </dl>

                    </div>

                    @if ($task->process_task_id && $task->process_task_details)
                        <div class="editor-content">
                            {!! App\safe_text_editor_content($task->process_task_details) !!}
                        </div>

                        <hr>

                    @endif

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($task->details) !!}
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
