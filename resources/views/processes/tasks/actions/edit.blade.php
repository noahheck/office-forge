@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.tasks.index.js')--}}
@endpush

@push('meta')
    @meta('instanceId', $instance->id)
    @meta('taskId', $task->id)
    @meta('actionId', $action->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes())
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes\Show($instance))
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes\Tasks($instance))
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes\Tasks\Show($instance, $task))
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes\Tasks\Actions($instance, $task))
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes\Tasks\Actions\Show($instance, $task, $action))
                    ->setCurrentLocation(__('app.edit')),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card shadow">

                <div class="card-body">

                    <h1 class="h2">
                        <span class="fas fa-tasks mr-2"></span>{{ $action->action_name }}
                    </h1>


                    @if ($action->action_details)
                        <hr>
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($action->action_details) !!}
                        </div>
                    @endif

                    <hr>

                    <form action="{{ route('processes.tasks.actions.update', [$instance, $task, $action]) }}" method="POST" class="bold-labels">

                        @csrf
                        @method('PUT')

                        @hiddenField([
                            'name' => 'return',
                            'value' => old('return', url()->previous()),
                        ])

                        @checkboxSwitchField([
                            'name' => 'completed',
                            'id' => 'action_' . $action->id . '_completed',
                            'label' => __('process.action_completed'),
                            'checked' => $action->completed,
                            'value' => '1',
                            'required' => false,
                            'error' => $errors->has('completed'),
                        ])

                        <hr>

                        @textEditorField([
                            'name' => 'details',
                            'id' => 'action_details',
                            'label' => __('process.action_details'),
                            'required' => false,
                            'value' => $action->details,
                            'placeholder' => '',
                            'description' => '',
                            'toolbar' => 'full',
                            'resourceType' => get_class($action),
                            'resourceId' => $action->id,
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
