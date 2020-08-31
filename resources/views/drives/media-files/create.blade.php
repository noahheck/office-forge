@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\MediaFiles\Create($drive)),
])

@section('content')

    <div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h1>

            <div class="card shadow document">
                <div class="card-body">

                    <h2>{!! \App\icon\mediaFile(['mr-2']) !!}{{ __('fileStore.uploadFile') }}</h2>

                    <hr>

                    @include('drives.media-files._form', [
                        'action' => route('drives.files.store', [$drive]),
                        'upload' => true,
                    ])

                </div>

            </div>
        </div>

    </div>

@endsection
