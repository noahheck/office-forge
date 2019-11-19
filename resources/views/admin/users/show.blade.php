@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user"></span> {{ $user->name }}
    </h1>

    <div class="card">
        <div class="card-body">
            <div class="text-right">
                <a href="{{ route('admin.users.edit', [$user]) }}" class="btn btn-primary">
                    <span class="fas fa-user-edit"></span> Edit User
                </a>
            </div>

            <div class="row">
                <div class="col-12">
                    <dl>

                        <dt>Name</dt>
                        <dd>{{ $user->name }}</dd>

                        <dt>Email</dt>
                        <dd><a href="mailto:{{ $user->email }}"><span class="fas fa-envelope"></span> {{ $user->email }}</a></dd>

                        <dt>Title</dt>
                        <dd>{{ $user->job_title }}</dd>

                        <dt>Timezone</dt>
                        <dd>{{ \App\timezone_name($user->timezone) }}</dd>

                    </dl>
                </div>
            </div>

        </div>
    </div>
@endsection
