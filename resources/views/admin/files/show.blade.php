@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.show.js')--}}
@endpush

@push('meta')
    @meta('fileId', $file->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\SystemSettings)
                    ->addLink(new \App\Navigation\Link\SystemSettings\Files())
                    ->setCurrentLocation($file->name),
])

@section('content')


    <div class="row justify-content-center">

        <div class="col-12 col-md-4 col-xl-3">

            <div class="card">

                <div class="card-body">

                    <h1 class="h3">{!! $file->icon(['mr-2']) !!}{{ $file->name }}</h1>

                    <hr>

                    <a class="btn btn-block btn-primary" href="{{ route('admin.files.edit', [$file]) }}">
                        {{ __('admin.editFile') }}
                    </a>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-8 col-xl-9 mt-3 mt-md-0">

            <div class="card">

                <div class="card-body">


                </div>

            </div>

        </div>

    </div>
@endsection
