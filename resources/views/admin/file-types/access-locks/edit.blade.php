@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\AccessLocks\Edit($fileType, $accessLock),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\accessLock(['mr-2']) !!}{{ __('admin.editAccessLock') }}
            </h1>

            <p class="text-muted">{{ __('admin.editAccessLock_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.file-types.access-locks._form', [
                        'action' => route('admin.file-types.access-locks.update', [$fileType, $accessLock]),
                        'method' => 'PUT',
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
