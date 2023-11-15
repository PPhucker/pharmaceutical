<div class="card
@if($errors->has($errorName)) collapsed @else collapse @endif"
     id="{{$cardId}}">
    <div class="card-header bg-info form-control form-control-sm fw-bold border-0 text-primary">
        {{mb_strtoupper(__('form.titles.add'))}}
    </div>
    <div class="card-body text-primary">
        @if(isset($cardBody))
            {{$cardBody}}
        @endif
    </div>
    <div class="card-footer border-0 sticky-top bg-info">
        @if(isset($footer))
            {{$footer}}
        @endif
    </div>
</div>
