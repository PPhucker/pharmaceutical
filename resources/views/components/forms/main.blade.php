@props(['title'])
<div class="d-flex justify-content-center m-3">
    <div class="card shadow w-100">
        <ul class="card-header bg-primary list-inline ps-0 pe-0 pt-1 pb-1">
            <li class="list-inline-item ms-2">
                <a class="btn btn-sm btn-primary text-white"
                   href="{{--{{$back}}--}}{{URL::previous()}}"
                   title="{{__('form.button.back')}}">
                    <i class="bi bi-arrow-90deg-left align-middle fs-6"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <span class="align-middle fs-6 text-white">
                    {{$title}}
                </span>
            </li>
        </ul>
        <div class="card-body p-2">
            <x-forms.alert/>
            {{$slot}}
        </div>
        @if(isset($footer))
            <div class="card-footer sticky-bottom bg-secondary border-0 ps-2 pe-2">
                {{$footer}}
            </div>
        @endif
    </div>
</div>
