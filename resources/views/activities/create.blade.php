@extends("layouts.app")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Create)
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                @if ($process)
                    <span class="fas fa-clipboard-list mr-2"></span>{{ $process->name }}
                @else
                    <span class="fas fa-project-diagram mr-2"></span>{{ __('activity.newActivity') }}
                @endif
            </h1>

            <div class="card shadow">
                <div class="card-body">

                    @include('activities._form', [
                        'action' => route('activities.store'),
                        'showCompleted' => false,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
