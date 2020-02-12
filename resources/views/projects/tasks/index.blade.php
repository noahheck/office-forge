@extends("layouts.app")

@push('styles')
    @style('css/projects.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\Projects)
                    ->addLink(new \App\Navigation\Link\Projects\Show($project))
                    ->setCurrentLocation(__('project.tasks')),
])

@section('content')

    <h1>
        <span class="fas fa-project-diagram"></span> {{ $project->name }}
    </h1>

    <div class="row justify-content-center">

        <div class="col-12 col-md-7 col-xl-8">
            <div class="card shadow">
                <div class="card-body">

                    <p class="text-right">
                        <a class="btn btn-primary" href="{{ route('projects.tasks.create', [$project]) }}">
                            <span class="fas fa-plus"></span> {{ __('project.addTask') }}
                        </a>
                    </p>

                    <hr>

                    <h3>
                        <span class="far fa-check-square"></span>
                        {{ __('project.tasks') }}
                    </h3>

                    @forelse($project->tasks as $task)

                        @if ($loop->first)
                            <div class="list-group">
                        @endif

                            <a class="list-group-item list-group-item-action" href="{{ route('projects.tasks.show', [$project, $task]) }}">
                                <span class="far {{ ($task->completed) ? 'fa-check-square' : 'fa-square' }}"></span>
                                {{ $task->title }}
                            </a>

                        @if ($loop->last)
                            </div>
                        @endif

                    @empty

                    @endforelse

                </div>

            </div>
        </div>

    </div>
@endsection
