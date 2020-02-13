@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Index),
])

@section('content')
    <h1>
        <span class="fas fa-cogs"></span> {{ __('admin.systemSettings') }}
    </h1>

    <hr>

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
            <a class="card admin-module-link" href="{{ route('admin.organization') }}">
                <div class="card-body">
                    <span class="fas fa-building module-icon"></span>
                    Organization
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.file-types.index') }}">
                <div class="card-body">
                    <span class="fas fa-folder-open module-icon"></span>
                    Files
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.processes.index') }}">
                <div class="card-body">
                    <span class="fas fa-clipboard-list module-icon"></span>
                    {{ __('app.processes') }}
                </div>
            </a>
        </div>

        {{--<div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="#">
                <div class="card-body">
                    <span class="fas fa-project-diagram module-icon"></span>
                    {{ __('app.projects') }}
                </div>
            </a>
        </div>--}}
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

    </div>

@endsection
