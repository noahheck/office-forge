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

    <div class="row justify-content-center task {{ ($task->isOverdue()) ? 'overdue' : '' }}">

        <div class="col-12 col-md-9 col-lg-8">
            <div class="card shadow">
                <div class="card-body">

                    <div class="d-flex">

                        <div class="col-10 col-sm-9 col-xl-10">
                            <h2 class="h4 overflow-x-ellipsis">
                                <span class="fas fa-project-diagram"></span>
                                {{ $activity->name }}
                            </h2>
                        </div>

                        <div class="col-2 col-sm-3 col-xl-2 text-right">
                            @can('update', $task)
                                <a class="btn btn-sm btn-primary" href="{{ route('activities.tasks.edit', [$activity, $task]) }}" title="{{ __('activity.editTask') }}">
                                    <span class="fas fa-edit"></span>
                                    <span class="d-none d-sm-inline">{{ __('app.edit') }} {{ __('activity.task') }}</span>
                                </a>
                            @else
                                <button class="btn btn-sm btn-secondary disabled" data-trigger="hover focus" data-toggle="popover" data-content="{{ __('activity.onlyOwnerAndParticipantsCanEditTasks') }}">
                                    <span class="fas fa-edit"></span>
                                    <span class="d-none d-sm-inline">{{ __('app.edit') }} {{ __('activity.task') }}</span>
                                </button>
                                <span class="sr-only">{{ __('activity.onlyOwnerAndParticipantsCanEditTasks') }}</span>
                            @endcan
                        </div>
                    </div>

                    <div class="task-details">

                        <h3>
                            <span class="far {{ ($task->completed) ? 'fa-check-square' : 'fa-square' }}"></span>
                            {{ $task->title }}
                        </h3>

                        <dl class="row">
                            <dt class="col-4 col-sm-3">{{ __('activity.taskAssignedTo') }}</dt>
                            <dd class="col-8 col-sm-9">
                                @if ($task->assigned_to)
                                    {!! $task->assignedTo->iconAndName() !!}
                                @endif
                            </dd>

                            <dt class="col-4 col-sm-3">{{ __('activity.taskDueDate') }}</dt>
                            <dd class="col-8 col-sm-9 task--due-date">{{ App\format_date($task->due_date) }}</dd>

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
