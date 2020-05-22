@extends("layouts.app")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Create)
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 document-container">

            <h1>
                @if ($process)
                    {!! $activity->icon(['mr-2']) !!}{{ $process->name }}
                @else
                    {!! $activity->icon(['mr-2']) !!}{{ __('activity.newActivity') }}
                @endif
            </h1>

            <div class="card shadow document">
                <div class="card-body">

                    @include('activities._form', [
                        'action' => route('activities.store'),
                        'showCompleted' => false,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
