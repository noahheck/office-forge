@extends("files/file_resource")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Edit($fileType, $file))
])

@push('styles')
    @style('css/files.css')
@endpush

@section('resource-content')

    <h1>
        {!! $fileType->icon(['mr-2']) !!}{{ __('app.edit') }} {{ $fileType->name }}
    </h1>

    <hr>

    <div class="card shadow">
        <div class="card-body">

            @include('files._form', [
                'action' => route('files.update', [$file]),
                'method' => 'PUT',
            ])

        </div>

    </div>

@endsection
