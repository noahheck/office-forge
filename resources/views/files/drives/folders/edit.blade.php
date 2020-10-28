@extends("files.file_resource")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\Folders\Edit($file, $fileType, $drive, $folder)),
])

@section('resource-content')

    <h1>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h1>

    <div class="card shadow document">
        <div class="card-body">

            <h2>{!! \App\icon\folder(['mr-2']) !!}{{ __('fileStore.editFolder') }}</h2>

            <hr>

            @include('files.drives.folders._form', [
                'action' => route('files.drives.folders.update', [$file, $drive, $folder]),
                'method' => 'PUT',
            ])

        </div>

    </div>

@endsection
