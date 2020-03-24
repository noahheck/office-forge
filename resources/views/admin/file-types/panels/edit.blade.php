@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Panels\Edit($fileType, $panel),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-th-list"></span> {{ __('admin.editPanel') }}
            </h1>

            <p class="text-muted">{{ __('admin.editPanel_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.file-types.panels._form', [
                        'action' => route('admin.file-types.panels.update', [$fileType, $panel]),
                        'method' => 'PUT',
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
