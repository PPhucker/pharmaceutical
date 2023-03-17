<div>
    <a class="btn btn-hover"
       href="{{$route}}"
       id="button-{{$itemId}}"
       onclick="event.preventDefault();document.getElementById('detach-form-{{$itemId}}').submit();"
       title="{{__('datatable.buttons.delete')}}">
        <i class="bi bi-trash3-fill align-middle"></i>
        <form class="m-0"></form>
        <form id="detach-form-{{$itemId}}"
              action="{{$route}}"
              method="POST"
              class="d-none">
            @csrf
            @method('PATCH')
            <input type="text"
                   value="{{$detachId}}"
                   name="{{$detachName}}[id]">
        </form>
    </a>
</div>
