@extends("layouts.app")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Processes\Create($process))
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-clipboard-list mr-2"></span>{{ __('app.new') }} - {{ $instance->process_name }}
            </h1>

            <div class="card">
                <div class="card-body">

                    @include('processes._form', [
                        'action' => route('processes.store'),
                        'showCompleted' => false,
                    ])

                </div>
            </div>
        </div>
    </div>

@endsection
