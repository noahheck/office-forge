@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-cogs"></span> {{ __('admin.systemSettings') }}
    </h1>

    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <a href="{{ route('admin.users.index') }}"><span class="fa-fw fas fa-users"></span> {{ __('admin.users') }}</a> - {{ __('admin.setUpSystemUsers') }}
                </li>
                <li>
                    <a href="{{ route('admin.teams.index') }}"><span class="fa-fw fas fa-user-friends"></span> {{ __('app.teams') }}</a> - {{ __('admin.organizeStaffIntoGroups') }}
                </li>
            </ul>
        </div>
    </div>
@endsection
