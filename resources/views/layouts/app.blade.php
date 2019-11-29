@php
$__currentRouteName = Route::currentRouteName();
$__isAdminRoute     = Str::startsWith($__currentRouteName, 'admin.');
$__isSettingsRoute  = Str::startsWith($__currentRouteName, 'my-settings.');
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Office Forge') }}</title>


    <!-- Scripts -->
    @script('js/manifest.js')
    @script('js/vendor.js')
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>

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
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('app.login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('app.register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="application-sidebar" id="applicationSidebar">
        <ul>
            <li>
                <a href="{{ route('home') }}" class="{{ ($__currentRouteName === 'home') ? 'current' : '' }}">
                    <span class="fa-fw fas fa-home"></span> {{ __('app.home') }}
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="fa-fw far fa-envelope"></span> {{ __('app.messages') }}
                </a>
            </li>
            <li>
                <a href="{{ route('projects.index') }}">
                    <span class="fa-fw fas fa-project-diagram"></span> {{ __('app.projects') }}
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="fa-fw fas fa-file"></span> {{ __('app.documents') }}
                </a>
            </li>
            <li class="divider">
                <a href="{{ route('my-settings.index') }}" class="{{ ($__isSettingsRoute) ? 'current' : '' }}">
                    <span class="fa-fw fas fa-cog"></span> {{ __('app.mySettings') }}
                </a>
            </li>
            @admin
            <li>
                <a href="{{ route('admin.index') }}" class="{{ ($__isAdminRoute) ? 'current' : '' }}">
                    <span class="fa-fw fas fa-cogs"></span> {{ __('app.admin') }}
                </a>
            </li>
            @endadmin
            <li>
                <a href="#">
                    <span class="fa-fw far fa-question-circle"></span> {{ __('app.help') }}
                </a>
            </li>
            <li class="divider">
                <a href="{{ route('logout') }}">
                    <span class="fa-fw fas fa-sign-out-alt"></span> {{ __('app.logout') }}
                </a>
            </li>
        </ul>
    </div>

    <main id="mainContent" class="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

{{--    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>--}}
    @stack('scripts')
</body>
</html>
