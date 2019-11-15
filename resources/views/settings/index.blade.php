@extends("layouts.settings")

@section('my-settings-content')

    <h3>Details</h3>

    <hr>

    <form action="{{ route('my-settings.update') }}" method="POST" class="bold-labels">
        @csrf

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

        <hr>

        <button type="submit" class="btn btn-primary">
            Save
        </button>

    </form>

@endsection
