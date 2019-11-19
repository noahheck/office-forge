@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user-plus"></span> New Team
    </h1>

    <p class="text-muted">Create a new Team</p>

    <div class="card">
        <div class="card-body">

            @include('admin.teams._form', [
                'action' => route('admin.teams.store'),
            ])

        </div>
    </div>
@endsection
