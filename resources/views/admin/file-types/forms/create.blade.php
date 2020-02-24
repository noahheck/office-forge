@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Create($fileType),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="far fa-list-alt"></span> {{ __('admin.newForm') }}
            </h1>

            <p class="text-muted">{{ __('admin.newForm_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.file-types.forms._form', [
                        'action' => route('admin.file-types.forms.store', [$fileType]),
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
