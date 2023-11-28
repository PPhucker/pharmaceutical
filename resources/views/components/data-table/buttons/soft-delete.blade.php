@props(['trashed', 'id', 'route', 'params'])
@if($trashed)
    @permissions(['restoring'])
    <div>
        <a class="btn btn-hover"
           href="{{route($route . '.restore', $params)}}"
           onclick="event.preventDefault();document.getElementById('restore-form-{{$id}}').submit();"
           title="{{__('datatable.buttons.restore')}}">
            <i class="bi bi-arrow-bar-up"></i>
        </a>
        <form></form>
        <form id="restore-form-{{$id}}"
              action="{{route($route . '.restore', $params)}}"
              method="POST"
              class="d-none">
            @csrf
        </form>
    </div>
    @end_permissions
@else
    @deleting
    <div>
        <a class="btn btn-hover"
           href="{{route($route . '.destroy', $params)}}"
           id="button-{{$id}}"
           onclick="event.preventDefault();document.getElementById('destroy-form-{{$id}}').submit();"
           title="{{__('datatable.buttons.delete')}}">
            <i class="bi bi-trash3-fill align-middle"></i>
            <form class="m-0"></form>
            <form id="destroy-form-{{$id}}"
                  action="{{route($route . '.destroy', $params)}}"
                  method="POST"
                  class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </a>
    </div>
    @end_deleting
@endif



