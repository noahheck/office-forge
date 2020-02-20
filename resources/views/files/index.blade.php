@extends("layouts.app")

@push('styles')
    @style('css/files.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Index($fileType)),
])

@section('content')



    @if ($fileTypeFilter)
        {{--
            The files list has been filtered by a file_type, so show the filtered file type and either list the
            instances of those files or let the user create their first one
         --}}
        <h1>
            {!! $fileType->icon(['mr-2']) !!}{{ Str::plural($fileType->name) }}
        </h1>

        <hr>

        @if ($files->count() > 0)

            <data table></data>

        @else
            <div class="row justify-content-center no-files">
                <div class="col-12 col-sm-10 col-md-8 col-xl-6">
                    <div class="card shadow">
                        <div class="card-body text-center">

                            <div class="no-files-icon-container">
                                {!! $fileType->icon(['no-files-icon']) !!}
                            </div>

                            <p>{{ __('file.emptyFileType_description', ['fileTypeName' => $fileType->name]) }}</p>

                            <hr>

                            <a class="btn btn-primary" href="{{ route('files.create', ['file_type' => $fileType->id]) }}">{{ __('file.emptyFileType_openFirstNow', ['fileTypeName' => $fileType->name]) }}</a>

                        </div>
                    </div>
                </div>
            </div>
        @endif

    @else
        {{-- Overview page - list the different file types the user has access to --}}

        <h1>
            <span class="fas fa-folder-open mr-2"></span>{{ __('app.files') }}
        </h1>

        <hr>

        <div class="row">
            @foreach ($fileTypes as $fileType)

                <div class="col-6 col-md-4 col-lg-3 mb-3">
                    <a class="card shadow text-center text-reset" href="{{ route('files.index', ['file_type' => $fileType->id]) }}">
                        <div class="card-body">
                            <p>{!! $fileType->icon(['fa-4x']) !!}</p>

                            <hr>

                            <h4>{{ Str::plural($fileType->name) }}</h4>
                        </div>
                    </a>
                </div>

            @endforeach
        </div>

    @endif

@endsection
