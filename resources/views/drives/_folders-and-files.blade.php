@if ($folders->count() > 0 || $mediaFiles->count() > 0)
    @php
        $listOpened = true;
    @endphp
    <div class="list-group mt-2 files-and-folders-list-group">
@endif

@foreach ($folders as $folder)

    <a class="list-group-item list-group-item-action" href="{{ route('drives.folders.show', [$drive, $folder]) }}">
        {!! \App\icon\folder(['fa-fw', 'mr-2']) !!}{{ $folder->name }}
    </a>

@endforeach

@foreach ($mediaFiles as $file)

    <div class="list-group-item list-group-item-action d-flex media-file-item">
        <a href="{{ route('drives.files.show', [$drive, $file]) }}" class="flex-grow-1 media-file-link">
            {!! $file->icon(['fa-fw', 'mr-2']) !!}{{ $file->name }}
            <small class="text-muted">{{ \App\format_datetime($file->updated_at) }}</small>
        </a>
        <div class="flex-grow-0 media-file-options">
            @if ($file->canPreviewInBrowser())
                <a class="btn btn-primary btn-sm" target="_blank" href="{{ $file->previewUrl() }}" title="{{ __('app.preview') }}">
                    {!! \App\icon\mediaFilePreview(['fa-fw']) !!}
                    <span class="sr-only">{{ __('app.preview') }}</span>
                </a>
            @endif
            <a class="btn btn-primary btn-sm" href="{{ $file->downloadUrl() }}" title="{{ __('app.download') }}">
                {!! \App\icon\mediaFileDownload(['fa-fw']) !!}
                <span class="sr-only">{{ __('app.download') }}</span>
            </a>

        </div>
    </div>

@endforeach

@if ($listOpened ?? false)
    </div>
@endif
