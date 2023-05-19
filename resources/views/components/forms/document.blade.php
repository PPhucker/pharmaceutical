@extends('layouts.app')
@section('content')
    <div class="justify-content-center m-3 print">
        <div class="card shadow w-100">
            <ul class="card-header bg-primary list-inline ps-0 pe-0 pt-1 pb-1">
                <li class="list-inline-item ms-2">
                    <a class="btn btn-sm btn-primary text-white"
                       href="{{$back}}"
                       title="">
                        <i class="bi bi-arrow-90deg-left align-middle fs-6"></i>
                    </a>
                </li>
                <li class="list-inline-item col-md-5">
                    <input type="text"
                           class="form-control form-control-sm text-primary"
                           id="title"
                           value="{{trim($title)}}"
                           disabled>
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
                <li class="list-inline-item">
                    <a class="btn btn-sm btn-primary"
                       onclick="printDoc()"
                       title="{{__('form.button.print')}}">
                        <i class="bi bi-printer align-middle text-white fs-5"></i>
                    </a>
                </li>
            </ul>
            <div class="card-body print">
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
                                {{__('documents.print')}}
                            </span>
                        </li>
                    </ul>
                    <div class="show" id="printing-document">
                        <div class="card-body p-0">
                            {{$slot}}
                        </div>
                    </div>
                </div>
            </div>
            <div id="approval">
                @if(isset($approval))
                    {{$approval}}
                @endif
            </div>
        </div>
    </div>
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
@endsection

