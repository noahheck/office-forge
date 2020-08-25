@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\Folders\Show($drive, $folder)),
])

@section('content')

    <div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h1>

            <div class="card shadow document">
                <div class="card-body">

                    <h2>{!! \App\icon\folder(['mr-2']) !!}{{ $folder->name }}</h2>

                    <hr>

                    <p>{!! nl2br(e($folder->description)) !!}</p>

                    <hr>

                    <div class="list-group mb-3">

                        @if ($parent = $folder->parentFolder)
                            <a class="list-group-item list-group-item-action" href="{{ route('drives.folders.show', [$drive, $parent]) }}">
                                {!! \App\icon\folderUp(['mr-2']) !!}../{{ $parent->name }}
                            </a>
                        @else
                            <a class="list-group-item list-group-item-action" href="{{ route('drives.show', [$folder->drive]) }}">
                                {!! \App\icon\drive(['mr-2']) !!}../{{ $folder->drive->name }}
                            </a>
                        @endif

                    </div>

                    @foreach ($folder->folders as $child)

                        @if ($loop->first)
                            <div class="list-group">
                        @endif

                            <a class="list-group-item list-group-item-action" href="{{ route('drives.folders.show', [$drive, $child]) }}">
                                {!! \App\icon\folder(['mr-2']) !!}{!! $child->name !!}
                            </a>

                        @if ($loop->last)
                            </div>
                        @endif

                    @endforeach

                </div>

            </div>

        </div>

    </div>

@endsection
