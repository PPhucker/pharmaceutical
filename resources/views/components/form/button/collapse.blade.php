@props(['divId', 'title'])
<button class="btn btn-primary"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#{{$divId}}"
        aria-expanded="false"
        aria-controls="{{$divId}}">
    {{$title}}
</button>
