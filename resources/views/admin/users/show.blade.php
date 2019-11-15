@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user"></span> {{ $user->name }}
    </h1>

{{--    <p class="text-muted">Add a new user to the system</p>--}}

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
            {{--<form action="{{ route('admin.users.store') }}" method="POST" class="bold-labels">
                @csrf

                <div class="row">

                    <div class="col-12 col-md-6">

                        @textField([
                            'name' => 'name',
                            'label' => 'Name',
                            'value' => old('name', $user->name),
                            'placeholder' => 'John Doe',
                            'required' => true,
                            'autofocus' => true,
                            'error' => false,
                        ])

                        @textField([
                            'name' => 'job_title',
                            'label' => 'Job Title',
                            'value' => old('job_title', $user->job_title),
                            'placeholder' => 'President',
                            'required' => false,
                            'autofocus' => false,
                            'error' => false,
                        ])

                        @emailField([
                            'name' => 'email',
                            'label' => 'Email',
                            'value' => old('email', $user->email),
                            'placeholder' => 'john.doe@example.com',
                            'required' => true,
                            'autofocus' => false,
                            'error' => false,
                        ])

                        @selectField([
                            'name' => 'timezone',
                            'label' => 'Timezone',
                            'value' => old('timezone', $user->timezone),
                            'options' => \App\timezone_options(),
                            'required' => true,
                            'autofocus' => false,
                            'error' => false,
                        ])

                        <hr class="d-md-none">

                    </div>

                    <div class="col-12 col-md-6">

                        @passwordField([
                            'name' => 'password',
                            'label' => 'Password',
                            'value' => '',
                            'placeholder' => 'Choose a strong password',
                            'required' => true,
                            'autofocus' => false,
                            'error' => false,
                        ])

                        @passwordField([
                            'name' => 'password_confirmation',
                            'label' => 'Confirm Password',
                            'value' => '',
                            'placeholder' => 'Same as above',
                            'required' => true,
                            'autofocus' => false,
                            'error' => false,
                        ])

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

            </form>--}}
        </div>
    </div>
@endsection
