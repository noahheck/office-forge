@extends("layouts.app")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Tasks\Edit($activity, $task))
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-tasks"></span> {{ __('activity.editTask') }}
            </h1>

            <div class="card shadow">
                <div class="card-body">

                    @include('activities.tasks._form', [
                        'action' => route('activities.tasks.update', [$activity, $task]),
                        'method' => 'PUT',
                        'showCompleted' => true,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
