<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12 col-md-6">

            @errors('name')

            @textField([
                'name' => 'name',
                'label' => __('team.name'),
                'value' => old('name', $team->name),
                'placeholder' => __('team.nameExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

        </div>

        <div class="col-12">

            <hr>

            <p><strong>{{ __('app.members') }}</strong>: {{ __('admin.team_selectMembers') }}</p>

            <div class="table-responsive">
                <table id="users" class="table table-sm table-striped table-bordered dt-table" data-order='[[ 2, "asc" ]]' data-columns='[{"orderable": false}, {"orderable": false}, null, null, null]'>
                    <thead>
                    <tr>
                        <th class="w-50p text-center">{{ __('app.member') }}</th>
                        <th class="w-50p">&nbsp;</th>
                        <th>{{ __('user.name') }}</th>
                        <th>{{ __('user.jobTitle') }}</th>
                        <th class="w-50p">{{ __('user.active') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center">
                                    @checkboxSwitchField([
                                        'name' => 'members[]',
                                        'id' => 'member_' . $user->id,
                                        'label' => '',
                                        'checked' => $user->isMemberOf($team),
                                        'value' => $user->id,
                                        'required' => false,
                                        'error' => false,
                                    ])
                                </td>
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
                                <td data-sort="{{ $user->name }}">
                                    {!! $user->iconAndName() !!}
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

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.teams.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
