@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\MediaFiles\Edit($drive, $mediaFile)),
])

@section('content')

    <div class="row project justify-content-center document-print-container">

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

                    @include('drives.media-files._form', [
                        'action' => route('drives.files.update', [$drive, $mediaFile]),
                        'method' => 'PUT',
                        'upload' => false,
                    ])

                </div>

            </div>
        </div>

    </div>

@endsection
