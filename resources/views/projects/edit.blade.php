@extends("layouts.app")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\Projects)
                    ->addLink(new \App\Navigation\Link\Projects\Show($project))
                    ->setCurrentLocation(__('app.edit')),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-project-diagram"></span> {{ __('project.editProject') }}
            </h1>

            <div class="card">
                <div class="card-body">

                    @include('projects._form', [
                        'action' => route('projects.update', [$project]),
                        'method' => 'PUT',
                        'showCompleted' => true,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
