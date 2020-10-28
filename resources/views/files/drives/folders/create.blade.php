@extends("files.file_resource")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\Folders\Create($fileType, $file, $drive)),
])

@section('resource-content')

    {{--<div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">--}}

            <h1>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h1>

            <div class="card shadow document">
                <div class="card-body">

                    <h2>{!! \App\icon\folder(['mr-2']) !!}{{ __('fileStore.newFolder') }}</h2>

                    <hr>

                    @include('files.drives.folders._form', [
                        'action' => route('files.drives.folders.store', [$file, $drive]),
                    ])

                </div>

            </div>


        {{--</div>

    </div>--}}

@endsection
