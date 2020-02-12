@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.tasks.index.js')--}}
@endpush

@push('meta')
    @meta('instanceId', $instance->id)
    @meta('taskId', $task->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Processes\Tasks\Edit($process, $instance, $task),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card shadow">

                <div class="card-body">

                    <h1 class="h2">
                        <span class="fas fa-clipboard-check mr-2"></span>{{ $task->task_name }}
                    </h1>

                    {{--<div class="d-flex justify-content-between">
                        <span>
                            <span class="far fa-{{ $task->completed ? 'check-' : '' }}square"></span> {{ __('process.instance_completed') }}
                        </span>
                        <a href="{{ route('processes.tasks.edit', [$instance, $task]) }}" class="btn btn-primary btn-sm">
                            <span class="fas fa-edit"></span> {{ __('process.task_editTask') }}
                        </a>
                    </div>--}}


                    @if ($task->task_details)
                        <hr>
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($task->task_details) !!}
                        </div>
                    @endif

                    <hr>

                    <form action="{{ route('processes.tasks.update', [$instance, $task]) }}" method="POST" class="bold-labels" >

                        @csrf
                        @method('PUT')

                        @hiddenField([
                            'name' => 'return',
                            'value' => old('return', url()->previous()),
                        ])

                        @checkboxSwitchField([
                            'name' => 'completed',
                            'id' => 'task_' . $task->id . '_completed',
                            'label' => __('process.task_completed'),
                            'checked' => $task->completed,
                            'value' => '1',
                            'required' => false,
                            'error' => $errors->has('completed'),
                        ])

                        <hr>

                        @textEditorField([
                            'name' => 'details',
                            'id' => 'task_details',
                            'label' => __('process.task_details'),
                            'required' => false,
                            'value' => $task->details,
                            'placeholder' => '',
                            'description' => '',
                            'toolbar' => 'full',
                            'resourceType' => get_class($task),
                            'resourceId' => $task->id,
                        ])

                        <hr>

                        <button type="submit" class="btn btn-primary">
                            {{ __('app.save') }}
                        </button>

                        <a class="btn btn-secondary" href="{{ url()->previous(route('processes.show', [$instance])) }}">
                            {{ __('app.cancel') }}
                        </a>


                    </form>


                    {{--@if ($task->details)
                        <hr>
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($task->details) !!}
                        </div>
                    @endif

                    <hr>--}}

                </div>

            </div>

        </div>

    </div>

@endsection
