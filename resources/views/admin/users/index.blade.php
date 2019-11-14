@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-users-cog"></span> Users
    </h1>

    <div class="card">
        <div class="card-body">
            {{--<ul>
                <li>
                    <a href="{{ route('admin.users.index') }}"><span class="fa-fw fas fa-users"></span> Users</a> - Setup the users of the system
                </li>
            </ul>--}}

            <div class="table-responsive">
                <table id="users" class="table table-striped dt-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Administrator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($x = 0; $x < 15; $x++)
                            @foreach($users as $user)
                                <tr>
                                    <td><a href="{{ route('admin.users.edit', [$user]) }}">{{ Arr::random(['Noah Heck', 'Heidi Heck', 'Scott Jones', 'Percival Anaroty', 'Peter Wilson']) }}{{--{{ $user->name }}--}}</a></td>
                                    <td>{{ Arr::random(['CEO', 'Programmer', 'Developer', 'Owner', 'Director of Development', 'Store Manager']) }}</td>
                                    <td>1</td>
                                </tr>
                            @endforeach
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
