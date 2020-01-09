@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Navigation\LocationBar\Link\SystemSettings\Processes())
                    ->setCurrentLocation($process->name),
])

@section('content')


    <div class="row justify-content-center">

        <div class="col-12 col-md-8">

            <div class="card">

                <div class="card-body">

                    <h1 class="h3">
                        <span class="fas fa-clipboard-list"></span>
                        {{ $process->name }}
                    </h1>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            <span class="far fa-{{ $process->active ?? false ? 'check-' : '' }}square"></span> {{ __('process.active') }}
                        </span>

                        <a href="{{ route('admin.processes.edit', [$process]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"></span> {{ __('admin.editProcess') }}
                        </a>

                    </div>

                    <hr>

                    <strong>{{ __('process.instantiatingTeams') }}</strong>

                    <br>

                    @foreach ($process->instantiatingTeams as $team)

                        @if ($loop->first)
                            <ul class="list-group">
                        @endif

                            <li class="list-group-item p-2">
                                {!! $team->icon() !!} {{ $team->name }}
                            </li>

                        @if ($loop->last)
                            </ul>
                        @endif
                    @endforeach

                    <hr>

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($process->details) !!}
                    </div>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-4">

            <div class="card mt-3 mt-md-auto">

                <div class="card-body">

                    <h2 class="h4"><span class="fas fa-list-ol"></span> Steps</h2>

                    <hr>

                    @foreach (['Self Evaluation', 'Manager Feedback', 'Executive Review'] as $stepName)


                        <div class="mb-3">
                            <h4 class="h5">
                                <span class="far fa{{---check--}}-square"></span>
                                {{ $stepName }}
                            </h4>
                            <p class="text-muted mb-0">
                                <span class="fas fa-file-import"></span> {{ rand(1,3) }} Deliverables
                                <span class="fas fa-check-square"></span> {{ rand(3, 9) }} Tasks
                            </p>
                        </div>

                        <hr>

                    @endforeach

                    <div class="text-right">
                        <a href="#" class="btn btn-sm btn-primary">
                            <span class="fas fa-plus"></span> Add Step
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
