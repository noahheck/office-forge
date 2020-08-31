@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\MediaFiles\Index($drive)),
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

                    <h3>{!! \App\icon\mediaFile(['mr-2']) !!}{{ __('fileStore.files') }}</h3>

                    @forelse ($drive->topLevelMediaFiles as $file)

                        @if($loop->first)
                            <div class="list-group mt-2">
                        @endif

                            <a class="list-group-item list-group-item-action" href="{{ route('drives.files.show', [$drive, $file]) }}">
                                {!! \App\icon\mediaFile(['mr-2']) !!}{{ $file->name }}
                            </a>

                        @if ($loop->last)
                            </div>
                        @endif

                    @empty

                        <p><em>{{ __('fileStore.noFiles') }}</em></p>

                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('drives.files.create', [$drive]) }}">
                                {{ __('fileStore.uploadFileNow') }}
                            </a>
                        </p>

                    @endforelse

                </div>

            </div>
        </div>

    </div>

@endsection
