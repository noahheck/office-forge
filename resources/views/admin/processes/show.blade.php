@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.processes.show.js')
@endpush

@push('meta')
    @meta('processId', $process->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\SystemSettings)
                    ->addLink(new \App\Navigation\Link\SystemSettings\Processes())
                    ->setCurrentLocation($process->name),
])

@section('content')


    <div class="row justify-content-center">

        <div class="col-12 col-md-8 order-2 order-md-1">

            <div class="card">

                <div class="card-body">

                    <h1 class="h3">
                        <span class="fas fa-clipboard-list"></span>
                        {{ $process->name }}
                    </h1>

                    <hr>

                    <div class="editor-content">
                        {!! App\safe_text_editor_content($process->details) !!}
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <h2 class="h4">
                            <span class="fas fa-clipboard-check mr-2"></span>{{ __('admin.tasks') }}
                        </h2>
                        <a href="{{ route('admin.processes.tasks.index', [$process]) }}">
                            <span class="far fa-arrow-alt-circle-right"></span> {{ __('admin.tasks') }}
                        </a>
                    </div>

                    @forelse ($process->tasks as $task)

                        @if ($loop->first)
                            <ul class="list-group" id="processTasks">
                        @endif

                        <li class="list-group-item d-flex" data-id="{{ $task->id }}">
                            <div class="flex-grow-1">

                                <span class="far fa-square"></span>
                                <a href="{{ route('admin.processes.tasks.show', [$process, $task]) }}">
                                    {{ $task->name }}
                                </a>
                                @if ($task->details)
                                    <span class="text-muted fas fa-align-left"></span>
                                @endif

                                <br>

                                <span class="text-muted"><span class="fas fa-tasks"></span> {{ $numActions = count($task->actions->where('active', true)) }} {{ __('process.action' . (($numActions == 1) ? '' : 's')) }}</span>

                            </div>
                            <div class="sort-handle">
                                <span class="fas fa-arrows-alt-v"></span>
                            </div>
                        </li>

                        @if ($loop->last)
                            </ul>
                        @endif

                    @empty

                        <div class="text-center border p-4">

                            <p>{{ __('admin.task_description') }}</p>

                        </div>

                    @endforelse

                    <div class="text-right mt-3">
                        <a href="{{ route('admin.processes.tasks.create', [$process]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-plus"></span> {{ __('admin.addTask') }}
                        </a>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-4 order-1 order-md-2 pl-md-0">

            <div class="card mb-3 mb-md-auto">

                <div class="card-body">

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

                </div>
            </div>

        </div>

    </div>
@endsection
