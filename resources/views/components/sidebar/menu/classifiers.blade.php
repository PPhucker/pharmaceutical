<div class="offcanvas-header pt-2 pb-2 ps-2">
    <h4 class="offcanvas-title text-primary">
        <a class="btn-link"
           data-bs-toggle="collapse"
           href="#classifiers"
           role="button"
           aria-expanded="false"
           aria-controls="classifiers">
            {{__('classifiers.classifiers')}}
        </a>
    </h4>
</div>
<div class="collapse" id="classifiers">
    <x-sidebar.menu.link title="{{__('classifiers.legal_forms.legal_forms')}}"
                         route="{{route('legal_forms.index')}}"
                         icon="bi bi-archive-fill"/>
    <x-sidebar.menu.link title="{{__('classifiers.banks.banks')}}"
                         route="{{route('banks.index')}}"
                         icon="bi bi-archive-fill"/>

    <div class="offcanvas-header pt-2 pb-2 ps-2">
        <h4 class="offcanvas-title text-primary">
            <a class="btn-link"
               data-bs-toggle="collapse"
               href="#nomenclature"
               role="button"
               aria-expanded="false"
               aria-controls="nomenclature">
                {{__('classifiers.nomenclature.nomenclature')}}
            </a>
        </h4>
    </div>
    <div class="collapse" id="nomenclature">
        <x-sidebar.menu.link
            title="{{__('classifiers.nomenclature.okei.okei')}}"
            route="{{route('okei.index')}}"
            icon="bi bi-archive-fill"/>
        <div class="offcanvas-header pt-2 pb-2 ps-2">
            <h5 class="offcanvas-title text-primary">
                <a class="btn-link"
                   data-bs-toggle="collapse"
                   href="#products"
                   role="button"
                   aria-expanded="false"
                   aria-controls="products">
                    {{__('classifiers.nomenclature.products.products')}}
                </a>
            </h5>
        </div>
        <div class="collapse" id="products">
            <x-sidebar.menu.dropdown.item icon="bi bi-file-post"
                                          title="{{__('classifiers.nomenclature.products.product_catalog.product_catalog')}}">
                <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                              route="{{route('product_catalog.create')}}"/>
                <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                              route="{{route('product_catalog.index')}}"/>
            </x-sidebar.menu.dropdown.item>
            <x-sidebar.menu.dropdown.item icon="bi bi-file-post"
                                          title="{{__('classifiers.nomenclature.products.products')}}">
                <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                              route="{{route('end_products.create')}}"/>
                <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                              route="{{route('end_products.index')}}"/>
            </x-sidebar.menu.dropdown.item>
            <x-sidebar.menu.link
                title="{{__('classifiers.nomenclature.products.types_of_end_products.types_of_end_products')}}"
                route="{{route('types_of_end_products.index')}}"
                icon="bi bi-archive-fill"/>
            <x-sidebar.menu.link
                title="{{__('classifiers.nomenclature.products.international_names_of_end_products.international_names_of_end_products')}}"
                route="{{route('international_names.index')}}"
                icon="bi bi-archive-fill"/>
            <x-sidebar.menu.link
                title="{{__('classifiers.nomenclature.products.okpd2.okpd2')}}"
                route="{{route('okpd2.index')}}"
                icon="bi bi-archive-fill"/>
            <x-sidebar.menu.link
                title="{{__('classifiers.nomenclature.products.registration_numbers.registration_numbers')}}"
                route="{{route('registration_numbers.index')}}"
                icon="bi bi-archive-fill"/>
            <x-sidebar.menu.link
                title="{{__('classifiers.nomenclature.products.types_of_aggregation.types_of_aggregation')}}"
                route="{{route('types_of_aggregation.index')}}"
                icon="bi bi-archive-fill"/>
        </div>
        <div class="offcanvas-header pt-2 pb-2 ps-2">
            <h5 class="offcanvas-title text-primary">
                <a class="btn-link"
                   data-bs-toggle="collapse"
                   href="#materials"
                   role="button"
                   aria-expanded="false"
                   aria-controls="materials">
                    {{__('classifiers.nomenclature.materials.materials')}}
                </a>
            </h5>
        </div>
        <div class="collapse" id="materials">
            <x-sidebar.menu.link
                title="{{__('classifiers.nomenclature.materials.types_of_materials.types_of_materials')}}"
                route="{{route('types_of_materials.index')}}"
                icon="bi bi-archive-fill"/>
            <x-sidebar.menu.link
                title="{{__('classifiers.nomenclature.materials.materials')}}"
                route="{{route('materials.index')}}"
                icon="bi bi-archive-fill"/>
        </div>
    </div>
</div>
