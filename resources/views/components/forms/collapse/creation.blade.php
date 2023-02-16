<div class="card
@if($errors->has($errorName)) collapsed @else collapse @endif mb-2"
     id="{{$cardId}}">
    <div class="card-header bg-secondary form-control form-control-sm fw-bold border-0 text-primary">
        {{__('form.titles.add')}}
    </div>
    <div class="card-body">
        @if(isset($cardBody))
            {{$cardBody}}
        @endif
    </div>
    <div class="card-footer border-0 sticky-top bg-secondary">
        @if(isset($footer))
            {{$footer}}
        @endif
    </div>
</div>
