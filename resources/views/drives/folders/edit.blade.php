@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\Folders\Edit($drive, $folder)),
])

@section('content')

    <div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h1>

            <div class="card shadow document">
                <div class="card-body">

                    <h2>{!! \App\icon\folder(['mr-2']) !!}{{ __('fileStore.editFolder') }}</h2>

                    <hr>

                    @include('drives.folders._form', [
                        'action' => route('drives.folders.update', [$drive, $folder]),
                        'method' => 'PUT',
                    ])

                </div>

            </div>
        </div>

    </div>

@endsection
