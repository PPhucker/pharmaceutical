@props(['organizations'])
<div class="offcanvas offcanvas-{{$position}}"
     tabindex="-1"
     id="offcanvas{{$id}}"
     aria-labelledby="sidebar{{$label}}">
    <div class="offcanvas-header pb-2">
        <h4 class="offcanvas-title text-primary"
            id="sidebar{{$label}}">
            {{$title}}
        </h4>
        <button type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close">
        </button>
    </div>

    <div class="offcanvas-body ps-2 pe-2 pt-0">
        {{$slot}}
    </div>
</div>
