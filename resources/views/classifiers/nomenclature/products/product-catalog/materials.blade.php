@planning
<x-form.nav-tab formId="materials_main_form">
    <div class="row">
        <div class="collapse card border-0 mt-2"
             id="materials_add_card">
            <div class="card-header bg-primary text-white">
                {{__('form.titles.add')}}
            </div>
            <div class="card-body p-1 border-0">
                <x-form
                    :route="route('product_catalog.attach_material', ['product_catalog' => $productCatalog->id])"
                    formId="materials_add_form"
                    method="PATCH"
                    class="mt-2">
                    <x-data-table.table
                        id="materialas_add_table"
                        type="create"
                        targets="0"
                        pageLength="15">
                        <x-data-table.head>
                            <x-data-table.th/>
                            <x-data-table.th
                                class="col-md-3"
                                :text="__('classifiers.nomenclature.materials.name')"/>
                            <x-data-table.th
                                :text="__('classifiers.nomenclature.materials.okei_code')"/>
                        </x-data-table.head>
                        <x-data-table.body>
                            @foreach($materials as $key => $material)
                                <x-data-table.tr>
                                    <x-data-table.td>
                                        <x-form.element.input
                                            id="product_catalog_materials[{{$key}}][material]"
                                            name="material[id]"
                                            :value="$material->id"
                                            type="radio"
                                            class="form-check-input"/>
                                    </x-data-table.td>
                                    <x-data-table.td class="text-start">
                                        {{$material->name}}
                                    </x-data-table.td>
                                    <x-data-table.td>
                                        {{$material->okei->symbol}}
                                    </x-data-table.td>
                                </x-data-table.tr>
                            @endforeach
                        </x-data-table.body>
                    </x-data-table.table>
                    <footer class="mt-auto me-auto sticky-top">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <x-form.button.save formId="materials_add_form"/>
                            </li>
                        </ul>
                    </footer>
                </x-form>
            </div>
        </div>
        <div class="col-md-12 col-auto">
            <x-data-table.table
                id="materials_table"
                type="edit"
                targets="-1">
                <x-data-table.head>
                    <x-data-table.th :text="__('ID')"/>
                    <x-data-table.th
                        :text="__('classifiers.nomenclature.materials.name')"/>
                    <x-data-table.th :text="__('classifiers.nomenclature.materials.okei_code')"/>
                    <x-data-table.th/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($productCatalog->materials as $key => $material)
                        <x-data-table.tr>
                            <x-data-table.td>
                                {{$material->id}}
                            </x-data-table.td>
                            <x-data-table.td class="text-start">
                                {{$material->name}}
                            </x-data-table.td>
                            <x-data-table.td>
                                {{$material->okei->symbol}}
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-data-table.button.detach
                                    id="material-{{$material->id}}"
                                    route="product_catalog.detach_material"
                                    :params="['product_catalog' => $productCatalog->id]">
                                    <x-form.element.input
                                        type="hidden"
                                        name="material[id]"
                                        :value="$material->id"/>
                                </x-data-table.button.detach>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <x-form.button.collapse
                            divId="materials_add_card"
                            :title="__('form.titles.add')"/>
                    </li>
                </ul>
            </footer>
        </div>
    </div>
</x-form.nav-tab>
@end_planning
