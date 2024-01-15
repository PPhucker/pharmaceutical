@props(['route', 'title', 'icon', 'target' => '_blank', 'disabled' => false])
<a class="btn btn-hover @if($disabled) disabled @endif"
   href="{{$route}}"
   title="{{$title}}"
   target="{{$target}}">
    <i class="{{$icon}}"></i>
</a>
