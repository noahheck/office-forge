@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.show.js')--}}
@endpush

@push('meta')
    @meta('fileTypeId', $fileType->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Show($fileType),
])

@section('content')


    <div class="row">

        <div class="col-12 col-md-4 col-xl-3">

            <div class="card">

                <div class="card-body">

                    <h1 class="h3">{!! $fileType->icon(['mr-2']) !!}{{ $fileType->name }}</h1>

                    <hr>

                    <a class="btn btn-block btn-primary" href="{{ route('admin.file-types.edit', [$fileType]) }}">
                        {{ __('admin.editFileType') }}
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
