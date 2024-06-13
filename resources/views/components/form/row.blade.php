@props(['label' => null])
<div class="row d-flex">
    @if(isset($label))
        {{$label}}
    @endif
    <div class="col">
        {{$slot}}
    </div>
</div>
