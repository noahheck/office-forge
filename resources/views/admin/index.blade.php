@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-cogs"></span> Settings
    </h1>

    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <a href="{{ route('admin.users.index') }}"><span class="fa-fw fas fa-users"></span> Users</a> - Setup the users of the system
                </li>
            </ul>
        </div>
    </div>
@endsection
