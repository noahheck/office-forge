@extends("layouts.admin")

@push('styles')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Server\PhpInfo),
])

@section('content')
    <h1>
        {!! \App\icon\php(['mr-2']) !!}{{ __('admin.server_php_phpinfo') }}
    </h1>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10">

            <div class="card">
                <div class="card-body">

                    <iframe srcdoc="{{ $phpInfo }}" style="height: 500px; width: 100%"></iframe>

                </div>

            </div>

        </div>

    </div>

@endsection
