@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Users\Edit($user),
])

@section('content')
    <h1>
        {!! \App\icon\userEdit(['mr-2']) !!}{{ __('admin.editUser') }}
    </h1>

    <p class="text-muted">{{ __('admin.editUser_shortDescription') }}</p>

    <div class="card">
        <div class="card-body">

            @include('admin.users._form', [
                'action' => route('admin.users.update', [$user]),
                'method' => 'PUT',
                'passwordRequired' => false,
                'passwordWarn' => true,
            ])

        </div>
    </div>
@endsection
