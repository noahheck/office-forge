@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user-plus"></span> New User
    </h1>

    <p class="text-muted">Add a new user to the system</p>

    <div class="card">
        <div class="card-body">

            @include('admin.users._form', [
                'action' => route('admin.users.store'),
            ])

        </div>
    </div>
@endsection
