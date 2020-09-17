@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Users\Index,
])

@section('content')
    <h1>
        {!! \App\icon\users(['mr-2']) !!}{{ __('admin.users') }}
    </h1>

    <div class="card">
        <div class="card-body">
            <div class="text-right">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    {!! \App\icon\userPlus(['mr-1']) !!}{{ __('admin.newUser') }}
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
                                        ? \App\icon\userAdmin(['fa-fw'], __('user.administrator'))
                                        : ""
                                    !!}

                                    {!!
                                        ($user->system_administrator)
                                        ? \App\icon\userSystemAdmin(['fa-fw'], __('user.systemAdministrator'))
                                        : ""
                                    !!}

                                </td>
                                <td data-sort="{{ $user->name }}" data-search="{{ $user->name }}">
                                    <a href="{{ route('admin.users.edit', [$user]) }}">
                                        {!! $user->iconAndName() !!}
                                    </a>
                                </td>
                                <td>{{ $user->job_title }}</td>
                                <td class="text-center" data-order="{{ $user->active ? '1' : '0' }}">
                                    @if ($user->active)
                                        {!! \App\icon\checkedBox() !!}
                                    @else
                                        {!! \App\icon\uncheckedBox() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
