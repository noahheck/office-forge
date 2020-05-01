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
                            {!! ($activity->process_id) ? \App\icon\processes(['mr-2']) : \App\icon\activities(['mr-2']) !!}{{ $activity->getFullName() }}
                        </a>
                    </h2>

                    <hr>

                    <h3>
                        {!! \App\icon\checkedBox(['mr-2']) !!}{{ __('activity.tasks') }}
                        @if ($activity->tasks->count() > 0)
                            <small class="text-muted" title="{{ __('activity.countOfTotalTasksCompleted', ['completed' => $activity->numberOfCompletedTasks(), 'total' => $activity->numberOfTotalTasks()]) }}">
                                ({{ $activity->numberOfCompletedTasks() }}<span class="p-half">/</span>{{ $activity->numberOfTotalTasks() }})
                            </small>
                        @endif
                    </h3>

                    @include("activities._tasklist")

                </div>

            </div>
        </div>

    </div>
@endsection
