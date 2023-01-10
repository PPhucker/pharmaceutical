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
    <x-navbar/>
    @include('layouts.symbols')
    @auth
        <x-sidebar.menu position="start"
                        id="Sidebar"
                        label="MenuLabel"
                        title="Main Menu">
            <x-sidebar.menu.admin/>
            <x-sidebar.menu.docs.shipment/>
            <x-sidebar.menu.production/>
        </x-sidebar.menu>
        <x-sidebar.menu position="end"
                        id="Account"
                        label="AccountLabel"
                        title="Account">
            <x-sidebar.menu.submit-button route="{{route('logout')}}"
                                          formId="logoutForm"
                                          icon="bi bi-door-open-fill"
                                          title="Logout"/>
        </x-sidebar.menu>
    @endauth
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
