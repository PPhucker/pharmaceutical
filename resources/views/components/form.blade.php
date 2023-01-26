<div class="justify-content-center">
    <div class="card shadow">
        <ul class="card-header bg-primary list-inline ps-0 pe-0 pt-1 pb-1">
            <li class="list-inline-item">
                <a class="btn btn-link text-white"
                   href="{{$back}}"
                   title="">
                    <i class="bi bi-arrow-90deg-left align-middle fs-5"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <span class="align-middle text-white">
                    {{$title}}
                </span>
            </li>
        </ul>
        <div class="card-body p-2">
            <x-alert/>
            {{$slot}}
        </div>
    </div>
</div>
