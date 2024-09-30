@props([
    'formId',
    'active' => null,
    'class' => null
    ])
<div class="m-2 tab-pane fade @if($active)active show @endif {{$class}}"
     id="nav-{{$formId}}"
     role="tabpanel"
     aria-labelledby="nav-{{$formId}}-tab">
    {{$slot}}
</div>
