@props([
    'formId',
    'route',
    'method' => null,
    'active' => null,
    'class' => null
    ])
@aware(['formId'])
<style>
    form {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    footer {
        margin-top: auto;
    }
</style>
<form id="{{$formId}}"
      class="text-primary {{$class}} h-100"
      method="POST"
      action="{{$route}}">
    {{$slot}}
    @if($method)
        @method($method)
    @endif
    @csrf
</form>
