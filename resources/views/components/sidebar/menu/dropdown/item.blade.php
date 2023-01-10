<div class="dropend row ps-2">
    <button type="button"
            class="btn text-primary border-0 col-6 text-start">
        <i class="{{$icon}} pe-2 fs-5"></i>
        {{$title}}
    </button>
    <button type="button"
            class="btn col-1 border-0 dropdown-toggle dropdown-toggle-split text-primary fs-5 me-2"
            data-bs-toggle="dropdown"
            aria-expanded="false">
    </button>
    <ul class="dropdown-menu border-0 mt-2 ps-2 pe-0 pt-0 pb-0 fs-6 text-primary">
        {{$slot}}
    </ul>
</div>
