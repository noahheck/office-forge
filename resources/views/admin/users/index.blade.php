@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-users-cog"></span> Users
    </h1>

    <div class="card">
        <div class="card-body">
            <div class="text-right">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <span class="fas fa-user-plus"></span> New User
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="users" class="table table-striped table-bordered dt-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th class="w-50p">Active</th>
                            <th class="w-50p">Administrator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><a href="{{ route('admin.users.edit', [$user]) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->job_title }}</td>
                                <td class="text-center" data-order="{{ $user->active ? '1' : '0' }}"><span class="far fa{{ ($user->active) ? '-check' : '' }}-square"></span></td>
                                <td class="text-center" data-order="{{ $user->administrator ? '1' : '0' }}"><span class="far fa{{ ($user->administrator) ? '-check' : '' }}-square"></span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
