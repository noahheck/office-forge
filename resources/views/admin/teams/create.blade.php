@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Teams\Create(),
])

@section('content')
    <h1>
        <span class="fas fa-user-plus"></span> {{ __('admin.newTeam') }}
    </h1>

    <p class="text-muted">{{ __('admin.newTeam_shortDescription') }}</p>

    <div class="card">
        <div class="card-body">

            @include('admin.teams._form', [
                'action' => route('admin.teams.store'),
            ])

        </div>
    </div>
@endsection
