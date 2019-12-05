@extends("layouts.app")

@push('styles')
    @style('css/projects.css')
@endpush

@section('content')

    <h1>
        <span class="fas fa-project-diagram"></span> {{ $project->name }}
    </h1>

    <div class="row">

        <div class="col-12 col-md-7 col-xl-8">
            <div class="card">
                <div class="card-body">

                    <p class="text-right">
                        <a class="btn btn-primary" href="{{ route('projects.edit', [$project]) }}">
                            <span class="fas fa-edit"></span> {{ __('project.editProject') }}
                        </a>
                    </p>

                    <hr>

                    <dl class="row">
                        <dt class="col-4 col-sm-3 col-xl-2">{{ __('project.owner') }}</dt>
                        <dd class="col-8 col-sm-9 col-xl-10">{{ ($project->owner) ? $project->owner->name : '' }}</dd>

                        <dt class="col-4 col-sm-3 col-xl-2">{{ __('project.dueDate') }}</dt>
                        <dd class="col-8 col-sm-9 col-xl-10">{{ App\format_date($project->due_date) }}</dd>

                    </dl>

                    <hr>

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($project->details) !!}
                    </div>

                </div>

            </div>
        </div>

        <div class="col-12 col-md-5 col-xl-4 mt-3 mt-md-0 pl-md-0">

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

        </div>

    </div>
@endsection
