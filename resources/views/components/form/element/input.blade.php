<input id="{{$id}}"
       type="{{$type}}"
       class="{{$class}} col-auto m-1 @if($type !== 'radio' && $type !== 'checkbox') border-0 @endif text-primary @error($errorName) is-invalid @enderror"
       name="{{$name}}"
       value="{{$value}}"
       @if($required) required @endif
       @if($readonly) readonly @endif
       @if($checked) checked @endif
       @if($min) minlength="{{$min}}" @endif
       @if($max) maxlength="{{$max}}" @endif>
<span class="d-none">{{$value}}</span>
<x-error.span-error name="{{$errorName}}"/>
