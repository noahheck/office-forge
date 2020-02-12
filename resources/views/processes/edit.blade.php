@extends("layouts.app")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Processes\Edit($process, $instance))
                    /*->addLink(new \App\Navigation\Link\Processes)
                    ->addLink(new \App\Navigation\Link\Processes\Show($instance))
                    ->setCurrentLocation(__('app.edit')),*/
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-clipboard-list mr-2"></span>{{ __('app.edit') }} - {{ $instance->process_name }}
            </h1>

            <div class="card">
                <div class="card-body">

                    @if ($instance->name)
                        <h2>{{ $instance->name }}</h2>

                        <hr>
                    @endif

                    @include('processes._form', [
                        'action' => route('processes.update', [$instance]),
                        'method' => 'PUT',
                    ])

                </div>
            </div>
        </div>
    </div>

@endsection
