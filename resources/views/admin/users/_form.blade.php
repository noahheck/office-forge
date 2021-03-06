<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <ul class="nav nav-tabs" id="userNavTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">{!! \App\icon\myDetails(['mr-2']) !!}{{ __('user.details') }}</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="access-tab" data-toggle="tab" href="#access" role="tab" aria-controls="access" aria-selected="false">{!! \App\icon\accessKey(['mr-2']) !!}{{ __('admin.accessKeys') }}</a>
        </li>
    </ul>

    <div class="tab-content pt-3" id="userNavContent">

        <div class="tab-pane show active" id="details" role="tabpanel" aria-labelledby="details-tab">

            <div class="row">

                <div class="col-12 col-md-6">

                    <div class="user-photo">
                        {!! $user->thumbnail(['rounded']) !!}
                    </div>

                    @errors('name', 'job_title', 'email', 'timezone')

                    @textField([
                        'name' => 'name',
                        'label' => __('user.name'),
                        'value' => old('name', $user->name),
                        'placeholder' => __('user.nameExample'),
                        'required' => true,
                        'autofocus' => true,
                        'error' => $errors->has('name'),
                    ])

                    @textField([
                        'name' => 'job_title',
                        'label' => __('user.jobTitle'),
                        'value' => old('job_title', $user->job_title),
                        'placeholder' => __('user.jobTitleExample'),
                        'required' => false,
                        'autofocus' => false,
                        'error' => $errors->has('job_title'),
                    ])

                    @emailField([
                        'name' => 'email',
                        'label' => __('user.email'),
                        'value' => old('email', $user->email),
                        'placeholder' => __('user.emailExample'),
                        'required' => true,
                        'autofocus' => false,
                        'error' => $errors->has('email'),
                    ])

                    @selectField([
                        'name' => 'timezone',
                        'label' => __('user.timezone'),
                        'value' => old('timezone', $user->timezone),
                        'options' => \App\timezone_options(),
                        'required' => true,
                        'autofocus' => false,
                        'error' => $errors->has('timezone'),
                    ])

                    <hr class="d-md-none">

                </div>

                <div class="col-12 col-md-6">

                    <div class="card">
                        <div class="card-body">

                            @if($passwordWarn ?? false)
                                <p><strong>Enter a password only if you want to change their existing password</strong></p>
                                <hr>
                            @endif

                            @errors('password', 'password_confirmation')

                            @passwordField([
                                'name' => 'password',
                                'label' => __('user.password'),
                                'value' => '',
                                'placeholder' => __('user.chooseStrongPassword'),
                                'required' => $passwordRequired ?? true,
                                'autofocus' => false,
                                'error' => $errors->has('password'),
                            ])

                            @passwordField([
                                'name' => 'password_confirmation',
                                'label' => __('user.confirmPassword'),
                                'value' => '',
                                'placeholder' => __('user.sameAsAbove'),
                                'required' => $passwordRequired ?? true,
                                'autofocus' => false,
                                'error' => $errors->has('password_confirmation'),
                            ])

                        </div>
                    </div>

                    <hr>

                    @checkboxSwitchField([
                        'name' => 'active',
                        'id' => 'active',
                        'label' => __('user.active'),
                        'details' => __('admin.active_shortDescription'),
                        'checked' => old('active', $user->active),
                        'required' => false,
                        'error' => false,
                    ])

                    @checkboxSwitchField([
                        'name' => 'administrator',
                        'id' => 'administrator',
                        'label' => __('user.administrator'),
                        'details' => __('admin.administrator_shortDescription'),
                        'checked' => old('administrator', $user->administrator),
                        'required' => false,
                        'error' => false,
                    ])

                    @checkboxSwitchField([
                        'name' => 'system_administrator',
                        'id' => 'system_administrator',
                        'label' => __('user.systemAdministrator'),
                        'details' => __('admin.systemAdministrator_shortDescription'),
                        'checked' => old('system_administrator', $user->system_administrator),
                        'required' => false,
                        'error' => false,
                    ])

                </div>

            </div>

        </div>

        <div class="tab-pane" id="access" role="tabpanel" aria-labelledby="access-tab">

            <p>{{ __('admin.accessKeys_description') }}</p>

            <hr>

            <p>{{ __('admin.accessKeys_selectForUser') }}</p>

            @foreach ($fileTypes as $fileType)

                @if ($loop->first)
                    <ul class="list-group">

                @endif

                    <li class="list-group-item">

                        <h5>{!! $fileType->icon(['mr-2']) !!}{{ Str::plural($fileType->name) }}</h5>

                        @multiSelectField([
                            'name' => 'accessKeys',
                            'label' => '',
                            'values' => $user->accessKeys,
                            'options' => $fileType->accessLocks->pluck('name', 'id'),
                            'placeholder' => __('file.accessKeys'),
                            'description' => '',
                            'required' => false,
                            'autofocus' => false,
                            'error' => false,
                        ])

                    </li>

                @if ($loop->last)
                    </ul>
                @endif
            @endforeach

        </div>
    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.users.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
