@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Files\Edit($file),
])

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-folder-open"></span> {{ __('admin.editFile') }}
            </h1>

            <p class="text-muted">{{ __('admin.editFile_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.files._form', [
                        'action' => route('admin.files.update', [$file]),
                        'method' => 'PUT',
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
