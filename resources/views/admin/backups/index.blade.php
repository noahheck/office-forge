@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Backups\Index,
])

@section('content')
    <h1>
        {!! \App\icon\backups(['mr-2']) !!}{{ __('admin.backups') }}
    </h1>

    <div class="card">
        <div class="card-body">
            <div class="text-right">
                <a href="{{ route('admin.backups.settings') }}" class="btn btn-primary">
                    {!! \App\icon\adminSettings(['mr-1']) !!}{{ __('admin.settings') }}
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
                        @foreach([] as $user)
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
