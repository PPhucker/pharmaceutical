<div>
    <a class="btn btn-hover"
       href="{{$route}}"
       id="button-{{$itemId}}"
       onclick="event.preventDefault();document.getElementById('destroy-form-{{$itemId}}').submit();"
       title="{{__('datatable.buttons.delete')}}">
        <i class="bi bi-trash3-fill align-middle"></i>
        <form class="m-0"></form>
        <form id="destroy-form-{{$itemId}}"
              action="{{$route}}"
              method="POST"
              class="d-none">
            @csrf
            @method('DELETE')
        </form>
    </a>
</div>


