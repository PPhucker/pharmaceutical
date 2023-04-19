<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.min.js')}}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @verified()
    <x-navbar/>
    @include('layouts.symbols')

        <x-sidebar.menu position="start"
                        id="Sidebar"
                        label="MenuLabel"
                        title="{{__('sidebar.main_menu')}}">
            <x-sidebar.menu.admin/>
            <x-sidebar.menu.contractors/>
            <x-sidebar.menu.documents/>
            <x-sidebar.menu.classifiers/>
        </x-sidebar.menu>
        <x-sidebar.menu position="end"
                        id="Account"
                        label="AccountLabel"
                        title="{{__('sidebar.account.account')}}">
            <x-sidebar.menu.submit-button route="{{route('logout')}}"
                                          formId="logoutForm"
                                          icon="bi bi-door-open-fill"
                                          title="{{__('sidebar.account.logout')}}"/>
        </x-sidebar.menu>
    @endverified
    <main role="main"
          style="max-height: 100vh; max-width: 100vw">
        @yield('content')
    </main>
</div>
</body>
</html>
