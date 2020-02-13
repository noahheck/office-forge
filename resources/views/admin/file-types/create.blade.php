@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Create(),
])

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-folder-open"></span> {{ __('admin.newFileType') }}
            </h1>

            <p class="text-muted">{{ __('admin.newFileType_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.file-types._form', [
                        'action' => route('admin.file-types.store'),
                    ])

                </div>
            </div>

        </div>
    </div>

@endsection
