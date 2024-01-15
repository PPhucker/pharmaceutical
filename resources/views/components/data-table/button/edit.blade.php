@props(['route', 'target' => '_blank', 'disabled' => false])
<a class="btn btn-hover @if($disabled) disabled @endif"
   href="{{$route}}"
   title="{{__('datatable.buttons.edit')}}"
   target="{{$target}}">
    <i class="bi bi-pencil-fill"></i>
</a>
