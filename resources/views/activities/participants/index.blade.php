@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Participants\Index($activity))
])

@section('content')


    <div class="row justify-content-center">

        <div class="col-12 col-md-10 document-container">

            <h1 class="h2">
                {!! $activity->icon(['mr-2']) !!}{{ $activity->getFullName() }}
            </h1>

            <div class="card shadow document">

                <div class="card-header">
                    <h4 class="mb-0">
                        {!! \App\icon\participants(['mr-2']) !!}{{ __('activity.participants') }}
                    </h4>
                </div>

                <div class="card-body">

                    <div class="d-flex">

                        <p class="flex-grow-1">
                            {{ __('activity.participantDescription') }}
                        </p>

                        <p class="flex-grow-0 pl-2">

                            @unless($activity->completed)
                                @can('update', $activity)
                                    <a class="btn btn-primary text-nowrap" href="{{ route('activities.participants.edit', [$activity]) }}">
                                        {!! \App\icon\edit(['mr-1']) !!}{{ __('activity.editParticipants') }}
                                    </a>
                                @else
                                    <span class="btn btn-secondary text-nowrap disabled" title="{{ __('activity.onlyActivityOwnerCanEdit') }}">
                                        {!! \App\icon\edit(['mr-1']) !!}{{ __('activity.editParticipants') }}
                                    </span>
                                @endcan
                            @endunless
                        </p>

                    </div>

                    <hr>

                    @forelse($participants as $participant)

                        @if ($loop->first)
                            <ul class="list-group">
                        @endif

                            <li class="list-group-item">
                                {!! $participant->user->iconAndName() !!}
                            </li>

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
