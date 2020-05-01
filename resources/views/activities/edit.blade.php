@extends("layouts.app")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Edit($activity))
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 document-container">

            <h1>
                @if ($activity->process_id)
                    {!! \App\icon\processes(['mr-2']) !!}{{ $activity->process_name }}{{ ($activity->name) ? ' - ' . $activity->name : '' }}
                @else
                    {!! \App\icon\activities(['mr-2']) !!}{{ __('activity.editActivity') }}
                @endif
            </h1>

            <div class="card shadow document">
                <div class="card-body">

                    @include('activities._form', [
                        'action' => route('activities.update', [$activity]),
                        'method' => 'PUT',
                        'showCompleted' => true,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
