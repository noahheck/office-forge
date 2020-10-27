@extends("layouts.app")

@push('styles')
{{--    @style('css/files.css')--}}
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\Show($fileType, $file, $drive)),
])

@section('content')

    <h4 class="h5 text-muted pl-3">{!! $fileType->icon() !!} - {{ $fileType->name }}</h4>

    <div class="row fileStore-index">

        <div class="col-12 col-md-4 col-xl-3 mb-3">

            <div class="card shadow mb-3">
                <div class="card-body">
                    <h3>{{ $file->name }}</h3>

                    <hr>

                    <div class="text-center">
                        {!! $file->thumbnail() !!}
                    </div>

                    <hr>

                    <a href="{{ route('files.show', [$file]) }}">
                        {!! \App\icon\goBack(['mr-2']) !!}{{ __('file.backToFileType', ['fileType' => $fileType->name]) }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-xl-9">






            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">





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

                                <a href="{{ route('drives.files.create', [$drive]) }}" class="btn btn-primary btn-sm">
                                    {!! \App\icon\mediaFileUpload(['mr-2']) !!}{{ __('fileStore.uploadFile') }}
                                </a>

                                <a href="{{ route('drives.folders.create', [$drive]) }}" class="btn btn-primary btn-sm">
                                    {!! \App\icon\folderPlus(['mr-2']) !!}{{ __('fileStore.addFolder') }}
                                </a>
                            </div>

                            @if ($drive->topLevelFoldersForFile($file)->get()->count() > 0
                                || $drive->topLevelMediaFilesForFile($file)->get()->count() > 0)
                                @include('files.drives._folders-and-files', [
                                    'folders' => $drive->topLevelFoldersForFile($file)->get(),
                                    'mediaFiles' => $drive->topLevelMediaFilesForFile($file)->get(),
                                ])
                            @else
                                @include('files.drives._no-folders-or-files')
                            @endif

                        </div>

                    </div>

                </div>
            </div>









        </div>

    </div>

@endsection
