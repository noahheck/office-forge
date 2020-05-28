@php
$__currentRouteName    = Route::currentRouteName();
$__isFilesRoute        = Str::startsWith($__currentRouteName, 'files');
$__isActivitiesRoute   = Str::startsWith($__currentRouteName, 'activities');
$__isFormDocsRoute     = Str::startsWith($__currentRouteName, 'form-docs');
$__isProcessesRoute    = Str::startsWith($__currentRouteName, 'processes');
$__isAdminRoute        = Str::startsWith($__currentRouteName, 'admin.');
$__isSettingsRoute     = Str::startsWith($__currentRouteName, 'my-settings.');
$__isUserActivityRoute = Str::startsWith($__currentRouteName, 'user-activity');


// Variables from view composer:
// $_user
// $_formDocTemplates
// $_processes

$__fileTypes = \App\FileType::orderBy('name')->get();

$__fileTypes->load('teams');

$__fileTypesToCreate = $__fileTypes->filter(function($fileType) use ($_user) {

    return $fileType->isAccessibleBy($_user);
});

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

    <title>@yield('title', config('app.name', 'Office Forge'))</title>


    <!-- Scripts -->
    @script('js/manifest.js')
    @script('js/vendor.js')

    @auth
        @routes
    @endauth

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>

    <div id="notifications" class="notifications" aria-live>

    </div>

    <nav class="navbar fixed-top navbar-expand-md navbar-dark header-navbar">
        <div class="container-fluid">

            <span>
                <a href="#mainContent" class="skip-to-content-link">Skip to content</a>
                <button type="button" id="toggleApplicationSidebarButton" class="btn toggle-application-sidebar-button">
                    <span class="fas fa-bars"></span>
                    <span class="sr-only">{{ __('app.showNavigationMenu') }}</span>
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Office Forge') }}
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
                    <li class="nav-item dropdown">
                        <a id="addNewNavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-plus-circle"></span> <span class="sr-only">Create New</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="addNewNavbarDropdown">
                            <span class="dropdown-header">{!! \App\icon\activities(['fa-fw']) !!} {{ __('app.activities') }}</span>
                            <a class="dropdown-item" href="{{ route("activities.create") }}">{{ __('activity.newActivity') }}</a>

                            @foreach ($_processes as $__process)
                                @if ($loop->first)
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">{!! \App\icon\processes(['fa-fw']) !!} {{ __('app.processes') }}</span>
                                @endif

                                <a class="dropdown-item" href="{{ route('activities.create', ['process_id' => $__process->id]) }}">
                                    {{ $__process->name }}
                                </a>
                            @endforeach

                            @foreach ($_formDocTemplates as $__template)

                                @if ($loop->first)
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">{!! \App\icon\formDocs(['fa-fw']) !!} {{ __('app.formDocs') }}</span>
                                @endif

                                <a class="dropdown-item" href="{{ route('form-docs.create', ['form_doc_template_id' => $__template->id]) }}">
                                    {{ $__template->name }}
                                </a>
                            @endforeach

                            @foreach ($__fileTypesToCreate as $__fileType)
                                @if ($loop->first)
                                    <div class="dropdown-divider"></div>
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
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('app.logout') }}
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
            {{--<li>
                <a href="#">
                    <span class="fa-fw far fa-envelope"></span> {{ __('app.messages') }}
                </a>
            </li>--}}
            <li>
                <a href="{{ route('files.index') }}" class="{{ ($__isFilesRoute) ? 'current' : '' }}">
                    {!! \App\icon\files(['fa-fw']) !!} {{ __('app.files') }}
                </a>
            </li>
            <li>
                <a href="{{ route('activities.index') }}" class="{{ ($__isActivitiesRoute) ? 'current' : '' }}">
                    {!! \App\icon\activities(['fa-fw']) !!} {{ __('app.activities') }}
                </a>
            </li>
            <li>
                <a href="{{ route('form-docs.index') }}" class="{{ ($__isFormDocsRoute) ? 'current' : '' }}">
                    {!! \App\icon\formDocs(['fa-fw']) !!} {{ __('app.formDocs') }}
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
            {{--<li>
                <a href="#">
                    <span class="fa-fw far fa-question-circle"></span> {{ __('app.help') }}
                </a>
            </li>--}}
            <li class="divider">
                <a href="{{ route('logout') }}">
                    {!! \App\icon\logOut(['fa-fw']) !!} {{ __('app.logout') }}
                </a>
            </li>
        </ul>
    </div>

    @yield('location-bar')

    <main id="mainContent" class="main-content">

        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
