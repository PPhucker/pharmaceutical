@props(['value', 'text', 'selected' => null])
<option class="form-control m-1"
        value="{{$value}}"
        @if($selected)
            selected
    @endif>
    {{$text}}
</option>
