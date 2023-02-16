<div class="offcanvas-header pt-2 pb-2 ps-2">
    <h5 class="offcanvas-title text-primary fw-bolder">
        <a class="btn-link"
           data-bs-toggle="collapse"
           href="#classifiers"
           role="button"
           aria-expanded="false"
           aria-controls="classifiers">
            {{__('classifiers.classifiers')}}
        </a>
    </h5>
</div>
<div class="collapsed" id="classifiers">
    <x-sidebar.menu.link title="{{__('classifiers.legal_forms.legal_forms')}}"
                         route="{{route('legal_forms.index')}}"
                         icon="bi bi-archive"/>
    <x-sidebar.menu.link title="{{__('classifiers.banks.banks')}}"
                         route="{{route('banks.index')}}"
                         icon="bi bi-archive"/>
</div>
