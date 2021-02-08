@extends("layouts.app")

@section('title'){{ $drive->name }}@endsection

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@push('meta')
    @meta('driveId', $drive->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\Show($drive))
])

@section('content')

    <div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            @can('editContents', $drive)
                <div class="card shadow document drag-drop-file-upload-target" data-controller="drag-drop-file-upload" data-target="drag-drop-file-upload.container">

                    <form action="{{ route('drives.upload-files', [$drive]) }}" class="drag-drop-file-upload-form" method="POST" enctype="multipart/form-data" data-target="drag-drop-file-upload.form">

                        @csrf

                        @hiddenField([
                            'name' => 'return',
                            'value' => url()->current(),
                        ])

                        <input type="file" id="files_input" name="files" class="d-none show-for-sr" multiple data-target="drag-drop-file-upload.input">

                        <label for="files_input">
                            {!! nl2br(e(__('fileStore.dropFilesToTarget', ['target' => $drive->name]))) !!}
                        </label>

                        <span class="files-are-uploading-indicator">
                            {!! \App\icon\spinner(['fa-spin']) !!}
                        </span>

                    </form>

            @else
                <div class="card shadow document">
            @endcan

                <div class="card-body">

                    <h2>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h2>

                    <hr>

                    <p>{!! nl2br(e($drive->description)) !!}</p>

                    @foreach ($drive->teams as $team)
                        {!! $team->icon() !!}
                    @endforeach

                    <hr>

                    <div class="text-right">

                        @can('editContents', $drive)
                            <a href="{{ route('drives.files.create', [$drive]) }}" class="btn btn-primary btn-sm">
                                {!! \App\icon\mediaFileUpload(['mr-2']) !!}{{ __('fileStore.uploadFile') }}
                            </a>

                            <a href="{{ route('drives.folders.create', [$drive]) }}" class="btn btn-primary btn-sm">
                                {!! \App\icon\folderPlus(['mr-2']) !!}{{ __('fileStore.addFolder') }}
                            </a>
                        @endcan
                    </div>

                    @if ($drive->topLevelFolders->count() > 0 || $drive->topLevelMediaFiles->count() > 0)
                        @include('drives._folders-and-files', [
                            'folders' => $drive->topLevelFolders,
                            'mediaFiles' => $drive->topLevelMediaFiles,
                        ])
                    @else
                        @include('drives._no-folders-or-files')
                    @endif

                </div>

            </div>
        </div>

    </div>
@endsection
