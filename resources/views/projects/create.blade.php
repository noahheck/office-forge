@extends("layouts.app")

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-project-diagram"></span> {{ __('project.newProject') }}
            </h1>

            <div class="card">
                <div class="card-body">

                    @include('projects._form', [
                        'action' => route('projects.store'),
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection