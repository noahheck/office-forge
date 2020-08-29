@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\Folders\Show($drive, $folder)),
])

@section('content')

    <div class="row project justify-content-center document-print-container folder-show">

        <div class="col-12 col-md-10 document-container">

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

                            <a class="btn btn-primary btn-sm" href="{{ route('drives.folders.edit', [$drive, $folder]) }}">
                                {!! \App\icon\edit(['mr-2']) !!}{{ __('fileStore.editFolder') }}
                            </a>

                        </div>

                    </div>

                    <hr>

                    <div class="list-group parent-folder-list-group mb-3">

                        @if ($parent = $folder->parentFolder)
                            <a class="list-group-item list-group-item-action" href="{{ route('drives.folders.show', [$drive, $parent]) }}">
                                {!! \App\icon\folderUp(['mr-2']) !!}../{!! \App\icon\folder(['ml-2', 'mr-2']) !!}{{ $parent->name }}
                            </a>
                        @else
                            <a class="list-group-item list-group-item-action" href="{{ route('drives.show', [$folder->drive]) }}">
                                {!! \App\icon\folderUp(['mr-2']) !!}../{!! \App\icon\drive(['ml-2', 'mr-2']) !!}{{ $folder->drive->name }}
                            </a>
                        @endif

                    </div>

                    <div class="text-right mb-3">

                        <a href="{{ route('drives.files.create', [$drive, 'folder_id' => $folder->id]) }}" class="btn btn-primary btn-sm">
                            {!! \App\icon\mediaFileUpload(['mr-2']) !!}{{ __('fileStore.uploadFile') }}
                        </a>

                        <a class="btn btn-primary btn-sm" href="{{ route('drives.folders.create', [$drive, 'parent_folder_id' => $folder->id]) }}">
                            {!! \App\icon\folderPlus(['mr-2']) !!}{{ __('fileStore.addFolder') }}
                        </a>
                    </div>

                    @include('drives._folders-and-files', [
                        'folders' => $folder->folders,
                        'mediaFiles' => $folder->mediaFiles,
                    ])

                </div>

            </div>

        </div>

    </div>

@endsection
