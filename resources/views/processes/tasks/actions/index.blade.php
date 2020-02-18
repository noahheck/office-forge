@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.tasks.index.js')--}}
@endpush

@push('meta')
    @meta('instanceId', $instance->id)
    @meta('taskId', $task->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Processes\Tasks\Actions\Index($process, $instance, $task))
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

                    <h2 class="h4">
                        <span class="fas fa-tasks mr-2"></span>{{ __('process.actions') }}
                    </h2>

                    @if (count($task->actions) > 0)

                        @foreach ($task->actions as $action)

                            @if ($loop->first)
                                <ul class="list-group" id="taskActions">
                            @endif

                                    @php
                                        $__toggleCompletedRouteName = ($action->completed) ? 'processes.tasks.actions.uncomplete' : 'processes.tasks.actions.complete';
                                        $__toggleCompletedTitleText = ($action->completed) ? __('process.action_markCompleted') : __('process.action_markIncomplete');
                                    @endphp

                                    <li class="d-flex list-group-item" data-id="{{ $action->id }}">
                                        <div class="flex-grow-0">
                                            <form action="{{ route($__toggleCompletedRouteName, [$instance, $task, $action]) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                @hiddenField([
                                                'name' => 'return',
                                                'value' => url()->current(),
                                                ])
                                                <button type="submit" class="btn btn-link p-0 pr-3 text-reset" title="{{ $__toggleCompletedTitleText }}">
                                                    <span class="sr-only">{{ $__toggleCompletedTitleText }}</span>
                                                    <span class="far fa{{ ($action->completed) ? '-check' : '' }}-square fa-lg"></span>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="flex-grow-1">
                                            <a href="{{ route('processes.tasks.actions.show', [$instance, $task, $action]) }}">{{ $action->action_name }}</a>
                                            @if ($action->details || $action->action_details)
                                                <span class="text-muted fas fa-align-left"></span>
                                            @endif
                                        </div>
                                    </li>

                                {{--<li class="list-group-item d-flex" data-id="{{ $action->id }}">
                                    <div class="flex-grow-1">
                                        <span class="far fa{{ ($action->completed) ? '-check' : '' }}-square mr-2"></span>
                                        <a href="{{ route('processes.tasks.actions.show', [$instance, $task, $action]) }}">
                                            {{ $action->action_name }}
                                        </a>
                                        @if ($action->details)
                                            <span class="text-muted fas fa-align-left"></span>
                                        @endif

                                    </div>
                                </li>--}}

                            @if ($loop->last)
                                </ul>
                            @endif

                        @endforeach



                    @else

                        <div class="row justify-content-center">

                            <div class="col-12 col-sm-10">

                                <div class="card">
                                    <div class="card-body text-center">

                                        No Actions

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
