@extends("layouts.settings")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Settings\Index),
])

@section('my-settings-content')

    <h2>{{ __('settings.details') }}</h2>

    <form action="{{ route('my-settings.update') }}" method="POST" class="bold-labels">
        @csrf

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

        <hr>

        <button type="submit" class="btn btn-primary">
            {{ __('app.save') }}
        </button>

    </form>

@endsection
