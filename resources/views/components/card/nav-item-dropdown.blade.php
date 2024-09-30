@props(['title'])
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-primary fw-bold"
       data-bs-toggle="dropdown"
       href="#"
       role="button"
       aria-expanded="false">
        {{$title}}
    </a>
    <ul class="dropdown-menu">
        {{$slot}}
    </ul>
</li>
