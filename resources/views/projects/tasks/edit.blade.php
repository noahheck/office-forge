@extends("layouts.app")

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-tasks"></span> {{ __('project.editTask') }}
            </h1>

            <div class="card">
                <div class="card-body">

                    @include('projects.tasks._form', [
                        'action' => route('projects.tasks.update', [$project, $task]),
                        'method' => 'PUT',
                        'showCompleted' => true,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
