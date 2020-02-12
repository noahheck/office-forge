@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\SystemSettings)
                    ->addLink(new \App\Navigation\Link\SystemSettings\Processes())
                    ->addLink(new \App\Navigation\Link\SystemSettings\Processes\Show($process))
                    ->addLink(new \App\Navigation\Link\SystemSettings\Processes\Tasks($process))
                    ->setCurrentLocation(__('app.addNew')),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-clipboard-check"></span> {{ __('admin.newTask') }}
            </h1>

            <p class="text-muted">{{ __('admin.newTask_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.processes.tasks._form', [
                        'action' => route('admin.processes.tasks.store', [$process, 'return' => url()->previous()]),
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
