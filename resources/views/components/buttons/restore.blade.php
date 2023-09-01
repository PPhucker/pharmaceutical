@permissions(['restoring'])
<div>
    <a class="btn btn-hover @if($disabled) disabled @endif"
       href="{{$route}}"
       onclick="event.preventDefault();document.getElementById('restore-form-{{$itemId}}').submit();"
       title="{{__('datatable.buttons.restore')}}">
        <i class="bi bi-arrow-bar-up"></i>
    </a>
    <form></form>
    <form id="restore-form-{{$itemId}}"
          action="{{$route}}"
          method="POST"
          class="d-none">
        @csrf
    </form>
</div>
@end_permissions
