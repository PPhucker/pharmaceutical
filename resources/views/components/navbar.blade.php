<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid align-middle">
        @auth
            <button class="me-3 navbar-toggler"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasSidebar"
                    type="button"
                    aria-controls="offcanvasSidebar"
                    style="display: block;">
                <span class="navbar-toggler-icon text-primary"></span>
            </button>
        @endauth
        <a class="navbar-brand text-primary"
           href="{{ url('/') }}">
            {{session('organization_name')}}
        </a>
        <div class="collapse navbar-collapse"
             id="navbarSupportedContent">
            <ul class="navbar-nav me-auto"></ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                    <span class="text-primary me-2 text-muted">
                        {{auth()->user()->name}}
                    </span>
                    </li>
                    <li class="nav-item">
                    <span class="text-primary me-2">
                        -
                    </span>
                    </li>
                    @foreach(auth()->user()->roles as $role)
                        <li class="nav-item">
                            <span class="text-primary text-muted me-3">
                                {{$role->name}}
                            </span>
                        </li>
                    @endforeach
                @endauth
            </ul>
        </div>
        @auth()
            <button class="me-3 navbar-toggler"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasAccount"
                    type="button"
                    aria-controls="offcanvasAccount"
                    style="display: block;">
                <span class="navbar-toggler-icon text-primary"></span>
            </button>
        @endauth
    </div>
</nav>
