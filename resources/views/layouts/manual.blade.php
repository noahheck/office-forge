<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Office Forge') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/manual.css') }}" rel="stylesheet">
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
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{ route('manual') }}">
                        {!! \App\icon\help() !!}
                    </a>
                </li>
                {{--<li class="nav-item dropdown">
                    <a id="addNewNavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fas fa-plus-circle"></span> <span class="sr-only">Create New</span>
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
                </li>--}}
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

                    <div class="col-12 col-md-4 col-lg-3 nav-sidebar">

                        <div class="nav-header">
                            <img src="{{ asset('/images/of_logo_50.png') }}" alt="Office Forge Logo">
{{--                            <h2 class="h4">{{ config('app.name', 'Office Forge') }}</h2>--}}
                            <h2 class="h4">User Manual</h2>
                        </div>


                        <div class="list-group">

                            <a class="list-group-item list-group-item-action">
                                Home
                            </a>
                            <a class="list-group-item list-group-item-action active">
                                Dashboard
                            </a>
                            <a class="list-group-item list-group-item-action">
                                Files
                            </a>
                            <a class="list-group-item list-group-item-action">
                                Activities
                            </a>


                        </div>


                    </div>

                    <div class="col-12 col-md-8 col-lg-9">

                        <main id="mainContent" class="main-content">

                            <h1>Welcome to the User Manual</h1>


                            @yield('content')
                        </main>

                    </div>

                </div>
            </div>
        </div>

    </div>

</body>
</html>
