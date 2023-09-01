<div class="card mb-2">
    <ul class="card-header list-inline form-control form-control-sm bg-secondary border-0">
        <li class="list-inline-item">
            <a class="btn-light btn-link"
               data-bs-toggle="collapse"
               href="#printing-document"
               role="button"
               aria-expanded="false"
               aria-controls="card_main_info"
               title="{{__('form.collapse')}}">
                <i class="bi bi-card-text text-primary fs-5 align-middle"></i>
            </a>
        </li>
        <li class="list-inline-item">
                            <span class="align-middle fw-bold text-primary">
                                {{mb_strtoupper(__('documents.print'))}}
                            </span>
        </li>
        <li class="list-inline-item col-md-5">
            <div class="input-group input-group-sm mb-0">
                <input type="text"
                       class="form-control form-control-sm text-primary"
                       id="title"
                       value="{{trim($title)}}"
                       disabled>
                <span class="input-group-text text-primary p-0">
                                <a class="btn btn-sm btn-primary"
                                   role="button"
                                   onclick="printDoc()"
                                   title="{{__('form.button.print')}}">
                                    <i class="bi bi-printer align-middle fs-6"></i>
                                </a>
                            </span>
            </div>
        </li>
        <li class="list-inline-item col-md-3 align-middle">
            <div class="input-group input-group-sm mb-0">
                            <span class="input-group-text text-primary">
                            {{__('form.zoom')}}
                            </span>
                <input type="range"
                       id="zoom"
                       class="form-range form-control form-control-sm bg-secondary"
                       min="100"
                       max="300"
                       step="10"
                       value="100">
                <span class="input-group-text text-primary"
                      id="result">
                                    100%
                                </span>
            </div>
        </li>
    </ul>
    <div class="show card-body print p-0">
            {{$slot}}
    </div>
</div>
@if(isset($approval))
    {{$approval}}
@endif
<script>
    const template = document.getElementById('document-template');
    const title = document.getElementById('title');
    const zoom = document.getElementById('zoom');
    const result = document.getElementById('result');

    let currIEZoom = 100;
    let initialZoom = template.style.zoom;

    zoom.oninput = function() {
        currIEZoom = zoom.value;
        template.style.zoom = ' ' + currIEZoom + '%';
        result.innerHTML = zoom.value + '%';
    };

    function printDoc() {
        template.classList.remove('table-responsive');

        document.title = title.value;
        template.style.zoom = initialZoom;

        window.print();

        template.style.zoom = ' ' + currIEZoom + '%';
        template.classList.add('table-responsive');
    }
</script>


