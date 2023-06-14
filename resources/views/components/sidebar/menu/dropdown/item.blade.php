<div class="dropend">
    <button class="btn border-0 text-primary text-start dropdown-toggle"
       type="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">
        <i class="{{$icon}} pe-2 fs-5"></i>
        {{$title}}
    </button>
    <ul class="dropdown-menu border-0 text-primary">
        {{$slot}}
    </ul>
</div>
