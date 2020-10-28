@extends("files.file_resource")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\Show($fileType, $file, $drive)),
])


@section('resource-content')

    <div class="card shadow document drag-drop-file-upload-target" data-controller="drag-drop-file-upload" data-target="drag-drop-file-upload.container">

        <form action="{{ route('files.drives.upload-files', [$file, $drive]) }}" class="drag-drop-file-upload-form" method="POST" enctype="multipart/form-data" data-target="drag-drop-file-upload.form">

            @csrf

            @hiddenField([
                'name' => 'return',
                'value' => url()->current(),
            ])

            <input type="file" id="files_input" name="files" class="d-none show-for-sr" multiple>

            <label for="files_input">
                {!! nl2br(e(__('fileStore.dropFilesToTarget', ['target' => $drive->name]))) !!}
            </label>

            <span class="files-are-uploading-indicator">
                        {!! \App\icon\spinner(['fa-spin']) !!}
                    </span>

        </form>

        <div class="card-body">

            <h2>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h2>

            <hr>

            @if ($drive->description || $drive->teams->count() > 0)
                <p>{!! nl2br(e($drive->description)) !!}</p>

                @foreach ($drive->teams as $team)
                    {!! $team->icon() !!}
                @endforeach

                <hr>
            @endif

            <div class="text-right">

                <a href="{{ route('files.drives.mediaFiles.create', [$file, $drive]) }}" class="btn btn-primary btn-sm">
                    {!! \App\icon\mediaFileUpload(['mr-2']) !!}{{ __('fileStore.uploadFile') }}
                </a>

                <a href="{{ route('files.drives.folders.create', [$file, $drive]) }}" class="btn btn-primary btn-sm">
                    {!! \App\icon\folderPlus(['mr-2']) !!}{{ __('fileStore.addFolder') }}
                </a>
            </div>

            @if ($drive->topLevelFoldersForFile($file)->count() > 0
                || $drive->topLevelMediaFilesForFile($file)->count() > 0)
                @include('files.drives._folders-and-files', [
                    'folders' => $drive->topLevelFoldersForFile($file)->get(),
                    'mediaFiles' => $drive->topLevelMediaFilesForFile($file)->get(),
                ])
            @else
                @include('files.drives._no-folders-or-files')
            @endif

        </div>

    </div>

@endsection
