@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Show($process))
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Tasks($process))
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Tasks\Show($process, $task))
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Tasks\Actions($process, $task))
                    ->setCurrentLocation($action->name),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card">
                <div class="card-body">

                    <h2>
                        <span class="fas fa-check-square"></span> {{ $action->name }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            <span class="far fa-{{ $action->active ?? false ? 'check-' : '' }}square"></span> {{ __('process.action_active') }}
                        </span>

                        <a href="{{ route('admin.processes.tasks.actions.edit', [$process, $task, $action]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"></span> {{ __('admin.editAction') }}
                        </a>

                    </div>

                    <hr>

                    @if ($action->details)

                        <div class="editor-content">
                            {!! App\safe_text_editor_content($action->details) !!}
                        </div>

                        <hr>

                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
