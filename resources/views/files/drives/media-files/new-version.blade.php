@extends("files.file_resource")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\MediaFiles\NewVersion($file, $fileType, $drive, $mediaFile)),
])

@section('resource-content')

    <h1>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h1>

    @foreach ($drive->teams as $team)

        @if ($loop->first)
            <p>
                <small>
            @endif
                {!! $team->icon() !!}
            @if ($loop->last)
                </small>
            </p>
        @endif

    @endforeach

    <div class="card shadow document">
        <div class="card-body">

            <h2>{!! $mediaFile->icon(['mr-2']) !!}{{ $mediaFile->name }}</h2>

            <hr>

            @include('drives.media-files._form', [
                'action' => route('files.drives.mediaFiles.upload-new-version', [$file, $drive, $mediaFile]),
                'method' => 'PUT',
                'upload' => true,
                'moreOptions' => false,
            ])

        </div>

    </div>

@endsection
