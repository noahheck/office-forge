@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Show($process))
                    ->setCurrentLocation('Tasks'),
])

@section('content')
    <h1>
        <span class="fas fa-clipboard-list"></span> {{ $process->name }}
    </h1>

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card">

                <div class="card-body">

                    <h2>
                        <span class="fas fa-clipboard-check"></span>
                        {{ __('admin.tasks') }}
                    </h2>

                    <hr>

                    @if (count($process->tasks) > 0)










                    @else

                        <div class="row justify-content-center">

                            <div class="col-12 col-sm-10">

                                <div class="card">
                                    <div class="card-body text-center">

                                        <div class="empty-resource">
                                            <span class="fas fa-clipboard-check empty-resource-icon"></span>
                                        </div>

                                        <p>{{ __('admin.task_description') }}</p>
                                        <p>{{ __('admin.task_subtaskDescription') }}</p>

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
