<div>
    <button type="button"
            class="btn text-primary border-0 col-5 text-start"
            href="{{$route}}"
            onclick="event.preventDefault();
        document.getElementById('{{$form}}').submit();">
        <i class="{{$icon}} pe-2 fs-5"></i>
        {{$title}}
    </button>

    <form id="{{$form}}" action="{{$route}}" method="POST" class="d-none">
        @csrf
    </form>
</div>
