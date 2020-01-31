@extends("layouts.app")

@push('styles')
    @style('css/processes.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes())
                    ->setCurrentLocation($instance->name),
])

@section('content')


    <div class="row project">

        <div class="col-12 col-md-8 col-xl-8">
            <div class="card shadow">
                <div class="card-body">

                    <h1 class="h2">
                        <span class="fas fa-clipboard-list"></span> {{ $instance->process_name . ' - ' . $instance->name }}
                    </h1>

                    <p>
                        @if ($instance->completed)
                            <span class="project--completed-indicator">
                                <span class="fas fa-check-circle"></span> {{ __('project.completed') }}
                            </span>
                        @endif
                    </p>

                    <div class="card">
                        <div class="card-body">
                            <dl class="row project-details">
                                <dt class="col-4 col-sm-3 col-xl-2">{{ __('process.instance_owner') }}</dt>
                                <dd class="col-8 col-sm-9 col-xl-10">
                                    @if ($instance->owner_id)
                                        {!! $instance->owner->iconAndName(['mhw-25p']) !!}
                                    @endif
                                </dd>

                            </dl>
                        </div>
                    </div>

                    @if ($instance->process_details)
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($instance->process_details) !!}
                        </div>
                        <hr>
                    @endif

                    @if ($instance->details)
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($instance->details) !!}
                        </div>
                        <hr>
                    @endif



                </div>

            </div>
        </div>

        <div class="col-12 col-md-4 col-xl-4 mt-3 mt-md-0 pl-md-0">
            <div class="card shadow">

                <div class="card-body">
                    <p class="text-right">
                        <a class="btn btn-primary btn-sm sssbtn-block" href="{{ route('processes.edit', [$instance]) }}">
                            <span class="fas fa-edit"></span> {{ __('project.editProject') }}
                        </a>
                    </p>


                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>{{ __('process.instance_owner') }}</strong>
                            <br>
                            @if ($instance->owner_id)
                                {!! $instance->owner->iconAndName(['mhw-25p']) !!}
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>Opened</strong>
                            <br>
                            {{ \App\format_datetime($instance->created_at) }}
                        </li>
                        <li class="list-group-item">
                            <strong>Opened By</strong>
                            <br>
                            {!! $instance->createdBy->iconAndName(['mhw-25p']) !!}
                        </li>
                    </ul>

                </div>

            </div>
        </div>

        {{--<div class="col-12 col-md-5 col-xl-4 mt-3 mt-md-0 pl-md-0">

            <div class="project--tasks card shadow">

                <div class="card-body">

                    <h4><span class="fas fa-tasks"></span> Tasks</h4>

                    <hr>

                    <ul class="project--task-list current-tasks">
                        @foreach ($instance->tasks->where('completed', false) as $task)

                            <li class="task @if($task->isDueToday()) due-today @elseif($task->isOverdue()) overdue @endif">
                                <span class="far fa-square"></span> <a href="{{ route('projects.tasks.show', [$project, $task]) }}">{{ $task->title }}</a>

                                <div class="task-attributes">
                                    @if ($task->assigned_to)
                                        {!! $task->assignedTo->icon() !!}
                                    @endif
                                    @if ($task->details)
                                        <span class="fas fa-align-left"></span>
                                    @endif
                                    <span class="fas fa-paperclip"></span>
                                    @if ($task->due_date)
                                        <span class="project--task--due-date"><span class="far fa-calendar-alt calendar-icon"></span> {{ App\format_date($task->due_date) }}</span>
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
                        @foreach ($project->tasks->where('completed', true) as $task)

                            <li class="task">
                                <span class="far fa-check-square"></span> <a href="{{ route('projects.tasks.show', [$project, $task]) }}">{{ $task->title }}</a>

                                <div class="task-attributes">
                                    @if ($task->assigned_to)
                                        {!! $task->assignedTo->icon() !!}
                                    @endif
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

                </div>

            </div>

        </div>--}}

    </div>
@endsection
