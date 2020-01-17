@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Show($process))
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Tasks($process))
                    ->setCurrentLocation($task->name),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card">
                <div class="card-body">

                    <h2>
                        <span class="fas fa-clipboard-check mr-2"></span>{{ $task->name }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            <span class="far fa-{{ $task->active ?? false ? 'check-' : '' }}square mr-1"></span>{{ __('process.task_active') }}
                        </span>

                        <a href="{{ route('admin.processes.tasks.edit', [$process, $task]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"></span> {{ __('admin.editTask') }}
                        </a>

                    </div>

                    <hr>

                    @if ($task->details)

                        <div class="editor-content">
                            {!! App\safe_text_editor_content($task->details) !!}
                        </div>

                        <hr>

                    @endif

                    <div class="d-flex justify-content-between">
                        <h3 class="h4">
                            <span class="fas fa-tasks mr-2"></span>{{ __('admin.actions') }}
                        </h3>
                        <a href="{{ route('admin.processes.tasks.actions.index', [$process, $task]) }}">
                            <span class="far fa-arrow-alt-circle-right mr-1"></span>{{ __('admin.actions') }}
                        </a>
                    </div>

                    @forelse ($task->actions as $action)

                        @if ($loop->first)
                            <ul class="list-group list-group-flush">
                        @endif
                            <li class="list-group-item @if ($loop->first) border-top-0 @endif @if ($loop->last) border-bottom-0 @endif">
                                <span class="far fa-square"></span>
                                <a href="{{ route('admin.processes.tasks.actions.show', [$process, $task, $action]) }}">{{ $action->name }}</a>
                                @if ($action->details)
                                    <span class="text-muted fas fa-align-left"></span>
                                @endif
                            </li>
                        @if ($loop->last)
                            </ul>
                        @endif


                    @empty

                        <div class="text-center border p-4">

                            <p>{{ __('admin.action_description') }}</p>

                        </div>

                    @endforelse

                    <div class="text-right mt-3">
                        <a href="{{ route('admin.processes.tasks.actions.create', [$process, $task]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-plus"></span> {{ __('admin.addAction') }}
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
