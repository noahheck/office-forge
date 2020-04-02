@extends('layouts.app')

@push('styles')
    @style('css/home.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Home),
])


@section('content')

    <div class="row">

        <div class="col-12 col-md-6">

            <div class="shadow card home--panel activities-panel">
                <div class="card-header d-flex">
                    <h4 class="mb-0 flex-grow-1"><span class="fas fa-project-diagram"></span> {{ __('app.activities') }}</h4>
                    <a class="btn btn-sm btn-outline-secondary flex-grow-0 border-0" href="{{ route("activities.create") }}">
                        <span class="fas fa-plus-circle"></span>
                    </a>
                </div>

                <div class="card-body -500">
                    @forelse ($activities as $activity)

                        @if($loop->first)
                            <div class="list-group activities">
                        @endif

                            <a class="list-group-item list-group-item-action  activity @if($activity->isDueToday()) due-today @elseif($activity->isOverdue()) overdue @endif" href="{{ route("activities.show", [$activity]) }}">
                                <span class="far fa-square mr-2"></span><strong class="activity-name">{{ $activity->name }}</strong>

                                <div class="activity-details">
                                    @if ($activity->due_date)
                                        <span class="detail" title="{{ __('activity.dueDate') }}: {{ $__formattedDueDate = \App\format_date($activity->due_date) }}">
                                            <span class="due-date"><span class="far fa-calendar-alt mr-1"></span>{{ $__formattedDueDate }}</span>
                                        </span>
                                    @endif
                                    @if ($activity->tasks->count() > 0)
                                        <span class="detail" title="{{ __('activity.countOfTotalTasksCompleted', ['completed' => $activity->numberOfCompletedTasks(), 'total' => $activity->numberOfTotalTasks()]) }}">
                                            <span class="fas fa-tasks mr-1"></span>{{ $activity->numberOfCompletedTasks() }}/{{ $activity->numberOfTotalTasks() }}
                                        </span>
                                    @endif
                                </div>
                            </a>

                        @if($loop->last)
                            </div>
                        @endif
                    @empty

                    @endforelse
                </div>
            </div>

        </div>

    </div>
@endsection
