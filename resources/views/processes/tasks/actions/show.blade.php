@extends("layouts.admin")

@push('scripts')

@endpush

@push('meta')
    @meta('instanceId', $instance->id)
    @meta('taskId', $task->id)
    @meta('actionId', $action->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Processes\Tasks\Actions\Show($process, $instance, $task, $action))
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card shadow">

                <div class="card-body">

                    <h1 class="h2">
                        <span class="fas fa-tasks mr-2"></span>{{ $action->action_name }}
                    </h1>

                    <hr>

                    <div class="d-flex justify-content-between">
                        @php
                            $__toggleCompletedRouteName = ($action->completed) ? 'processes.tasks.actions.uncomplete' : 'processes.tasks.actions.complete';
                            $__toggleCompletedTitleText = ($action->completed) ? __('process.action_markCompleted') : __('process.action_markIncomplete');
                        @endphp
                        <form action="{{ route($__toggleCompletedRouteName, [$instance, $task, $action]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @hiddenField([
                                'name' => 'return',
                                'value' => url()->current(),
                            ])
                            <button type="submit" class="btn btn-link p-0 pr-1 text-reset" title="{{ $__toggleCompletedTitleText }}">
                                <span class="sr-only">{{ $__toggleCompletedTitleText }}</span>
                                <span class="far fa{{ ($action->completed) ? '-check' : '' }}-square fa-lg"></span>
                            </button>
                                 {{ __('process.action_completed') }}
                        </form>
                        <a href="{{ route('processes.tasks.actions.edit', [$instance, $task, $action]) }}" class="btn btn-primary btn-sm">
                            <span class="fas fa-edit"></span> {{ __('process.action_editAction') }}
                        </a>
                    </div>


                    @if ($action->action_details)
                        <hr>
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($action->action_details) !!}
                        </div>
                    @endif

                    @if ($action->details)
                        <hr>
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($action->details) !!}
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
