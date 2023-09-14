<div>
    <a class="btn btn-hover @if($disabled) disabled @endif"
       href="{{$route}}"
       id="button-{{$itemId}}"
       onclick="event.preventDefault();document.getElementById('copy-form-{{$itemId}}').submit();"
       title="{{__('datatable.buttons.copy')}}">
        <i class="bi bi-copy align-middle"></i>
        <form class="m-0"></form>
        <form id="copy-form-{{$itemId}}"
              action="{{$route}}"
              method="POST"
              class="d-none">
            @csrf
            @method('POST')
        </form>
    </a>
</div>
