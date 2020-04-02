@extends("layouts.app")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Edit($activity))
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-project-diagram"></span> {{ __('activity.editActivity') }}
            </h1>

            <div class="card shadow">
                <div class="card-body">

                    @include('activities._form', [
                        'action' => route('activities.update', [$activity]),
                        'method' => 'PUT',
                        'showCompleted' => true,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
