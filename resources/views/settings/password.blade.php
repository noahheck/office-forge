@extends("layouts.settings")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\Settings\MySettings)
                    ->setCurrentLocation(__('settings.password')),
])

@section('my-settings-content')

    <h2>{{ __('settings.changeYourPassword') }}</h2>

    <form action="{{ route('my-settings.password.update') }}" method="POST" class="bold-labels">
        @csrf

        @errors('current_password', 'new_password', 'new_password_confirmation')

        @passwordField([
            'name' => 'current_password',
            'label' => __('user.currentPassword'),
            'value' => '',
            'placeholder' => __('user.currentPassword'),
            'required' => true,
            'autofocus' => false,
            'error' => $errors->has('current_password'),
        ])

        @passwordField([
            'name' => 'new_password',
            'label' => __('user.newPassword'),
            'value' => '',
            'placeholder' => __('user.chooseStrongPassword'),
            'required' => true,
            'autofocus' => false,
            'error' => $errors->has('new_password'),
        ])

        @passwordField([
            'name' => 'new_password_confirmation',
            'label' => __('user.confirmPassword'),
            'value' => '',
            'placeholder' => __('user.sameAsAbove'),
            'required' => true,
            'autofocus' => false,
            'error' => $errors->has('new_password_confirmation'),
        ])

        <hr>

        <button type="submit" class="btn btn-warning">
            {{ __('user.updatePassword') }}
        </button>

    </form>

@endsection
