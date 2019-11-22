<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12 col-md-6">

            <div class="user-photo">
                {!! $user->thumbnail(['rounded', 'shadow']) !!}
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

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.users.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
