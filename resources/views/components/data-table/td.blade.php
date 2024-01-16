@props(['class' => 'text-center', 'tableType' => null])
@aware(['type'])
<td class="{{$class}} col-auto align-middle @if($type !== 'index') border-0  @endif p-0 ps-1 pe-1">
    {{$slot}}
</td>
