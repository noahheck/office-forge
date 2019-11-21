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
                                    {!! $user->icon() !!} {{ $user->name }}
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

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.teams.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
