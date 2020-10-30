@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\MediaFiles\Versions($drive, $mediaFile)),
])

@section('content')

    <div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container media-file--versions">

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

                    @if ($folder = $mediaFile->folder)

                        {!! \App\icon\folder(['mr-2']) !!}{{ $folder->name }}

                        <hr>

                    @endif

                    @foreach ($versions as $version)

                        <div class="card mb-2">
                            <div class="card-body d-flex">
                                <div class="flex-grow-0 icon-container">
                                    {!! $version->icon(['icon']) !!}
                                </div>
                                <div class="flex-grow-1">
                                    <h5>
                                        {{ $version->name }}
                                        @if ($version->current_version)
                                            <small class="text-success font-italic">{!! \App\icon\circleCheck(['']) !!} Current Version</small>
                                        @endif
                                    </h5>
                                    <p>
                                        {{ __('fileStore.file_uploadedBy') }}
                                        {!! $version->uploadedBy->iconAndName(['mhw-25p']) !!}
                                        {{ \App\format_datetime($version->created_at) }}
                                    </p>
                                    @if ($mediaFile->canPreviewInBrowser())
                                        <a class="btn btn-primary btn-sm" target="_blank"  href="{{ $version->previewUrl() }}">
                                            {!! \App\icon\mediaFilePreview(['mr-2']) !!}{{ __('app.preview') }}
                                        </a>
                                    @endif

                                    <a class="btn btn-primary btn-sm" href="{{ $version->downloadUrl() }}">
                                        {!! \App\icon\mediaFileDownload(['mr-2']) !!}{{ __('app.download') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </div>

    </div>

@endsection
