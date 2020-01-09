@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes())
                    ->setCurrentLocation($process->name),
])

@section('content')
    <h1>
        <span class="fas fa-clipboard-list"></span>
        {{ $process->name }}
    </h1>

    <div class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-12 col-md-3 order-1 order-md-2">

                    <a href="{{ route('admin.processes.edit', [$process]) }}" class="btn btn-primary">
                        <span class="fas fa-edit"></span> {{ __('admin.editProcess') }}
                    </a>

                    <hr>

                    <span class="far fa-{{ $process->active ?? false ? 'check-' : '' }}square"></span> {{ __('process.active') }}

                    <hr>

                    <strong>{{ __('process.instantiatingTeams') }}</strong>

                    <br>

                    @foreach ($process->instantiatingTeams as $team)
                        {!! $team->icon() !!} {{ $team->name }} <br>
                    @endforeach

                </div>

                <div class="col-12 col-md-9 order-2 order-md-1">

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($process->details) !!}
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
