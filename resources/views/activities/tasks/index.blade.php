@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
    @style('css/document.css')
@endpush

@push('meta')
    @meta('activityId', $activity->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Tasks\Index($activity))
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 document-container">
            <div class="card shadow document">
                <div class="card-body">

                    <h2 class="h6 overflow-x-ellipsis">
                        <a href="{{ route('activities.show', [$activity]) }}">
                        <span class="fas fa-project-diagram"></span> {{ $activity->name }}
                        </a>
                    </h2>

                    <hr>

                    <h3>
                        <span class="far fa-check-square mr-2"></span>{{ __('activity.tasks') }}
                    </h3>

                    @include("activities._tasklist")

                </div>

            </div>
        </div>

    </div>
@endsection
