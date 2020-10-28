@extends("files.file_resource")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\MediaFiles\Create($fileType, $file, $drive, $mediaFile)),
])

@section('resource-content')

    <h1>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h1>

    <div class="card shadow document">
        <div class="card-body">

            <h2>{!! \App\icon\mediaFile(['mr-2']) !!}{{ __('fileStore.uploadFile') }}</h2>

            <hr>

            @include('files.drives.media-files._form', [
                'action' => route('files.drives.mediaFiles.store', [$file, $drive]),
                'upload' => true,
            ])

        </div>

    </div>

@endsection
