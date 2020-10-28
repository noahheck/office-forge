@extends("files.file_resource")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\MediaFiles\Index($file, $fileType, $drive)),
])

@section('resource-content')

    <div class="card shadow document">
        <div class="card-body">

            <h2>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h2>

            <hr>

            <p>{!! nl2br(e($drive->description)) !!}</p>

            @foreach ($drive->teams as $team)
                {!! $team->icon() !!}
            @endforeach

            <hr>

            <h3>{!! \App\icon\mediaFile(['mr-2']) !!}{{ __('fileStore.files') }}</h3>

            @forelse ($drive->topLevelMediaFilesForFile($file)->get() as $mediaFile)

                @if($loop->first)
                    <div class="list-group mt-2">
                @endif

                    <a class="list-group-item list-group-item-action" href="{{ route('files.drives.mediaFiles.show', [$file, $drive, $mediaFile]) }}">
                        {!! \App\icon\mediaFile(['mr-2']) !!}{{ $mediaFile->name }}
                    </a>

                @if ($loop->last)
                    </div>
                @endif

            @empty

                <p><em>{{ __('fileStore.noFiles') }}</em></p>

                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('files.drives.files.create', [$file, $drive]) }}">
                        {{ __('fileStore.uploadFileNow') }}
                    </a>
                </p>

            @endforelse

        </div>

    </div>

@endsection
