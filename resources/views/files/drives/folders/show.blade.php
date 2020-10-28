@extends("files.file_resource")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\Folders\Show($file, $fileType, $drive, $folder)),
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

    @can('editContents', $drive)
        <div class="card shadow document drag-drop-file-upload-target" data-controller="drag-drop-file-upload" data-target="drag-drop-file-upload.container">

            <form action="{{ route('files.drives.upload-files', [$file, $drive]) }}" class="drag-drop-file-upload-form" method="POST" enctype="multipart/form-data" data-target="drag-drop-file-upload.form">

                @csrf

                @hiddenField([
                    'name' => 'return',
                    'value' => url()->current(),
                ])

                @hiddenField([
                    'name' => 'folder_id',
                    'value' => $folder->id,
                ])

                <input type="file" id="files_input" name="files" class="d-none show-for-sr" multiple>

                <label for="files_input">
                    {!! nl2br(e(__('fileStore.dropFilesToTarget', ['target' => $folder->name]))) !!}
                </label>

                <span class="files-are-uploading-indicator">
                    {!! \App\icon\spinner(['fa-spin']) !!}
                </span>

            </form>
        @else
            <div class="card shadow document">
        @endcan

        <div class="card-body">

            <h2>{!! \App\icon\folder(['mr-2']) !!}{{ $folder->name }}</h2>

            <hr>

            <div class="d-flex">

                <div class="flex-grow-1">

                    <p>
                        @if ($description = $folder->description)
                            {!! nl2br(e($folder->description)) !!}
                        @else
                            <em>{{ __('fileStore.folder_noDescription') }}</em>
                        @endif
                    </p>

                </div>

                <div class="flex-grow-0">

                    @can('editContents', $drive)
                        <div class="btn-group">
                            <a class="btn btn-primary btn-sm" href="{{ route('files.drives.folders.edit', [$file, $drive, $folder]) }}">
                                {!! \App\icon\edit(['mr-2']) !!}{{ __('fileStore.editFolder') }}
                            </a>
                            @can('delete', $folder)
                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">{{ __('app.moreOptions') }}</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form id="deleteFolderForm" action="{{ route('files.drives.folders.destroy', [$file, $drive, $folder]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $folder->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            {!! \App\icon\trash(['mr-2']) !!}{{ __('fileStore.deleteFolder') }}
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    @endcan

                </div>

            </div>

            <hr>

            <div class="list-group parent-folder-list-group mb-3">

                @if ($parent = $folder->parentFolder)
                    <a class="list-group-item list-group-item-action" href="{{ route('files.drives.folders.show', [$file, $drive, $parent]) }}">
                        {!! \App\icon\folderUp(['mr-2']) !!}../{!! \App\icon\folder(['ml-2', 'mr-2']) !!}{{ $parent->name }}
                    </a>
                @else
                    <a class="list-group-item list-group-item-action" href="{{ route('files.drives.show', [$file, $folder->drive]) }}">
                        {!! \App\icon\folderUp(['mr-2']) !!}../{!! \App\icon\drive(['ml-2', 'mr-2']) !!}{{ $folder->drive->name }}
                    </a>
                @endif

            </div>

            @can('editContents', $drive)
                <div class="text-right mb-3">

                    <a href="{{ route('files.drives.mediaFiles.create', [$file, $drive, 'folder_id' => $folder->id]) }}" class="btn btn-primary btn-sm">
                        {!! \App\icon\mediaFileUpload(['mr-2']) !!}{{ __('fileStore.uploadFile') }}
                    </a>

                    <a class="btn btn-primary btn-sm" href="{{ route('files.drives.folders.create', [$file, $drive, 'parent_folder_id' => $folder->id]) }}">
                        {!! \App\icon\folderPlus(['mr-2']) !!}{{ __('fileStore.addFolder') }}
                    </a>
                </div>
            @endcan

            @if ($folder->folders->count() > 0 || $folder->mediaFiles->count() > 0)
                @include('files.drives._folders-and-files', [
                    'folders' => $folder->folders,
                    'mediaFiles' => $folder->mediaFiles,
                ])
            @else
                @include('files.drives._no-folders-or-files')
            @endif

        </div>

    </div>


@endsection
