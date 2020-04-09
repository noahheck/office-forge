@extends("layouts.app")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Participants\Edit($activity))
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-user-friends"></span> {{ __('activity.editParticipants') }}
            </h1>

            <div class="card shadow">
                <div class="card-body">

                    <form class="bold-labels" action="{{ route("activities.participants.update", [$activity]) }}" method="POST">
                        @csrf

                        @hiddenField([
                            'name' => 'return',
                            'id' => 'return',
                            'value' => old('return', url()->previous()),
                        ])

                        @userMultiSelectField([
                            'name' => 'participants',
                            'label' => __('activity.participants'),
                            'values' => $participants->pluck('user'),
                            'users' => $userOptions,
                            'placeholder' => __('activity.participants'),
                            'description' => __('activity.participantDescription'),
                            'required' => false,
                            'autofocus' => true,
                            'error' => $errors->has('participants'),
                        ])

                        <hr>

                        <button type="submit" class="btn btn-primary">
                            {{ __('app.save') }}
                        </button>

                        <a class="btn btn-secondary" href="{{ url()->previous(route('activities.show', [$activity])) }}">
                            {{ __('app.cancel') }}
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
