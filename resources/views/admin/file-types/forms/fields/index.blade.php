@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.processes.tasks.actions.index.js')
@endpush

@push('meta')
    @meta('processId', $process->id)
    @meta('taskId', $task->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Processes\Tasks\Actions\Index($process, $task),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-clipboard-check"></span> {{ $task->name }}
            </h1>

            <div class="card">

                <div class="card-body">

                    <h2>
                        <span class="fas fa-tasks"></span>
                        {{ __('admin.actions') }}
                    </h2>

                    <hr>

                    @if (count($task->actions) > 0)

                        <p class="text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.processes.tasks.actions.create', [$process, $task]) }}">
                                <span class="fas fa-plus"></span> {{ __('admin.addAction') }}
                            </a>
                        </p>

                        @foreach ($task->actions as $action)

                            @if ($loop->first)
                                <ul class="list-group" id="taskActions">
                            @endif

                                <li class="list-group-item d-flex" data-id="{{ $action->id }}">
                                    <div class="flex-grow-1">
                                        <span class="far fa-square"></span>
                                        <a href="{{ route('admin.processes.tasks.actions.show', [$process, $task, $action]) }}">
                                            {{ $action->name }}
                                        </a>
                                        @if ($action->details)
                                            <span class="text-muted fas fa-align-left"></span>
                                        @endif
                                    </div>
                                    <div class="sort-handle">
                                        <span class="fas fa-arrows-alt-v"></span>
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

                                        <div class="empty-resource">
                                            <span class="fas fa-check-square empty-resource-icon"></span>
                                        </div>

                                        <p>{{ __('admin.action_description') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.processes.tasks.actions.create', [$process, $task]) }}">{{ __('admin.action_createFirstActionForTaskNow') }}</a>
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
