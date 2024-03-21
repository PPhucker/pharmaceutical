@aware(['model'])
@props(['disabled' => null])
<select class="border-0 m-1 form-control text-primary @error($errorName) is-invalid @enderror"
        id="{{$id}}"
        name="@if($model && $model->trashed())trashed-@endif{{$name}}" @if($disabled) disabled @endif>
    {{$slot}}
</select>
<x-error.span-error name="{{$errorName}}"/>
