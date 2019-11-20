@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user-plus"></span> {{ __('admin.newUser') }}
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
