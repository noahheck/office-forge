@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\SystemSettings)
                    ->addLink(new \App\Navigation\Link\SystemSettings\Processes())
                    ->addLink(new \App\Navigation\Link\SystemSettings\Processes\Show($process))
                    ->addLink(new \App\Navigation\Link\SystemSettings\Processes\Tasks($process))
                    ->addLink(new \App\Navigation\Link\SystemSettings\Processes\Tasks\Show($process, $task))
                    ->addLink(new \App\Navigation\Link\SystemSettings\Processes\Tasks\Actions($process, $task))
                    ->setCurrentLocation(__('app.addNew')),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-check-square"></span> {{ __('admin.newAction') }}
            </h1>

            <p class="text-muted">{{ __('admin.newAction_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.processes.tasks.actions._form', [
                        'action' => route('admin.processes.tasks.actions.store', [$process, $task, 'return' => url()->previous()]),
                        'taskAction' => $action,
                        'showActive' => false,
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
