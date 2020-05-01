@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Teams\Create(),
])

@section('content')
    <h1>
        {!! \App\icon\teams(['mr-2']) !!}{{ __('admin.newTeam') }}
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
