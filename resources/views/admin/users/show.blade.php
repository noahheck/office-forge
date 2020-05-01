@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Users\Show($user),
])

@section('content')
    <h1>
        {!! \App\icon\user(['mr-2']) !!}{{ $user->name }}
    </h1>

    <div class="card">
        <div class="card-body">
            <div class="text-right">
                <a href="{{ route('admin.users.edit', [$user]) }}" class="btn btn-primary">
                    {!! \App\icon\userEdit(['mr-1']) !!}{{ __('admin.editUser') }}
                </a>
            </div>

            <div class="row">
                <div class="col-12">
                    <dl>

                        <dt>{{ __('user.name') }}</dt>
                        <dd>{{ $user->name }}</dd>

                        <dt>{{ __('user.email') }}</dt>
                        <dd><a href="mailto:{{ $user->email }}">{!! \App\icon\email(['mr-1']) !!}{{ $user->email }}</a></dd>

                        <dt>{{ __('user.jobTitle') }}</dt>
                        <dd>{{ $user->job_title }}</dd>

                        <dt>{{ __('user.timezone') }}</dt>
                        <dd>{{ \App\timezone_name($user->timezone) }}</dd>

                    </dl>
                </div>
            </div>

        </div>
    </div>
@endsection
