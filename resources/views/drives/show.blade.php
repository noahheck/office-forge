@extends("layouts.app")

@section('title'){{ $drive->name }}@endsection

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@push('meta')
    @meta('driveId', $drive->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\Show($drive))
])

@section('content')

    <div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">
            <div class="card shadow document">
                <div class="card-body">

                    <h2>{!! \App\icon\drive(['mr-2']) !!}{{ $drive->name }}</h2>

                    <hr>

                    <p>{!! nl2br(e($drive->description)) !!}</p>

                    @foreach ($drive->teams as $team)
                        {!! $team->icon() !!}
                    @endforeach

                    <hr>

                    <div class="text-right">

                        <a href="{{ route('drives.files.create', [$drive]) }}" class="btn btn-primary btn-sm">
                            {!! \App\icon\mediaFileUpload(['mr-2']) !!}{{ __('fileStore.uploadFile') }}
                        </a>

                        <a href="{{ route('drives.folders.create', [$drive]) }}" class="btn btn-primary btn-sm">
                            {!! \App\icon\folderPlus(['mr-2']) !!}{{ __('fileStore.addFolder') }}
                        </a>
                    </div>

                    @if ($drive->topLevelFolders->count() > 0 || $drive->topLevelMediaFiles->count() > 0)
                        @php
                            $listOpened = true;
                        @endphp
                        <div class="list-group mt-2">
                    @endif

                        @foreach ($drive->topLevelFolders as $folder)

                            <a class="list-group-item list-group-item-action" href="{{ route('drives.folders.show', [$drive, $folder]) }}">
                                {!! \App\icon\folder(['mr-2']) !!}{{ $folder->name }}
                            </a>

                        @endforeach

                        @foreach ($drive->topLevelMediaFiles as $file)

                            <a class="list-group-item list-group-item-action" href="{{ route('drives.files.show', [$drive, $file]) }}">
                                {!! \App\icon\mediaFile(['mr-2']) !!}{{ $file->name }}
                            </a>

                        @endforeach

                    @if ($listOpened ?? false)
                        </div>
                    @endif

                </div>

            </div>
        </div>

    </div>
@endsection
