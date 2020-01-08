@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Html\LocationBar())
                    ->addLink(new \App\Html\LocationBar\Link\SystemSettings)
                    ->setCurrentLocation(__('admin.users')),
])

@section('content')
    <h1>
        <span class="fas fa-users-cog"></span> {{ __('admin.users') }}
    </h1>

    <div class="card">
        <div class="card-body">
            <div class="text-right">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <span class="fas fa-user-plus"></span> {{ __('admin.newUser') }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="users" class="table table-striped table-bordered dt-table" data-order='[[ 1, "asc" ]]' data-columns='[{"orderable": false}, null, null, null]'>
                    <thead>
                        <tr>
                            <th class="w-50p">&nbsp;</th>
                            <th>{{ __('user.name') }}</th>
                            <th>{{ __('user.jobTitle') }}</th>
                            <th class="w-50p">{{ __('user.active') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>

                                    {!!
                                        ($user->administrator)
                                        ? "<span class='fa-fw fas fa-user-tie' title='" . __('user.administrator') . "'></span>"
                                        : ""
                                    !!}

                                    {!!
                                        ($user->system_administrator)
                                        ? "<span class='fa-fw fas fa-user-cog' title='" . __('user.systemAdministrator') . "'></span>"
                                        : ""
                                    !!}

                                </td>
                                <td data-sort="{{ $user->name }}">
                                    <a href="{{ route('admin.users.edit', [$user]) }}">
                                        {!! $user->iconAndName() !!}
                                    </a>
                                </td>
                                <td>{{ $user->job_title }}</td>
                                <td class="text-center" data-order="{{ $user->active ? '1' : '0' }}"><span class="far fa{{ ($user->active) ? '-check' : '' }}-square"></span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
