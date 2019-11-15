@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user-edit"></span> Edit User
    </h1>

    <p class="text-muted">Edit an existing user of the system</p>

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
