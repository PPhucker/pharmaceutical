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
                                data-bs-target="#offcanvasAccount"
                                aria-controls="offcanvasAccount">
                            {{ Auth::user()->name }}
                        </button>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
