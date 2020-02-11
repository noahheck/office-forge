@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes\Show($process))
                    ->setCurrentLocation(__('app.edit')),
])

@section('content')
    <h1>
        <span class="fas fa-clipboard-list"></span> {{ __('admin.editProcess') }}
    </h1>

    <p class="text-muted">{{ __('admin.editProcess_shortDescription') }}</p>

    <div class="card">
        <div class="card-body">

            @include('admin.processes._form', [
                'action' => route('admin.processes.update', [$process]),
                'method' => 'PUT',
            ])

        </div>
    </div>
@endsection
