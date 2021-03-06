@php
$__currentRouteName    = Route::currentRouteName();
$__isFileStoreRoute    = Str::startsWith($__currentRouteName, 'drives');
$__isActivitiesRoute   = Str::startsWith($__currentRouteName, 'activities');
$__isFormDocsRoute     = Str::startsWith($__currentRouteName, 'form-docs');
$__isReportsRoute      = Str::startsWith($__currentRouteName, 'reports');
$__isProcessesRoute    = Str::startsWith($__currentRouteName, 'processes');
$__isAdminRoute        = Str::startsWith($__currentRouteName, 'admin.');
$__isSettingsRoute     = Str::startsWith($__currentRouteName, 'my-settings.');
$__isUserActivityRoute = Str::startsWith($__currentRouteName, 'user-activity');


// Variables from view composer:
// $_user
// $_formDocTemplates
// $_processes
// $__fileTypes
// $__fileTypesToCreate

$__isFilesRoute     = Str::startsWith($__currentRouteName, 'files');
$__activeFileTypeId = false;

if ($__isFilesRoute) {
    $__fileTypeFilter_fileId = Request::get('file_type');

    if (!$__fileTypeFilter_fileId) {
        $__file = request()->file;
    }

    $__activeFileTypeId = $__fileTypeFilter_fileId ?? optional($__file)->file_type_id;
}


@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @meta('charset', 'utf-8')
    @meta('viewport', 'width=device-width, initial-scale=1')

    <!-- CSRF Token -->
    @meta('csrf-token', csrf_token())


    @if(Session::has('success') || \Session::has('info') || \Session::has( 'warning') || \Session::has('error'))
        @meta('check-notifications', true)
    @endif

    @meta('userId', $_user->id)

    @stack('meta')

    @meta('vocab-cancel', __('app.cancel'))
    @meta('vocab-confirm', __('app.confirm'))
    @meta('vocab-confirm-delete', __('app.confirmDelete'))
    @meta('vocab-sure-delete-this', __('app.sureDeleteThis'))

    <title>@yield('title', config('app.name', 'Office Forge'))</title>

    <!-- ****** faviconit.com favicons ****** -->
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <link rel="icon" sizes="16x16 32x32 64x64" href="/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="196x196" href="/favicon/favicon-192.png">
    <link rel="icon" type="image/png" sizes="160x160" href="/favicon/favicon-160.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96.png">
    <link rel="icon" type="image/png" sizes="64x64" href="/favicon/favicon-64.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16.png">
    <link rel="apple-touch-icon" href="/favicon/favicon-57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/favicon-114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/favicon-72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/favicon-144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/favicon-60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/favicon-120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/favicon-76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/favicon-152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/favicon-180.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="/favicon/favicon-144.png">
    <meta name="msapplication-config" content="/favicon/browserconfig.xml">
    <!-- ****** faviconit.com favicons ****** -->


    <!-- Scripts -->
    @script('js/manifest.js')
    @script('js/vendor.js')

    @auth
        @routes
    @endauth

    @script('js/app.js')

    <!-- Styles -->
    @style('css/app.css')
    @stack('styles')
