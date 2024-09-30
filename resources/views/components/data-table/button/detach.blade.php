@props(['id', 'route', 'params'])
@deleting
<div>
    <a type="button"
       class="btn btn-hover"
       data-bs-toggle="modal"
       data-bs-target="#modal-destroy-{{$id}}"
       title="{{__('datatable.buttons.delete')}}">
        <i class="bi bi-trash3-fill align-middle"></i>
    </a>
</div>
<div class="modal fade"
     id="modal-destroy-{{$id}}"
     tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Закрыть"></button>
            </div>
            <div class="modal-body text-primary">
                {{__('form.modal.delete')}}
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    {{__('form.modal.close')}}
                </button>
                <div>
                    <a class="btn btn-primary"
                       href="{{route($route, $params)}}"
                       id="{{$route}}-destroy-href-{{$id}}"
                       onclick="FormUtils.destroy('{{$route}}', '{{$id}}')">
                        {{__('datatable.buttons.delete')}}
                        <div class="spinner-border spinner-border-sm text-white align-middle d-none"
                             role="status">
                        </div>
                        <form class="m-0"></form>
                        <form id="{{$route}}-destroy-form-{{$id}}"
                              action="{{route($route, $params)}}"
                              method="POST"
                              class="d-none">
                            @csrf
                            @method('PATCH')
                            {{$slot}}
                        </form>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@end_deleting


