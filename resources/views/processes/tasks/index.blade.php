@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.tasks.index.js')--}}
@endpush

@push('meta')
    @meta('instanceId', $instance->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Processes\Tasks\Index($process, $instance),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card shadow">

                <div class="card-body">

                    <h1 class="h2">
                        <span class="fas fa-clipboard-list"></span> {{ $instance->fullName }}
                    </h1>

                    <hr>

                    <h2 class="h4">
                        <span class="fas fa-clipboard-check mr-2"></span>{{ __('process.tasks') }}
                    </h2>

                    @if (count($tasks) > 0)

                        @foreach ($tasks as $task)

                            @if ($loop->first)
                                <ul class="list-group" id="processTasks">
                            @endif

                                <li class="list-group-item d-flex" data-id="{{ $task->id }}">

                                    @php
                                        $__toggleCompletedRouteName = ($task->completed) ? 'processes.tasks.uncomplete' : 'processes.tasks.complete';
                                        $__toggleCompletedTitleText = ($task->completed) ? __('process.task_markIncomplete') : __('process.task_markCompleted');
                                    @endphp

                                    <div class="flex-grow-0">
                                        <form action="{{ route($__toggleCompletedRouteName, [$instance, $task]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            @hiddenField([
                                                'name' => 'return',
                                                'value' => url()->current(),
                                            ])
                                            <button type="submit" class="btn btn-link p-0 pr-3 text-reset" title="{{ $__toggleCompletedTitleText }}">
                                                <span class="sr-only">{{ $__toggleCompletedTitleText }}</span>
                                                <span class="far fa{{ ($task->completed) ? '-check' : '' }}-square fa-lg"></span>
                                            </button>
                                        </form>

                                    </div>

                                    <div class="flex-grow-1">
                                        <a href="{{ route('processes.tasks.show', [$instance, $task]) }}">
                                            {{ $task->task_name }}
                                        </a>
                                        @if ($task->details)
                                            <span class="text-muted fas fa-align-left"></span>
                                        @endif

                                        <br>

                                        <span class="text-muted"><span class="fas fa-tasks"></span> {{ $numActions = $task->numberOfTotalActions() }} {{ __('process.action' . (($numActions == 1) ? '' : 's')) }} @if($numActions > 0) ({{ $task->numberOfCompletedActions() }} {{ __('process.action_completed') }}) @endif</span>
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
