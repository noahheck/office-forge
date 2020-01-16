@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Show($process))
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Tasks($process))
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Tasks\Show($process, $task))
                    ->setCurrentLocation(__('app.edit')),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-clipboard-check"></span> {{ __('admin.editTask') }}
            </h1>

            <p class="text-muted">{{ __('admin.editTask_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.processes.tasks._form', [
                        'action' => route('admin.processes.tasks.update', [$process, $task, 'return' => url()->previous()]),
                        'method' => 'PUT',
                        'showActive' => true,
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
