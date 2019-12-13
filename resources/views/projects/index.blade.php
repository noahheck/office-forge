@extends("layouts.app")

@section('content')
    <h1>
        <span class="fas fa-project-diagram"></span> {{ __('app.projects') }}
    </h1>

    <div class="card">
        <div class="card-body">

                <div class="text-right">
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">
                        <span class="fas fa-plus-circle"></span> {{ __('project.newProject') }}
                    </a>
                </div>
                <hr>

            @forelse($projects as $project)

                @if($loop->first)

                    <div class="table-responsive">
                        <table id="projects" class="table table-striped table-bordered dt-table">
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
                                    {!! ($project->owner) ? $project->owner->icon() : '' !!}
                                </td>
                            </tr>

                @if($loop->last)
                            </tbody>
                        </table>
                    </div>
                @endif

            @empty

                <p>No projects</p>

            @endforelse

        </div>
    </div>
@endsection
