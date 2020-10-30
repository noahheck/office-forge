@extends("files.file_resource")

@push('meta')
    @meta('driveId', $drive->id)
    @meta('fileId', $mediaFile->id)
    @meta('fileName', $mediaFile->name)
@endpush

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@push('scripts')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\MediaFiles\Show($file, $fileType, $drive, $mediaFile)),
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

            <div class="text-center">

                {!! $mediaFile->thumbnail([]) !!}

            </div>

            <hr>

            <p>
                @if ($description = $mediaFile->description)
                    {!! nl2br(e($mediaFile->description)) !!}
                @else
                    <em>{{ __('fileStore.file_noDescription') }}</em>
                @endif
            </p>

            <hr>

            <div class="d-flex">

                <div class="flex-grow-1">

                    <p>
                        <strong>{{ __('fileStore.file_updated') }}:</strong>
                        {{ \App\format_datetime($mediaFile->updated_at) }}
                    </p>

                    <p>
                        <strong>{{ __('fileStore.file_uploadedBy') }}:</strong>
                        {!! $mediaFile->uploadedBy->iconAndName(['mhw-35p']) !!}
                    </p>

                </div>

                <div class="flex-grow-0">

                    @if ($mediaFile->canPreviewInBrowser())
                        <a class="btn btn-primary btn-sm" target="_blank"  href="{{ $mediaFile->previewUrl() }}">
                            {!! \App\icon\mediaFilePreview(['mr-2']) !!}{{ __('app.preview') }}
                        </a>
                    @endif

                    <a class="btn btn-primary btn-sm" href="{{ $mediaFile->downloadUrl() }}">
                        {!! \App\icon\mediaFileDownload(['mr-2']) !!}{{ __('app.download') }}
                    </a>

                </div>

            </div>

            @can('update', $mediaFile)

                <hr>

                <div class="text-right">
                    <div class="btn-group dropup">
                        <a class="btn btn-primary btn-sm" href="{{ route('files.drives.mediaFiles.edit', [$file, $drive, $mediaFile]) }}">
                            {!! \App\icon\edit(['mr-2']) !!}{{ __('fileStore.editFile') }}
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">{{ __('app.moreOptions') }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('files.drives.mediaFiles.new-version', [$file, $drive, $mediaFile]) }}">
                                {!! \App\icon\mediaFileUpload(['fa-fw', 'mr-2']) !!}{{ __('fileStore.file_uploadNewVersion') }}
                            </a>
                            @if ($mediaFile->versions()->count() > 1)
                                <a class="dropdown-item" href="{{ route('files.drives.mediaFiles.all-versions', [$file, $drive, $mediaFile]) }}">
                                    {!! \App\icon\history(['fa-fw', 'mr-2']) !!}{{ __('fileStore.file_seeAllVersions') }}
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <form id="deleteFileForm" action="{{ route('files.drives.mediaFiles.destroy', [$file, $drive, $mediaFile]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $mediaFile->name }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">
                                    {!! \App\icon\trash(['mr-2']) !!}{{ __('fileStore.deleteFile') }}
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            @endcan

        </div>

    </div>

@endsection
