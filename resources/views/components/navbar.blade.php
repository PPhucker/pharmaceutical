<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid align-middle">
        @auth
            <button class="me-3 navbar-toggler"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasSidebar"
                    type="button"
                    aria-controls="offcanvasSidebar"
                    style="display: block">
                <span class="navbar-toggler-icon text-primary"></span>
            </button>
        @endauth
        <a class="navbar-brand text-primary"
           href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto"></ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                    <span class="text-primary me-2">
                        {{auth()->user()->name}}
                    </span>
                    </li>
                @endauth
            </ul>
        </div>
        @auth()
            <button class="me-3 navbar-toggler"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasAccount"
                    type="button"
                    aria-controls="offcanvasAccount"
                    style="display: block">
                <span class="navbar-toggler-icon text-primary"></span>
            </button>
        @endauth
    </div>
</nav>
