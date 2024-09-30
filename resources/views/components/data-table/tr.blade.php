@props(['model' => null])
<tr class="@if($model && $model->trashed()) d-none trashed @endif">
    @if(isset($hiddenInputs))
        {{$hiddenInputs}}
    @endif
    {{$slot}}
</tr>
