@extends("files.file_resource")

@push('styles')
@style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Drives\Index($fileType, $file)),
])

@section('resource-content')

    <div class="fileStore-index">

        @foreach ($drives as $drive)

            <div class="card shadow drive mb-2">

                <a class="card-body" href="{{ route('files.drives.show', [$file, $drive]) }}">

                    <div class="icon-container">
                        {!! \App\icon\drive(['drive-icon']) !!}
                    </div>

                    <div class="name--description">

                        <h2>{{ $drive->name }}</h2>
                        <p class="text-muted">{!! nl2br(e($drive->description)) !!}</p>

                    </div>

                </a>

            </div>

        @endforeach

    </div>

@endsection
