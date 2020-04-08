@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Participants\Index($activity))
])

@section('content')


    <div class="row justify-content-center">

        <div class="col-12 col-md-7 col-xl-8">

            <h1 class="h2">
                @if ($activity->process_id)
                    <span class="fas fa-clipboard-list"></span> {{ $activity->process_name }} - {{ $activity->name }}
                @else
                    <span class="fas fa-project-diagram"></span> {{ $activity->name }}
                @endif
            </h1>

            <div class="card shadow">

                <div class="card-header">
                    <h4 class="mb-0">
                        <span class="fas fa-user-friends"></span>
                        {{ __('activity.participants') }}
                    </h4>
                </div>

                <div class="card-body">

                    <div class="d-flex">

                        <p class="flex-grow-1">
                            {{ __('activity.participantDescription') }}
                        </p>

                        <p class="flex-grow-0 pl-2">
                            <a class="btn btn-primary text-nowrap" href="{{ route('activities.participants.edit', [$activity]) }}">
                                <span class="fas fa-edit"></span> {{ __('activity.editParticipants') }}
                            </a>
                        </p>

                    </div>

                    <hr>

                    @forelse($participants as $participant)

                        @if ($loop->first)
                            <ul class="list-group">
                        @endif

                            {{--<a class="list-group-item list-group-item-action" href="{{ route('activities.tasks.show', [$activity, $task]) }}">
                                <span class="far {{ ($task->completed) ? 'fa-check-square' : 'fa-square' }}"></span>
                                {{ $task->title }}
                            </a>--}}

                        @if ($loop->last)
                            </ul>
                        @endif

                    @empty
                        <em>{{ __('activity.noParticipants') }}</em>
                    @endforelse

                </div>

            </div>
        </div>

    </div>
@endsection
