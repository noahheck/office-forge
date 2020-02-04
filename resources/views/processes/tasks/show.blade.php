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
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes())
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes\Show($instance))
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes\Tasks($instance))
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

                </div>

            </div>

        </div>

    </div>

@endsection