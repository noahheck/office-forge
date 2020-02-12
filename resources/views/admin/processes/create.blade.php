@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Processes\Create(),
])

@section('content')
    <h1>
        <span class="fas fa-clipboard-list"></span> {{ __('admin.newProcess') }}
    </h1>

    <p class="text-muted">{{ __('admin.newProcess_shortDescription') }}</p>

    <div class="card">
        <div class="card-body">

            @include('admin.processes._form', [
                'action' => route('admin.processes.store'),
            ])

        </div>
    </div>
@endsection
