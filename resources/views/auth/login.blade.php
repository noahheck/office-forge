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
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @emailField([
                            'name' => 'email',
                            'label' => __('app.email'),
                            'details' => '',
                            'value' => old('email'),
                            'placeholder' => __('app.email'),
                            'required' => true,
                            'autofocus' => 'true',
                            'error' => $errors->has('email'),
                            'readonly' => false,
                        ])

                        @passwordField([
                            'name' => 'password',
                            'label' => __('app.password'),
                            'details' => '',
                            'value' => '',
                            'placeholder' => __('app.password'),
                            'required' => true,
                            'autofocus' => false,
                            'error' => $errors->has('password'),
                        ])

                        <div class="d-flex align-items-center">

                            <div class="flex-fill">

                                @checkboxField([
                                    'name' => 'remember',
                                    'id' => 'remember',
                                    'label' => __('app.rememberMe'),
                                    'details' => '',
                                    'checked' => old('remember', false),
                                    'value' => '1',
                                    'required' => false,
                                    'error' => $errors->has('remember'),
                                    'readonly' => false,
                                ])

                            </div>

                            <div class="flex-fill">

                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('app.login') }}
                                </button>

                            </div>

                        </div>

                        {{-- Removing this until security policy is implemented --}}
                        @if (false && Route::has('password.request'))
                            <hr>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
