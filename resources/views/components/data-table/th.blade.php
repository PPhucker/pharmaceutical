@props(['text' => null, 'class' => '', 'rowspan' => null, 'colspan' => null])
<th scope="col"
    class="{{$class}} col-auto align-middle text-center border-start border-0"
    @if($rowspan) rowspan="{{$rowspan}}" @endif
    @if($colspan) colspan="{{$colspan}}" @endif>
    {{$text}}
</th>
