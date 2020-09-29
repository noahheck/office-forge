@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Index),
])

@section('content')
    <h1>
        {!! \App\icon\adminSettings(['mr-2']) !!}{{ __('admin.systemSettings') }}
    </h1>

    <hr>

    <h3>{!! \App\icon\usersTeams(['mr-2']) !!}{{ __('admin.users_teams') }}</h3>

    <div class="row">
        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.users.index') }}">
                <div class="card-body">
                    {!! \App\icon\users(['module-icon']) !!}
                    {{ __('admin.users') }}
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.teams.index') }}">
                <div class="card-body">
                    {!! \App\icon\teams(['module-icon']) !!}
                    {{ __('app.teams') }}
                </div>
            </a>
        </div>
    </div>

    <hr>

    <h3>{!! \App\icon\systemSetup(['mr-2']) !!}{{ __('admin.systemSetup') }}</h3>

    <div class="row">
        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.organization') }}">
                <div class="card-body">
                    {!! \App\icon\organization(['module-icon']) !!}
                    {{ __('admin.organization') }}
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.file-types.index') }}">
                <div class="card-body">
                    {!! \App\icon\files(['module-icon']) !!}
                    {{ __('app.files') }}
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.form-docs.index') }}">
                <div class="card-body">
                    {!! \App\icon\formDocs(['module-icon']) !!}
                    {{ __('app.formDocs') }}
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.processes.index') }}">
                <div class="card-body">
                    {!! \App\icon\processes(['module-icon']) !!}
                    {{ __('app.processes') }}
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.drives.index') }}">
                <div class="card-body">
                    {!! \App\icon\fileStore(['module-icon']) !!}
                    {{ __('app.fileStore') }}
                </div>
            </a>
        </div>

    </div>

    <hr>

    <h3>{!! \App\icon\systemConfiguration(['mr-2']) !!}{{ __('admin.systemAdministration') }}</h3>

    <div class="row">

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.server') }}">
                <div class="card-body">
                    {!! \App\icon\server(['module-icon']) !!}
                    {{ __('admin.server') }}
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.backups') }}">
                <div class="card-body">
                    {!! \App\icon\backups(['module-icon']) !!}
                    {{ __('admin.backups') }}
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link" href="{{ route('admin.logs') }}">
                <div class="card-body">
                    {!! \App\icon\logs(['module-icon']) !!}
                    {{ __('admin.logs') }}
                </div>
            </a>
        </div>

        {{--<div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link not-implemented" href="#">
                <div class="card-body">
                    {!! \App\icon\email(['module-icon']) !!}
                    Mail
                </div>
            </a>
        </div>--}}

        {{--<div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link not-implemented" href="#">
                <div class="card-body">
                    {!! \App\icon\updates(['module-icon']) !!}
                    Updates
                </div>
            </a>
        </div>--}}

        {{--<div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link not-implemented" href="#">
                <div class="card-body">
                    {!! \App\icon\security(['module-icon']) !!}
                    Security
                </div>
            </a>
        </div>--}}

        {{--<div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <a class="card admin-module-link not-implemented" href="#">
                <div class="card-body">
                    {!! \App\icon\plugins(['module-icon']) !!}
                    Plugins
                </div>
            </a>
        </div>--}}

    </div>

@endsection
