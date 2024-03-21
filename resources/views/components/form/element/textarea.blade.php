@aware(['model'])
<textarea
    class="border-0 m-1 auto-expand form-control text-primary @error($errorName) is-invalid @enderror"
    id="{{$id}}"
    name="@if($model && $model->trashed())trashed-@endif{{$name}}"
    rows="1" @if($readonly) readonly @endif>{{$text}}</textarea>
<x-error.span-error name="{{$errorName}}"/>
