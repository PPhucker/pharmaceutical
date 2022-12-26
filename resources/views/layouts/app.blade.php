<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid align-middle">
            @auth
                <button class="me-3 navbar-toggler"
                        data-bs-toggle="offcanvas"
                        href="#offcanvasExample"
                        type="button"
                        aria-controls="offcanvasExample"
                        style="display: block">
                    <span class="navbar-toggler-icon text-primary"></span>
                </button>
            @endauth
            <a class="navbar-brand text-primary"
               href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false">
                <span class="navbar-toggler-icon text-primary"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto"></ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @auth
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <button class="btn border-0 text-primary"
                                    type="button"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight">
                                {{ Auth::user()->name }}
                            </button>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    @include('layouts.icons.symbols')
    @auth
        @include('layouts.sidebar.menu')
        @include('layouts.account.menu')
    @endauth
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
