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

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($task->details) !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
