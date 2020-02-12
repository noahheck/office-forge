@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\SystemSettings)
                    ->addLink(new \App\Navigation\Link\SystemSettings\Teams)
                    ->addLink(new \App\Navigation\Link\SystemSettings\Teams\Show($team))
                    ->setCurrentLocation(__('app.edit')),
])

@section('content')
    <h1>
        <span class="fas fa-user-friends"></span> {{ __('admin.editTeam') }}
    </h1>

    <p class="text-muted">{{ __('admin.editTeam_shortDescription') }}</p>

    <div class="card">
        <div class="card-body">

            @include('admin.teams._form', [
                'action' => route('admin.teams.update', [$team]),
                'method' => 'PUT',
            ])

        </div>
    </div>
@endsection
