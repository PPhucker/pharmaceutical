@props(['id', 'title', 'active' => null])
<button class="nav-link text-primary fw-bold @if($active) active @endif"
        id="nav-{{$id}}-tab"
        data-bs-toggle="tab"
        data-bs-target="#nav-{{$id}}"
        type="button"
        role="tab"
        aria-controls="nav-{{$id}}"
        aria-selected="@if($active) true @else false @endif">
    {{$title}}
    <div
        class="spinner-border spinner-border spinner-border-sm text-primary align-middle d-none"
        role="status">
    </div>
</button>
