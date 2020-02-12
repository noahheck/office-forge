@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.tasks.index.js')--}}
@endpush

@push('meta')
    @meta('instanceId', $instance->id)
    @meta('taskId', $task->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\Processes())
                    ->addLink(new \App\Navigation\Link\Processes\Show($instance))
                    ->addLink(new \App\Navigation\Link\Processes\Tasks($instance))
                    ->setCurrentLocation($task->task_name),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card shadow">

                <div class="card-body">

                    <h1 class="h2">
                        <span class="fas fa-clipboard-check mr-2"></span>{{ $task->task_name }}
                    </h1>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span>
                            <span class="far fa-{{ $task->completed ? 'check-' : '' }}square"></span> {{ __('process.instance_completed') }}
                        </span>
                        <a href="{{ route('processes.tasks.edit', [$instance, $task]) }}" class="btn btn-primary btn-sm">
                            <span class="fas fa-edit"></span> {{ __('process.task_editTask') }}
                        </a>
                    </div>


                    @if ($task->task_details)
                        <hr>
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($task->task_details) !!}
                        </div>
                    @endif

                    @if ($task->details)
                        <hr>
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($task->details) !!}
                        </div>
                    @endif

                    <hr>

                    <div class="d-flex justify-content-between">
                        <h3 class="h4">
                            <span class="fas fa-tasks mr-2"></span>{{ __('process.actions') }}
                        </h3>
                        <a href="{{ route('processes.tasks.actions.index', [$instance, $task]) }}">
                            <span class="far fa-arrow-alt-circle-right mr-1"></span>{{ __('process.actions') }}
                        </a>
                    </div>

                    @foreach ($task->actions as $action)

                        @if ($loop->first)
                            <ul class="list-group" id="taskActions">
                        @endif

                            <li class="d-flex list-group-item" data-id="{{ $action->id }}">
                                <div class="flex-grow-1">
                                    <span class="far fa{{ ($action->completed) ? '-check' : '' }}-square"></span>
                                    <a href="{{ route('processes.tasks.actions.show', [$instance, $task, $action]) }}">{{ $action->action_name }}</a>
                                    @if ($action->details)
                                        <span class="text-muted fas fa-align-left"></span>
                                    @endif
                                </div>
                            </li>

                        @if ($loop->last)
                            </ul>
                        @endif


                    @endforeach

                </div>

            </div>

        </div>

    </div>

@endsection