</head>
<body>

    <div id="notifications" class="notifications" aria-live>

    </div>

    <div id="popups" class="popups" aria-live>

    </div>

    <nav class="navbar fixed-top navbar-expand-md navbar-dark header-navbar">
        <div class="container-fluid">

            <span>
                <a href="#mainContent" class="skip-to-content-link">{{ __('app.skipToContent') }}</a>
                <button type="button" id="toggleApplicationSidebarButton" class="btn toggle-application-sidebar-button">
                    <span class="fas fa-bars"></span>
                    <span class="sr-only">{{ __('app.showNavigationMenu') }}</span>
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="app-logo" alt="{{ config('app.name', 'Office Forge') }}" src="{{ asset("/images/of_logo_50.png") }}">
                    <span>{{ config('app.name', 'Office Forge') }}</span>
                </a>
            </span>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('toggleNavigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="{{ route('manual') }}">
                            {!! \App\icon\help() !!}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="addNewNavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-plus-circle"></span> <span class="sr-only">{{ __('app.createNew') }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="addNewNavbarDropdown">
                            <span class="dropdown-header">{!! \App\icon\activities(['fa-fw']) !!} {{ __('app.activities') }}</span>
                            <a class="dropdown-item" href="{{ route("activities.create") }}">{{ __('activity.newActivity') }}</a>

                            @foreach ($_processes as $__process)
                                @if ($loop->first)
                                    <span class="dropdown-header">{!! \App\icon\processes(['fa-fw']) !!} {{ __('app.processes') }}</span>
                                @endif

                                <a class="dropdown-item" href="{{ route('activities.create', ['process_id' => $__process->id]) }}">
                                    {{ $__process->name }}
                                </a>
                            @endforeach

                            @foreach ($_formDocTemplates as $__template)

                                @if ($loop->first)
                                    <span class="dropdown-header">{!! \App\icon\formDocs(['fa-fw']) !!} {{ __('app.formDocs') }}</span>
                                @endif

                                <a class="dropdown-item" href="{{ route('form-docs.create', ['form_doc_template_id' => $__template->id]) }}">
                                    {{ $__template->name }}
                                </a>
                            @endforeach

                            @foreach ($__fileTypesToCreate as $__fileType)
                                @if ($loop->first)
                                    <span class="dropdown-header">{!! \App\icon\files(['fa-fw']) !!} {{ __('app.files') }}</span>
                                @endif
                                <a class="dropdown-item" href="{{ route('files.create', ['file_type' => $__fileType->id]) }}">
                                    {!! $__fileType->icon(['fa-fw']) !!} {{ $__fileType->name }}
                                </a>
                            @endforeach

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {!! Auth::user()->iconPhoto() !!}
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('my-settings.index') }}">
                                {!! \App\icon\mySettings(['fa-fw']) !!} {{ __('app.mySettings') }}
                            </a>
                            @admin
                                <a href="{{ route('admin.index') }}" class="dropdown-item">
                                    {!! \App\icon\adminSettings(['fa-fw']) !!} {{ __('app.admin') }}
                                </a>
                            @endadmin
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {!! \App\icon\logOut(['fa-fw']) !!} {{ __('app.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="application-sidebar" id="applicationSidebar">
        <ul>
            <li>
                <a href="{{ route('home') }}" class="{{ ($__currentRouteName === 'home') ? 'current' : '' }}">
                    {!! \App\icon\home(['fa-fw']) !!} {{ __('app.home') }}
                </a>
            </li>

            <li>
                <a href="{{ route('drives.index') }}" class="{{ ($__isFileStoreRoute) ? 'current' : '' }}">
                    {!! \App\icon\fileStore(['fa-fw']) !!} {{ __('app.fileStore') }}
                </a>
            </li>

            @foreach ($__fileTypesToCreate as $__fileType)
                <li class="{{ $loop->first ? 'divider' : '' }}">
                    <a href="{{ route('files.index', ['file_type' => $__fileType]) }}" class="{{ ($__isFilesRoute && $__activeFileTypeId == $__fileType->id) ? 'current' : '' }}">
                        {!! $__fileType->icon(['fa-fw']) !!} {{ Str::plural($__fileType->name) }}
                    </a>
                </li>
            @endforeach

            <li class="divider">
                <a href="{{ route('activities.index') }}" class="{{ ($__isActivitiesRoute) ? 'current' : '' }}">
                    {!! \App\icon\activities(['fa-fw']) !!} {{ __('app.activities') }}
                </a>
            </li>
            <li>
                <a href="{{ route('form-docs.index') }}" class="{{ ($__isFormDocsRoute) ? 'current' : '' }}">
                    {!! \App\icon\formDocs(['fa-fw']) !!} {{ __('app.formDocs') }}
                </a>
            </li>
            <li>
                <a href="{{ route('reports.index') }}" class="{{ ($__isReportsRoute) ? 'current' : '' }}">
                    {!! \App\icon\reports(['fa-fw']) !!} {{ __('app.reports') }}
                </a>
            </li>
            <li class="divider">
                <a href="{{ route('user-activity') }}" class="{{ ($__isUserActivityRoute) ? 'current' : '' }}">
                    {!! \App\icon\userActivity(['fa-fw']) !!} {{ __('app.userActivity') }}
                </a>
            </li>
            <li>
                <a href="{{ route('my-settings.index') }}" class="{{ ($__isSettingsRoute) ? 'current' : '' }}">
                    {!! \App\icon\mySettings(['fa-fw']) !!} {{ __('app.mySettings') }}
                </a>
            </li>
            @admin
                <li>
                    <a href="{{ route('admin.index') }}" class="{{ ($__isAdminRoute) ? 'current' : '' }}">
                        {!! \App\icon\adminSettings(['fa-fw']) !!} {{ __('app.admin') }}
                    </a>
                </li>
            @endadmin
            <li class="divider">
                <a href="{{ route('logout') }}">
                    {!! \App\icon\logOut(['fa-fw']) !!} {{ __('app.logout') }}
                </a>
            </li>
        </ul>
    </div>

    @yield('location-bar')

    <main id="mainContent" class="main-content @yield('content-body-class')">

        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
