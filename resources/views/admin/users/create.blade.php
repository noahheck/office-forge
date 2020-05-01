@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Users\Create,
])

@section('content')
    <h1>
        {!! \App\icon\userPlus(['mr-2']) !!} {{ __('admin.newUser') }}
    </h1>

    <p class="text-muted">{{ __('admin.newUser_shortDescription') }}</p>

    <div class="card">
        <div class="card-body">

            @include('admin.users._form', [
                'action' => route('admin.users.store'),
            ])

        </div>
    </div>
@endsection
