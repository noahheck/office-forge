@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Tasks\Index($activity))
])

@section('content')

    <h1>
        <span class="fas fa-project-diagram"></span> {{ $activity->name }}
    </h1>

    <div class="row justify-content-center">

        <div class="col-12 col-md-7 col-xl-8">
            <div class="card shadow">
                <div class="card-body">

                    <p class="text-right">
                        <a class="btn btn-primary" href="{{ route('activities.tasks.create', [$activity]) }}">
                            <span class="fas fa-plus"></span> {{ __('activity.addTask') }}
                        </a>
                    </p>

                    <hr>

                    <h3>
                        <span class="far fa-check-square"></span>
                        {{ __('activity.tasks') }}
                    </h3>

                    @forelse($activity->tasks as $task)

                        @if ($loop->first)
                            <div class="list-group">
                        @endif

                            <a class="list-group-item list-group-item-action" href="{{ route('activities.tasks.show', [$activity, $task]) }}">
                                <span class="far {{ ($task->completed) ? 'fa-check-square' : 'fa-square' }}"></span>
                                {{ $task->title }}
                            </a>

                        @if ($loop->last)
                            </div>
                        @endif

                    @empty

                    @endforelse

                </div>

            </div>
        </div>

    </div>
@endsection
