@extends("layouts.app")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Tasks\Create($activity))
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\tasks(['mr-2']) !!}{{ __('activity.newTask') }}
            </h1>

            <div class="card shadow document">
                <div class="card-body">

                    @include('activities.tasks._form', [
                        'action' => route('activities.tasks.store', [$activity]),
                        'showCompleted' => false,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
