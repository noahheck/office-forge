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

                    <h5>{{ __('app.setup.completed') }}</h5>

                    <p>{{ __('app.setup.continue-to-app') }}</p>

                    <hr>

                    <p class="text-center">
                        <a href="{{ route("home") }}" class="btn btn-primary">
                            {{ __('app.continue') }}
                        </a>
                    </p>

                    {{--<form method="POST" action="{{ route('server-setup.key') }}">
                        @csrf

                        @errors('key')

                        @passwordField([
                            'name' => 'key',
                            'label' => __('app.setup.key'),
                            'details' => '',
                            'value' => '',
                            'placeholder' => '',
                            'required' => true,
                            'autofocus' => true,
                            'error' => $errors->has('key'),
                        ])

                        <hr>

                        <button type="submit" class="btn btn-primary">
                            {{ __('app.continue') }}
                        </button>

                    </form>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
