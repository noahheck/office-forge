@extends("layouts.app")

@section('content')

    <h1>
        <span class="fas fa-project-diagram"></span> {{ $project->name }}
    </h1>

    <div class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-12 col-md-7 col-xl-8">

                    <p class="text-right">
                        <a class="btn btn-primary" href="{{ route('projects.edit', [$project]) }}">
                            <span class="fas fa-edit"></span> {{ __('project.editProject') }}
                        </a>
                    </p>

                    <hr>

                    <dl class="row">
                        <dt class="col-6 col-md-3 col-xl-2">{{ __('project.owner') }}</dt>
                        <dd class="col-6 col-md-9 col-xl-10">{{ ($project->owner) ? $project->owner->name : '' }}</dd>

                        <dt class="col-6 col-md-3 col-xl-2">{{ __('project.dueDate') }}</dt>
                        <dd class="col-6 col-md-9 col-xl-10">{{ App\format_date($project->due_date) }}</dd>

                    </dl>

                    <hr>

                    {!! nl2br($project->details) !!}

                </div>
            </div>
        </div>
    </div>
@endsection