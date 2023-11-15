<div class="card mb-2">
    <div class="card-header form-control form-control-sm bg-info border-0 text-primary">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <a class="btn-light btn-link"
                   data-bs-toggle="collapse"
                   href="#{{$cardId}}"
                   role="button"
                   aria-expanded="false"
                   aria-controls="card_main_info"
                   title="{{__('form.collapse')}}">
                    <i class="bi bi-arrows-expand text-primary fs-4 align-middle"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <span class="align-middle fw-bold">
                    {{mb_strtoupper($title)}}
                </span>
            </li>
        </ul>
    </div>
    <div id="{{$cardId}}" class="collapse show">
        <div class="card-body p-2">
            <form id="{{$formId}}"
                  class="text-primary"
                  method="POST"
                  action="{{$route}}"
                  enctype="multipart/form-data">
                @if(isset($cardBody))
                    {{$cardBody}}
                @endif
                @method('PATCH')
                @csrf
            </form>
        </div>
        @if(isset($footer))
            <div class="card-footer bg-info border-0 sticky-top">
                {{$footer}}
            </div>
        @endif
    </div>
</div>
