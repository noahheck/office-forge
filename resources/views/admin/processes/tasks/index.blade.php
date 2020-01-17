@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Show($process))
                    ->setCurrentLocation('Tasks'),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-clipboard-list"></span> {{ $process->name }}
            </h1>

            <div class="card">

                <div class="card-body">

                    <h2>
                        <span class="fas fa-clipboard-check"></span>
                        {{ __('admin.tasks') }}
                    </h2>

                    <hr>

                    @if (count($process->tasks) > 0)

                        <p class="text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.processes.tasks.create', [$process]) }}">
                                <span class="fas fa-plus"></span> {{ __('admin.addTask') }}
                            </a>
                        </p>

                        @foreach ($process->tasks as $task)

                            @if ($loop->first)
                                <ul class="list-group">
                            @endif

                                <li class="list-group-item">
                                    <span class="far fa-square"></span>
                                    <a href="{{ route('admin.processes.tasks.show', [$process, $task]) }}">
                                        {{ $task->name }}
                                    </a>
                                    @if ($task->details)
                                        <span class="text-muted fas fa-align-left"></span>
                                    @endif

                                    <br>

                                    <span class="text-muted"><span class="fas fa-tasks"></span> {{ $numActions = count($task->actions->where('active', true)) }} {{ __('process.action' . (($numActions == 1) ? '' : 's')) }}</span>

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
                                            <span class="fas fa-clipboard-check empty-resource-icon"></span>
                                        </div>

                                        <p>{{ __('admin.task_description') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.processes.tasks.create', [$process]) }}">{{ __('admin.task_createFirstTaskForProcessNow') }}</a>
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
