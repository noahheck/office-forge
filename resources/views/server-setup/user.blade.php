@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6">
            <div class="card shadow">
                <div class="card-header d-flex">

                    <div class="mr-3">
                        <img src="/images/of_logo_50.png" alt="Office Forge Logo">
                    </div>

                    <h4 class="m-0 pt-2">Welcome to Office Forge!</h4>

                </div>

                <div class="card-body">

                    <h5>{{ __('app.setup.get-started-user') }}</h5>

                    <p>{{ __('app.setup.user-details') }}</p>

                    <hr>

                    <form method="POST" action="{{ route('server-setup.user-save') }}">
                        @csrf

                        @errors('name', 'job_title', 'email', 'timezone')

                        @textField([
                            'name' => 'name',
                            'label' => __('user.name'),
                            'value' => old('name', ''),
                            'placeholder' => __('user.nameExample'),
                            'required' => true,
                            'autofocus' => true,
                            'error' => $errors->has('name'),
                        ])

                        @textField([
                            'name' => 'job_title',
                            'label' => __('user.jobTitle'),
                            'value' => old('job_title', ''),
                            'placeholder' => __('user.jobTitleExample'),
                            'required' => false,
                            'autofocus' => false,
                            'error' => $errors->has('job_title'),
                        ])

                        @emailField([
                            'name' => 'email',
                            'label' => __('user.email'),
                            'value' => old('email', ''),
                            'placeholder' => __('user.emailExample'),
                            'required' => true,
                            'autofocus' => false,
                            'error' => $errors->has('email'),
                        ])

                        @selectField([
                            'name' => 'timezone',
                            'label' => __('user.timezone'),
                            'value' => old('timezone', ''),
                            'options' => \App\timezone_options(),
                            'required' => true,
                            'autofocus' => false,
                            'error' => $errors->has('timezone'),
                        ])

                        <hr>

                        <p>{{ __('app.setup.user-password-details') }}</p>

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

                        <hr>

                        <button type="submit" class="btn btn-primary">
                            {{ __('app.continue') }}
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
