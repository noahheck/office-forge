@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user-friends"></span> Edit Team
    </h1>

    <p class="text-muted">Edit a Team</p>

    <div class="card">
        <div class="card-body">

            @include('admin.teams._form', [
                'action' => route('admin.teams.update', [$team]),
                'method' => 'PUT',
            ])

        </div>
    </div>
@endsection
