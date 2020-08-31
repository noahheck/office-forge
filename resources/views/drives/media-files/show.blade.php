@extends("layouts.app")

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
{{--    @script('js/page.drives.files.show.js')--}}
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
                        <div class="btn-group dropup">
                            <a class="btn btn-primary btn-sm" href="{{ route('drives.files.edit', [$drive, $mediaFile]) }}">
                                {!! \App\icon\edit(['mr-2']) !!}{{ __('fileStore.editFile') }}
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">{{ __('app.moreOptions') }}</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form id="deleteFileForm" action="{{ route('drives.files.destroy', [$drive, $mediaFile]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $mediaFile->name }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">
                                        {!! \App\icon\trash(['mr-2']) !!}{{ __('fileStore.deleteFile') }}
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
