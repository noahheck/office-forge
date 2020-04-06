@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Processes\Index),
])

@section('content')
    <h1>
        <span class="fas fa-clipboard-list"></span> {{ __('app.processes') }}
    </h1>

    <hr>

    @foreach ($processes as $process)
        <div class="card shadow mb-5">
            <div class="card-body">

                <h2>{{ $process->name }}</h2>
                <hr>

                <a href="{{ route("processes.create", ['process_id' => $process->id]) }}" class="btn btn-primary">
                    <span class="fas fa-plus"></span> Open New
                </a>

                <div class="row">
                    @foreach ($process->instances as $instance)
                        <div class="col-6 col-md-4 col-lg-3">

                            <a class="card" href="{{ route('processes.show', [$instance]) }}">
                                <div class="card-body">
                                    {{ $instance->name }}
                                </div>
                            </a>

                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    @endforeach

@endsection
