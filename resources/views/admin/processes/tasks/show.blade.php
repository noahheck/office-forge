@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@push('scripts')
    @script('js/page.admin.processes.tasks.show.js')
@endpush

@push('meta')
    @meta('processId', $process->id)
    @meta('taskId', $task->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Processes\Tasks\Show($process, $task),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <div class="card document">
                <div class="card-body">

                    <h2>
                        {!! \App\icon\tasks(['mr-2']) !!}{{ $task->name }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            @if($task->active)
                                {!! \App\icon\checkedBox(['mr-1']) !!}{{ __('process.task_active') }}
                            @else
                                {!! \App\icon\uncheckedBox(['mr-1']) !!}{{ __('process.task_active') }}
                            @endif
                        </span>

                        <a href="{{ route('admin.processes.tasks.edit', [$process, $task]) }}" class="btn btn-sm btn-primary">
                            {!! \App\icon\edit(['mr-1']) !!}{{ __('admin.editTask') }}
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
