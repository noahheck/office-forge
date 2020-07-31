@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Organization\Index,
])

@section('content')





    <div class="row justify-content-center document-print-container">
        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\organization(['mr-2']) !!}{{ __('admin.organizationDetails') }}
            </h1>

            <p class="text-muted">{{ __('admin.organizationDetails_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    <form action="{{ route("admin.organization.update") }}" method="POST" class="bold-labels">
                        @csrf

                        @errors('name', 'phone', '')

                        @textField([
                            'name' => 'name',
                            'label' => __('admin.organization_name'),
                            'value' => old('name', $organization->name),
                            'placeholder' => '',
                            'required' => true,
                            'autofocus' => true,
                            'error' => $errors->has('name'),
                        ])

                        @phoneField([
                            'name' => 'phone',
                            'label' => __('admin.organization_phone'),
                            'details' => '',
                            'value' => $organization->phone,
                            'required' => false,
                            'autofocus' => false,
                            'error' => $errors->has('phone'),
                            'readonly' => false,
                        ])

                        <hr>

                        <button type="submit" class="btn btn-primary">
                            {{ __('app.save') }}
                        </button>

                        <a class="btn btn-secondary" href="{{ url()->previous(route('admin.index')) }}">
                            {{ __('app.cancel') }}
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>





    {{--<h1>
        <span class="fas fa-building"></span> {{ __('admin.organizationSettings') }}
    </h1>--}}

    {{--<hr>

    <h3><span class="fas fa-users-cog"></span> Users / Teams</h3>

    <div class="row">
        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.users.index') }}">
                <div class="card-body">
                    <span class="fas fa-users module-icon"></span>
                    {{ __('admin.users') }}
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.teams.index') }}">
                <div class="card-body">
                    <span class="fas fa-user-friends module-icon"></span>
                    {{ __('app.teams') }}
                </div>
            </a>
        </div>
    </div>

    <hr>

    <h3><span class="fas fa-tools"></span> System Setup</h3>

    <div class="row">
        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="#">
                <div class="card-body">
                    <span class="fas fa-building module-icon"></span>
                    Organization
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="#">
                <div class="card-body">
                    <span class="fas fa-project-diagram module-icon"></span>
                    {{ __('app.projects') }}
                </div>
            </a>
        </div>
    </div>

    <hr>

    <h3><span class="fas fa-sliders-h"></span> System Configuration</h3>

    <div class="row">
        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="#">
                <div class="card-body">
                    <span class="fas fa-download module-icon"></span>
                    Backups
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="#">
                <div class="card-body">
                    <span class="fas fa-envelope module-icon"></span>
                    Mail
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="#">
                <div class="card-body">
                    <span class="fas fa-server module-icon"></span>
                    Server
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="#">
                <div class="card-body">
                    <span class="fas fa-sync-alt module-icon"></span>
                    Updates
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="#">
                <div class="card-body">
                    <span class="fas fa-shield-alt module-icon"></span>
                    Security
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="#">
                <div class="card-body">
                    <span class="fas fa-plug fa-rotate-90 module-icon"></span>
                    Plugins
                </div>
            </a>
        </div>

    </div>--}}

@endsection
