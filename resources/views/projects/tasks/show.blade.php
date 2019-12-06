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

    <div class="row justify-content-center">

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


                    <hr>

                    <h3>
                        <span class="far fa-square"></span>
                        {{ $task->title }}
                    </h3>

                    <dl class="row">
                        <dt class="col-4 col-sm-3 col-xl-2">{{ __('project.taskAssignedTo') }}</dt>
                        <dd class="col-8 col-sm-9 col-xl-10"></dd>

                        <dt class="col-4 col-sm-3 col-xl-2">{{ __('project.taskDueDate') }}</dt>
                        <dd class="col-8 col-sm-9 col-xl-10">{{ App\format_date($task->due_date) }}</dd>

                    </dl>

                    <hr>

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($task->details) !!}
                    </div>

                </div>

            </div>
        </div>

        {{--<div class="col-12 col-md-5 col-xl-4 mt-3 mt-md-0 pl-md-0">

            <div class="project--tasks card">

                <div class="card-body">

                    <h4><span class="fas fa-tasks"></span> Tasks</h4>

                    <hr>

                    <ul class="project--task-list current-tasks">
                        @foreach ($project->tasks as $task)

                            <li class="task @if(Arr::random([true, false])) overdue @endif">
                                <span class="far fa-square"></span> <a href="{{ route('projects.tasks.edit', [$project, $task]) }}">{{ $task->title }}</a>

                                <div class="task-attributes">
                                    {!! Auth::user()->icon() !!}
                                    @if ($task->details)
                                        <span class="fas fa-align-left"></span>
                                    @endif
                                    <span class="fas fa-paperclip"></span>
                                    @if ($task->due_date)
                                        <span class="far fa-calendar-alt calendar-icon"></span>
                                    @endif
                                </div>

                            </li>

                        @endforeach
                    </ul>

                    <p>
                        <a class="btn btn-sm btn-primary" href="{{ route('projects.tasks.create', [$project]) }}">
                            <span class="fas fa-plus-circle"></span> {{ __('project.addTask') }}
                        </a>
                    </p>

                    <hr>

                    <ul class="project--task-list completed-tasks">
                        @foreach (['Sysadmin call', 'New User Training'] as $task)
                            <li class="task">
                                <span class="far fa-check-square"></span> <a href="#">{{ $task }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>

            </div>

        </div>--}}

    </div>
@endsection
