{{--

--}}
<div class="resource-files-cards-container row">
    @foreach ($resourceFiles as $file)
        <div class="col-6 col-sm-4 col-lg-3 ssscol-xl-2">

            <div class="resource-file" title="{{ $file->name }}">
                <div class="thumbnail-container">
                    {!! $file->thumbnail(['resource-file-thumbnail']) !!}
                </div>
                <div class="title">
                    {{ $file->name }}
                </div>
                <div class="actions d-flex">
                    <a class="flex-grow-1" href="{{ route('resource-files.download', [$file, $file->name]) }}" title="{{ __('app.download') }}">
                        {!! \App\icon\mediaFileDownload() !!}
                        <span class="sr-only">{{ __('app.download') }}</span>
                    </a>
                    @if ($file->canPreviewInBrowser())
                        <a class="flex-grow-1" href="{{ route('resource-files.preview', [$file, $file->name]) }}" target="_blank" title="{{ __('app.preview') }}">
                            {!! \App\icon\mediaFilePreview() !!}
                            <span class="sr-only">{{ __('app.preview') }}</span>
                        </a>
                    @endif
                </div>
            </div>

        </div>
    @endforeach
</div>
