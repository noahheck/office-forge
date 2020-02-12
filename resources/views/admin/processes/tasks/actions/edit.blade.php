@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Processes\Tasks\Actions\Edit($process, $task, $action),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-check-square"></span> {{ __('admin.editAction') }}
            </h1>

            <p class="text-muted">{{ __('admin.editAction_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.processes.tasks.actions._form', [
                        'action' => route('admin.processes.tasks.actions.update', [$process, $task, $action, 'return' => url()->previous()]),
                        'taskAction' => $action,
                        'method' => 'PUT',
                        'showActive' => true,
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
