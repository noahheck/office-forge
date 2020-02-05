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
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes\Tasks\Show($instance, $task))
                    ->setCurrentLocation(__('process.actions')),
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

                                <li class="list-group-item d-flex" data-id="{{ $action->id }}">
                                    <div class="flex-grow-1">
                                        <span class="far fa{{ ($action->completed) ? '-check' : '' }}-square mr-2"></span>
                                        <a href="{{ route('processes.tasks.actions.show', [$instance, $task, $action]) }}">
                                            {{ $action->action_name }}
                                        </a>
                                        @if ($action->details)
                                            <span class="text-muted fas fa-align-left"></span>
                                        @endif

                                    </div>
                                </li>

                            @if ($loop->last)
                                </ul>
                            @endif

                        @endforeach



                    @else

                        <div class="row justify-content-center">

                            <div class="col-12 col-sm-10">

                                <div class="card">
                                    <div class="card-body text-center">

                                        No Tasks

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
