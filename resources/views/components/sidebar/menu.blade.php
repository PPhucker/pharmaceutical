@props(['organizations'])
<div class="offcanvas offcanvas-{{$position}}"
     tabindex="-1"
     id="offcanvas{{$id}}"
     aria-labelledby="sidebar{{$label}}">
    <div class="offcanvas-header pb-2">
        <h5 class="offcanvas-title text-primary fw-normal"
            id="sidebar{{$label}}">
            {{mb_strtoupper($title)}}
        </h5>
        <button type="button"
                class="btn-close text-white bg-white form-control"
                data-bs-dismiss="offcanvas"
                aria-label="Close">
        </button>
    </div>
    <div class="offcanvas-body ps-2 pe-2 pt-0">
        {{$slot}}
    </div>
</div>
