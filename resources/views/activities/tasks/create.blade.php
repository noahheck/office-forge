@extends("layouts.app")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Tasks\Create($activity))
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-tasks"></span> {{ __('activity.newTask') }}
            </h1>

            <div class="card shadow">
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
