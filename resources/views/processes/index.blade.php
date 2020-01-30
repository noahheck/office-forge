@extends("layouts.app")

@push('styles')
    @style('css/projects.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar(__('app.processes'))),
])

@section('content')
    <h1>
        <span class="fas fa-clipboard-list"></span> {{ __('app.processes') }}
    </h1>

    <hr>

    @foreach ($processes as $process)
    <div class="card mb-5">
        <div class="card-body">

            <h2>{{ $process->name }}</h2>
            <hr>

            <a href="{{ route("processes.create", ['process_id' => $process->id]) }}" class="btn btn-primary">
                <span class="fas fa-plus"></span> Open New
            </a>

        </div>
    </div>

    @endforeach

    {{--<div class="text-right">
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <span class="fas fa-plus-circle"></span> {{ __('project.newProject') }}
        </a>
    </div>
    <hr>

@forelse($projects as $project)

    @if($loop->first)

        <div class="table-responsive">
            <table id="projects" class="projects table table-striped table-bordered dt-table">
                <thead>
                    <tr>
                        <th class="w-75p">{{ __('project.dueDate') }}</th>
                        <th class="w-50p">&nbsp;</th>
                        <th>{{ __('project.name') }}</th>
                        <th>{{ __('project.owner') }}</th>
                    </tr>
                </thead>
                <tbody>

    @endif

                <tr>
                    <td>
                        {{ App\format_date($project->due_date) }}
                    </td>
                    <td data-sort="{{ ($project->completed) ? '1' : '0' }}" class="text-center">
                        <span class="{{ ($project->completed) ? "fas fa-check-square" : 'far fa-square' }}"></span>
                    </td>
                    <td>
                        <a href="{{ route('projects.show', [$project]) }}">
                            {{ $project->name }}
                        </a>
                    </td>
                    <td>
                        @if ($project->owner_id)
                            {!! $project->owner->iconAndName() !!}
                        @endif
                    </td>
                </tr>

    @if($loop->last)
                </tbody>
            </table>
        </div>
    @endif

@empty

    <p>No projects</p>

@endforelse--}}


@endsection
