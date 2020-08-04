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

                    <h5>{{ __('app.setup.get-started-organization') }}</h5>

                    <p>{{ __('app.setup.organization-details') }}</p>

                    <hr>

                    <form method="POST" action="{{ route('server-setup.organization-save') }}">
                        @csrf

                        @errors('name', 'phone')

                        @textField([
                            'name' => 'name',
                            'label' => __('admin.organization_name'),
                            'value' => old('name', ''),
                            'placeholder' => '',
                            'required' => true,
                            'autofocus' => true,
                            'error' => $errors->has('name'),
                        ])

                        @phoneField([
                            'name' => 'phone',
                            'label' => __('admin.organization_phone'),
                            'details' => '',
                            'value' => old('phone', ''),
                            'required' => false,
                            'autofocus' => false,
                            'error' => $errors->has('phone'),
                            'readonly' => false,
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
