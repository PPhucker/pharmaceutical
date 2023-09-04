<div class="card border-0">
    <div class="card-header d-grid gap-2 bg-white p-1 border-0">
        <button class="btn text-primary dropdown-toggle text-start fs-5"
                type="button"
                data-bs-toggle="collapse"
                href="#classifiers"
                role="button"
                aria-expanded="false"
                aria-controls="classifiers">
            {{mb_strtoupper(__('classifiers.classifiers'))}}
        </button>
    </div>
    {{--Классификаторы--}}
    <div class="card-body pt-1 pb-1 show" id="classifiers">
        @roles(['marketing', 'bookkeeping'])
        <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                      title="{{__('classifiers.legal_forms.legal_forms')}}">
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                          route="{{route('legal_forms.index')}}"/>
        </x-sidebar.menu.dropdown.item>
        <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                      title="{{__('classifiers.banks.banks')}}">
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                          route="{{route('banks.index')}}"/>
        </x-sidebar.menu.dropdown.item>
        @end_marketing
        {{--Номенклатура--}}
        <div class="card border-0">
            <div class="card-header d-grid gap-2 bg-white p-1 border-0">
                <button class="btn text-primary dropdown-toggle text-start fs-6"
                        type="button"
                        data-bs-toggle="collapse"
                        href="#nomenclature"
                        role="button"
                        aria-expanded="false"
                        aria-controls="nomenclature">
                    {{mb_strtoupper(__('classifiers.nomenclature.nomenclature'))}}
                </button>
            </div>
            <div class="card-body pt-1 pb-1 show" id="nomenclature">
                @roles(['marketing', 'planning'])
                <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                              title="{{__('classifiers.nomenclature.okei.okei')}}">
                    <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                  route="{{route('okei.index')}}"/>
                </x-sidebar.menu.dropdown.item>
                <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                              title="{{__('classifiers.nomenclature.services.services')}}">
                    <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                  route="{{route('services.index')}}"/>
                </x-sidebar.menu.dropdown.item>
                @end_roles
                {{--Готовая продукция--}}
                <div class="card border-0">
                    <div class="card-header d-grid gap-2 bg-white p-1 border-0">
                        <button class="btn text-primary dropdown-toggle text-start fs-6"
                                type="button"
                                data-bs-toggle="collapse"
                                href="#products"
                                role="button"
                                aria-expanded="false"
                                aria-controls="products">
                            {{mb_strtoupper(__('classifiers.nomenclature.products.products'))}}
                        </button>
                    </div>
                    <div class="card-body pt-1 pb-1 collapse" id="products">
                        <x-sidebar.menu.dropdown.item icon="bi bi-file-post"
                                                      title="{{__('classifiers.nomenclature.products.product_catalog.product_catalog')}}">
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                                          route="{{route('product_catalog.create')}}"/>
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                          route="{{route('product_catalog.index')}}"/>
                        </x-sidebar.menu.dropdown.item>
                        @marketing
                        <x-sidebar.menu.dropdown.item icon="bi bi-file-post"
                                                      title="{{__('classifiers.nomenclature.products.products')}}">
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                                          route="{{route('end_products.create')}}"/>
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                          route="{{route('end_products.index')}}"/>
                        </x-sidebar.menu.dropdown.item>
                        <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                                      title="{{__('classifiers.nomenclature.products.types_of_end_products.types_of_end_products')}}">
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                          route="{{route('types_of_end_products.index')}}"/>
                        </x-sidebar.menu.dropdown.item>
                        <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                                      title="{{__('classifiers.nomenclature.products.international_names_of_end_products.international_names_of_end_products')}}">
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                          route="{{route('international_names.index')}}"/>
                        </x-sidebar.menu.dropdown.item>
                        <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                                      title="{{__('classifiers.nomenclature.products.okpd2.okpd2')}}">
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                          route="{{route('okpd2.index')}}"/>
                        </x-sidebar.menu.dropdown.item>
                        <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                                      title="{{__('classifiers.nomenclature.products.registration_numbers.registration_numbers')}}">
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                          route="{{route('registration_numbers.index')}}"/>
                        </x-sidebar.menu.dropdown.item>
                        @end_marketing
                        <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                                      title="{{__('classifiers.nomenclature.products.types_of_aggregation.types_of_aggregation')}}">
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                          route="{{route('types_of_aggregation.index')}}"/>
                        </x-sidebar.menu.dropdown.item>

                    </div>
                </div>
                @roles(['planning', 'marketing'])
                {{--Комплектующие--}}
                <div class="card border-0">
                    <div class="card-header d-grid gap-2 bg-white p-1 border-0">
                        <button class="btn text-primary dropdown-toggle text-start fs-6"
                                type="button"
                                data-bs-toggle="collapse"
                                href="#materials"
                                role="button"
                                aria-expanded="false"
                                aria-controls="materials">
                            {{mb_strtoupper(__('classifiers.nomenclature.materials.materials'))}}
                        </button>
                    </div>
                    <div class="card-body pt-1 pb-1 collapse" id="materials">
                        <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                                      title="{{__('classifiers.nomenclature.materials.types_of_materials.types_of_materials')}}">
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                          route="{{route('types_of_materials.index')}}"/>
                        </x-sidebar.menu.dropdown.item>
                        <x-sidebar.menu.dropdown.item icon="bi bi-archive"
                                                      title="{{__('classifiers.nomenclature.materials.materials')}}">
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                                          route="{{route('materials.create')}}"/>
                            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                          route="{{route('materials.index')}}"/>
                        </x-sidebar.menu.dropdown.item>
                    </div>
                </div>
                @end_roles
            </div>
        </div>
    </div>
</div>
