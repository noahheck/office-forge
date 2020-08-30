@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\MediaFiles\Show($drive, $mediaFile)),
])

@section('content')

    <div class="row project justify-content-center document-print-container media-files-show">

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

                    <hr>

                    <div class="text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('drives.files.edit', [$drive, $mediaFile]) }}">
                            {!! \App\icon\edit(['mr-2']) !!}{{ __('fileStore.editFile') }}
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
