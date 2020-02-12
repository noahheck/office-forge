@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\SystemSettings)
                    ->addLink(new \App\Navigation\Link\Admin\Processes())
                    ->addLink(new \App\Navigation\Link\Admin\Processes\Show($process))
                    ->addLink(new \App\Navigation\Link\Admin\Processes\Tasks($process))
                    ->addLink(new \App\Navigation\Link\Admin\Processes\Tasks\Show($process, $task))
                    ->addLink(new \App\Navigation\Link\Admin\Processes\Tasks\Actions($process, $task))
                    ->addLink(new \App\Navigation\Link\Admin\Processes\Tasks\Actions\Show($process, $task, $action))
                    ->setCurrentLocation(__('app.edit')),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-check-square"></span> {{ __('admin.editAction') }}
            </h1>

            <p class="text-muted">{{ __('admin.editAction_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.processes.tasks.actions._form', [
                        'action' => route('admin.processes.tasks.actions.update', [$process, $task, $action, 'return' => url()->previous()]),
                        'taskAction' => $action,
                        'method' => 'PUT',
                        'showActive' => true,
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
