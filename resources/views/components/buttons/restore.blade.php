<a class="btn btn-hover"
   href="{{$route}}"
   onclick="event.preventDefault();document.getElementById('restore-form-{{$itemId}}').submit();"
   title="{{__('datatable.buttons.restore')}}">
    <i class="bi bi-arrow-bar-up"></i>
</a>
<form id="restore-form-{{$itemId}}"
      action="{{$route}}"
      method="POST"
      class="d-none">
    @csrf
</form>
