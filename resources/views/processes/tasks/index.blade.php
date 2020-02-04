@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.tasks.index.js')--}}
@endpush

@push('meta')
    @meta('instanceId', $instance->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes())
                    ->addLink(new \App\Navigation\LocationBar\Link\Processes\Show($instance))
                    ->setCurrentLocation(__('process.tasks')),
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
                                    <div class="flex-grow-1">
                                        <span class="far fa{{ ($task->completed) ? '-check' : '' }}-square mr-2"></span>
                                        <a href="{{ route('processes.tasks.show', [$instance, $task]) }}">
                                            {{ $task->task_name }}
                                        </a>
                                        @if ($task->details)
                                            <span class="text-muted fas fa-align-left"></span>
                                        @endif

                                        <br>

                                        <span class="text-muted"><span class="fas fa-tasks"></span> {{--{{ $numActions = count($task->actions->where('active', true)) }} {{ __('process.action' . (($numActions == 1) ? '' : 's')) }}--}}</span>
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
