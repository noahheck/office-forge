@extends("layouts.app")

@push('styles')
{{--    @style('css/files.css')--}}
{{--    @style('css/document.css')--}}
@style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\Index($fileType, $file)),
])

@section('content')

    <h4 class="h5 text-muted pl-3">{!! $fileType->icon() !!} - {{ $fileType->name }}</h4>

    <div class="row fileStore-index">

        <div class="col-12 col-md-4 col-xl-3 mb-3">

            <div class="card shadow mb-3">
                <div class="card-body">
                    <h3>{{ $file->name }}</h3>

                    <hr>

                    <div class="text-center">
                        {!! $file->thumbnail() !!}
                    </div>

                    <hr>

                    <a href="{{ route('files.show', [$file]) }}">
                        {!! \App\icon\goBack(['mr-2']) !!}{{ __('file.backToFileType', ['fileType' => $fileType->name]) }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-xl-9">

            <div class="row justify-content-center">

                @foreach ($drives as $drive)

                    <div class="col-12 col-xl-10 mb-2">

                        <div class="card shadow drive">

                            <a class="card-body" href="{{ route('drives.show', [$drive]) }}">

                                <div class="icon-container">
                                    {!! \App\icon\drive(['drive-icon']) !!}
                                </div>

                                <div class="name--description">

                                    <h2>{{ $drive->name }}</h2>
                                    <p class="text-muted">{!! nl2br(e($drive->description)) !!}</p>

                                </div>

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endsection
