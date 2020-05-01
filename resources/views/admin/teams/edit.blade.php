@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Teams\Edit($team),
])

@section('content')
    <h1>
        {!! \App\icon\teams(['mr-2']) !!}{{ __('admin.editTeam') }}
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
