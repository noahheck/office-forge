@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\Folders\Index($drive)),
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
                        <a href="{{ route('drives.folders.create', [$drive]) }}" class="btn btn-primary btn-sm">
                            {!! \App\icon\circlePlus(['mr-2']) !!}{{ __('fileStore.addFolder') }}
                        </a>
                    </div>

                    <hr>

                    <h3>{!! \App\icon\folder(['mr-2']) !!}{{ __('fileStore.folders') }}</h3>

                    @forelse ($drive->topLevelFolders as $folder)

                        @if($loop->first)
                            <div class="list-group mt-2">
                                @endif

                                <a class="list-group-item list-group-item-action" href="{{ route('drives.folders.show', [$drive, $folder]) }}">
                                    {!! \App\icon\files(['mr-2']) !!}{{ $folder->name }}
                                </a>

                                @if ($loop->last)
                            </div>
                        @endif

                    @empty

                        <p><em>{{ __('fileStore.noFolders') }}</em></p>

                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('drives.folders.create', [$drive]) }}">
                                {{ __('fileStore.createFolderNow') }}
                            </a>
                        </p>

                    @endforelse

                </div>

            </div>
        </div>

    </div>

@endsection
