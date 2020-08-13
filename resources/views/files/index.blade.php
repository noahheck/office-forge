@extends("layouts.app")

@push('styles')
    @style('css/files.css')
@endpush

@push('scripts')
    @script('js/page.files.index.js')
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

        @if ($files->count() > 0)

            <div class="card shadow">
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('files.create', ['file_type' => $fileType->id]) }}" class="btn btn-primary">
                            {{--<span class="fas fa-plus"></span>--}}{!! \App\icon\circlePlus(['mr-1']) !!}{{ __('app.new') }} {{ $fileType->name }}
                        </a>
                    </div>
                    <hr>

                    <div class="table-responsive" id="filesTableContainer">
                        <table id="files" class="table table-striped table-bordered dt-table">
                            <thead>
                            <tr>
                                <th>{{ __('file.name') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($files as $file)
                                    @can('view', $file)
                                        <tr>
                                            <td data-sort="{{ $file->name }}">
                                                <a href="{{ route('files.show', [$file]) }}">
                                                    {!! $file->name !!}
                                                </a>
                                            </td>
                                        </tr>
                                    @endcan
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
            {!! \App\icon\files(['mr-2']) !!}{{ __('app.files') }}
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
