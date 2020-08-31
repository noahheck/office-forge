@extends("layouts.app")

@push('styles')
    @style('css/fileStore.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Drives\Index),
])

@section('content')

    <h1>
        {!! \App\icon\fileStore(['mr-2']) !!}{{ __('app.fileStore') }}
    </h1>

    <div class="row justify-content-center index">

        @forelse ($drives as $drive)

            <div class="col-12 col-sm-10 col-md-8 mb-2">

                <div class="card shadow drive">

                    <a class="card-body" href="{{ route('drives.show', [$drive]) }}">

                        <div class="icon-container">
                            {!! \App\icon\drive(['drive-icon']) !!}
                        </div>

                        <div class="name--description">

                            <h2>{{ $drive->name }}</h2>
                            <p class="text-muted">{!! nl2br(e($drive->description)) !!}</p>

                        </div>

                    </a>

                </div>

            </div>

        @empty

            <div class="col-12 col-sm-10 col-md-8 mb-2">

                <div class="card shadow no-drives-available">
                    <div class="card-body">

                        <div>
                            {!! \App\icon\drive(['icon']) !!}
                        </div>

                        <div class="border p-3 mt-4">

                            <p>{{ __('fileStore.description') }}</p>
                            <p>{{ __('fileStore.noAccessDescription') }}</p>

                        </div>

                    </div>
                </div>

            </div>

        @endforelse

    </div>

@endsection
