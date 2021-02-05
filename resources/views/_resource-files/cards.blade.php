{{--
Usage, e.g.:
@if ($activity->resourceFiles->count() > 0)
    @include("_resource-files.cards", [
        'resourceFiles' => $activity->resourceFiles,
    ])
@endif
--}}
@php
$resourceFiles->loadMissing('resource', 'headshots');
@endphp
<div class="resource-files-cards-container row">
    @foreach ($resourceFiles as $file)
        <div class="col-6 col-sm-4 col-lg-3">

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
                    @can('delete', $file)
                        <form action="{{ route('resource-files.delete', [$file]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $file->name }}">
                            @csrf
                            @method('DELETE')
                            @hiddenField([
                                'name' => 'return',
                                'value' => url()->current(),
                            ])
                            <button type="submit" class="flex-grow-0">
                                {!! \App\icon\trash() !!}
                                <span class="sr-only">{{ __('app.delete') }}</span>
                            </button>
                        </form>
                    @endcan
                </div>
            </div>

        </div>
    @endforeach
</div>
