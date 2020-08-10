<!DOCTYPE html>
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
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Styles -->
    <link href="{{ asset('css/manual.css') }}" rel="stylesheet">

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
</head>
<body>

    <nav class="navbar fixed-top navbar-expand-md navbar-dark header-navbar">
        <div class="container-fluid">

                <span>
                    <a href="#mainContent" class="skip-to-content-link">Skip to content</a>
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

    <div class="container-md">

        <div class="card">
            <div class="card-body">


                <div class="row">

                    <div class="col-12 col-md-4 col-lg-3">

                        <div class="nav-sidebar">


                            <div class="nav-header">
                                <img src="{{ asset('/images/of_logo_50.png') }}" alt="Office Forge Logo">
                                <h2 class="h4">User Manual</h2>
                            </div>

                            <div class="list-group">

                                <a class="list-group-item list-group-item-action{{ $key == 'home' ? ' active' : '' }}" href="{{ route('manual', ['home']) }}">
                                    Home
                                </a>
                                <a class="list-group-item list-group-item-action{{ $key == 'introduction' ? ' active' : '' }}" href="{{ route('manual', ['introduction']) }}">
                                   Introduction
                                </a>
                                <a class="list-group-item list-group-item-action{{ $key == 'access-controls' ? ' active' : '' }}" href="{{ route('manual', ['access-controls']) }}">
                                    Access Controls
                                </a>
                                {{--<a class="list-group-item list-group-item-action{{ $key == 'dashboard' ? ' active' : '' }}" href="{{ route('manual', ['dashboard']) }}">
                                    Dashboard
                                </a>
                                <a class="list-group-item list-group-item-action{{ $key == 'files' ? ' active' : '' }}" href="{{ route('manual', ['files']) }}">
                                    Files
                                </a>
                                <a class="list-group-item list-group-item-action{{ $key == 'activities' ? ' active' : '' }}" href="{{ route('manual', ['activities']) }}">
                                    Activities
                                </a>--}}

                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-md-8 col-lg-9">

                        <main id="mainContent" class="main-content">

                            @include("manual.en.$key")

                        </main>

                    </div>

                </div>

                <div class="copyright-info">

                    <hr>

                    &copy; {{ date('Y') }} - Pillar Falls Software, LLC

                </div>
        </div>

    </div>

</body>
</html>
