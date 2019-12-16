@extends("layouts.app")

@push('styles')
    @style('css/projects.css')
@endpush

@push('meta')
    @meta('project:id', $project->id)
    @meta('project:name', $project->name)
    @meta('task:id', $task->id)
    @meta('task:title', $task->title)
    @meta('task:due_date', \App\format_date($task->due_date))
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
                                {{ $project->name }}
                            </h2>
                        </div>

                        <div class="col-2 col-sm-3 col-xl-2 text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('projects.tasks.edit', [$project, $task]) }}" title="{{ __('project.editTask') }}">
                                <span class="fas fa-edit"></span>
                                <span class="d-none d-sm-inline">{{ __('app.edit') }} {{ __('project.task') }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="task-details">

                        <h3>
                            <span class="far {{ ($task->completed) ? 'fa-check-square' : 'fa-square' }}"></span>
                            {{ $task->title }}
                        </h3>

                        <dl class="row">
                            <dt class="col-4 col-sm-3">{{ __('project.taskAssignedTo') }}</dt>
                            <dd class="col-8 col-sm-9">
                                @if ($task->assigned_to)
                                    {!! $task->assignedTo->icon() !!} {{ $task->assignedTo->name }}
                                @endif
                            </dd>

                            <dt class="col-4 col-sm-3">{{ __('project.taskDueDate') }}</dt>
                            <dd class="col-8 col-sm-9 task--due-date">{{ App\format_date($task->due_date) }}</dd>

                        </dl>

                    </div>

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($task->details) !!}
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
