@props(['id', 'title', 'active' => null])
<a class="dropdown-item @if($active) active @endif"
   id="nav-{{$id}}-tab"
   data-bs-toggle="tab"
   data-bs-target="#nav-{{$id}}"
   role="tab"
   href="#"
   aria-controls="nav-{{$id}}"
   aria-selected="@if($active) true @else false @endif">
    {{$title}}
    <div
        class="spinner-border spinner-border spinner-border-sm text-primary align-middle d-none"
        role="status">
    </div>
</a>
