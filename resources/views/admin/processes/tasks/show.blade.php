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
                        <span class="fas fa-clipboard-check"></span> {{ $task->name }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            <span class="far fa-{{ $task->active ?? false ? 'check-' : '' }}square"></span> {{ __('process.task_active') }}
                        </span>

                        <a href="{{ route('admin.processes.tasks.edit', [$process, $task]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"></span> {{ __('admin.editTask') }}
                        </a>

                    </div>

                    <hr>

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($task->details) !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
