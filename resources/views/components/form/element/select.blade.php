@props(['disabled' => null])
<select class="border-0 m-1 form-control text-primary @error($errorName) is-invalid @enderror"
        id="{{$id}}"
        name="{{$name}}" @if($disabled) disabled @endif>
    {{$slot}}
</select>
<x-error.span-error name="{{$errorName}}"/>
