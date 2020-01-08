@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Users)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Users\Show($user))
                    ->setCurrentLocation(__('app.edit')),
])

@section('content')
    <h1>
        <span class="fas fa-user-edit"></span> {{ __('admin.editUser') }}
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
