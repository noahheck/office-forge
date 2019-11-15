<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12 col-md-6">

            @errors('name', 'job_title', 'email', 'timezone')

            @textField([
                'name' => 'name',
                'label' => 'Name',
                'value' => old('name', $user->name),
                'placeholder' => 'John Doe',
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('name'),
            ])

            @textField([
                'name' => 'job_title',
                'label' => 'Job Title',
                'value' => old('job_title', $user->job_title),
                'placeholder' => 'President',
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('job_title'),
            ])

            @emailField([
                'name' => 'email',
                'label' => 'Email',
                'value' => old('email', $user->email),
                'placeholder' => 'john.doe@example.com',
                'required' => true,
                'autofocus' => false,
                'error' => $errors->has('email'),
            ])

            @selectField([
                'name' => 'timezone',
                'label' => 'Timezone',
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
                        'label' => 'Password',
                        'value' => '',
                        'placeholder' => 'Choose a strong password',
                        'required' => $passwordRequired ?? true,
                        'autofocus' => false,
                        'error' => $errors->has('password'),
                    ])

                    @passwordField([
                        'name' => 'password_confirmation',
                        'label' => 'Confirm Password',
                        'value' => '',
                        'placeholder' => 'Same as above',
                        'required' => $passwordRequired ?? true,
                        'autofocus' => false,
                        'error' => $errors->has('password_confirmation'),
                    ])

                </div>
            </div>

            <hr>

            @checkboxSwitchField([
                'name' => 'active',
                'label' => 'Active',
                'details' => 'Allow this user to log in and access the system',
                'checked' => old('active', $user->active),
                'required' => false,
                'error' => false,
            ])

            @checkboxSwitchField([
                'name' => 'administrator',
                'label' => 'Administrator',
                'details' => 'This user is an administrator. They\'re able to make changes to how the system functions, including managing users.',
                'checked' => old('administrator', $user->administrator),
                'required' => false,
                'error' => false,
            ])

            @checkboxSwitchField([
                'name' => 'system_administrator',
                'label' => 'System Administrator',
                'details' => 'This user is able to configure technical aspects of the system, including installing and activating/deactivating modules, and downloading or restoring backups.',
                'checked' => old('system_administrator', $user->system_administrator),
                'required' => false,
                'error' => false,
            ])

        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        Save
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.users.index')) }}">
        Cancel
    </a>

</form>
