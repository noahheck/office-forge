@extends("layouts.app")

@push('meta')
    @meta('fileId', $file->id)
    @meta('fileTypeId', $fileType->id)
@endpush

@push('styles')
    @style('css/files.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Show($fileType, $file))
])

@section('content')


    <h4 class="h5 text-muted pl-3">{!! $fileType->icon() !!} - {{ $fileType->name }}</h4>

    <div class="row file">

        <div class="col-12 col-md-4 col-xl-3 mb-3">

            <div class="card shadow">
                <div class="card-body">
                    <h3 class="h4">{{ $file->name }}</h3>

                    <hr>

                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ route('files.edit', [$file]) }}">
                            <span class="fas fa-edit mr-2"></span>{{ __('app.edit') }} {{ $fileType->name }}</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 col-md-8 col-xl-9">

            <div class="card shadow">
                <div class="card-body">

                </div>
            </div>

        </div>

    </div>

@endsection
