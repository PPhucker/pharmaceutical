@digital_communication
<x-form.nav-tab
    formId="aggregation_types_main_form">
    <div class="row">
        <div class="col-md col-auto mb-2">
            <x-form
                :route="route('product_catalog.attach_aggregation_type', ['product_catalog' => $productCatalog->id])"
                formId="aggregation_type_add_form"
                method="PATCH">
                <x-form.element.input
                    type="hidden"
                    name="product_catalog_types_of_aggregation[product_catalog_id]"
                    :value="$productCatalog->id"/>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="aggregation_type_code"
                            :text="__('classifiers.nomenclature.products.types_of_aggregation.code')"/>
                    </x-slot>
                    <x-form.element.select
                        id="aggregation_type_code"
                        name="product_catalog_types_of_aggregation[aggregation_type]">
                        @foreach($typesOfAggregation as $type)
                            <x-form.element.option
                                :value="$type->code"
                                :text="$type->name_with_code"
                                :selected="$type->code === old('product_catalog_types_of_aggregation.aggregation_type')"/>
                        @endforeach
                    </x-form.element.select>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="product_quantity"
                            :text="__('classifiers.nomenclature.products.types_of_aggregation.product_quantity')"/>
                    </x-slot>
                    <x-form.element.input
                        id="product_quantity"
                        name="product_catalog_types_of_aggregation[product_quantity]"
                        :value="old('product_catalog_types_of_aggregation.product_quantity')"/>
                </x-form.row>
                <footer class="mt-auto me-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <x-form.button.save formId="aggregation_type_add_form"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </div>
        <div class="col-md-12 col-auto">
            <x-form
                :route="route('product_catalog.update_product_quantity', ['product_catalog' => $productCatalog->id])"
                method="PATCH">
                <x-data-table.table
                    id="aggregation_types"
                    type="edit"
                    targets="-1">
                    <x-data-table.head>
                        <x-data-table.th
                            :text="__('classifiers.nomenclature.products.types_of_aggregation.code')"/>
                        <x-data-table.th
                            :text="__('classifiers.nomenclature.products.types_of_aggregation.name')"/>
                        <x-data-table.th
                            :text="__('classifiers.nomenclature.products.types_of_aggregation.product_quantity')"/>
                        <x-data-table.th/>
                    </x-data-table.head>
                    <x-data-table.body>
                        @foreach($productCatalog->aggregationTypes as $key => $aggregationType)
                            <x-data-table.tr>
                                <x-slot name="hiddenInputs">
                                    <x-form.element.input type="hidden"
                                                          name="aggregation_types[{{$key}}][aggregation_type]"
                                                          value="{{$aggregationType->code}}"/>
                                </x-slot>
                                <x-data-table.td>
                                    {{$aggregationType->code}}
                                </x-data-table.td>
                                <x-data-table.td class="text-start">
                                    {{$aggregationType->name}}
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-form.element.input
                                        name="aggregation_types[{{$key}}][product_quantity]"
                                        :value="$aggregationType->pivot->product_quantity"/>
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-data-table.button.detach
                                        id="type-{{$aggregationType->code}}"
                                        route="product_catalog.detach_aggregation_type"
                                        :params="['product_catalog' => $productCatalog->id]">
                                        <x-form.element.input
                                            type="hidden"
                                            name="aggregation_type[aggregation_type]"
                                            :value="$aggregationType->code"/>
                                    </x-data-table.button.detach>
                                </x-data-table.td>
                            </x-data-table.tr>
                        @endforeach
                    </x-data-table.body>
                </x-data-table.table>
                <footer class="mt-auto">
                    <ul class="list-inline mb-0">
                        @if(count($productCatalog->aggregationTypes) > 0)
                            <li class="list-inline-item">
                                <x-form.button.save formId="aggregation_types_main_form"/>
                            </li>
                        @endif
                    </ul>
                </footer>
            </x-form>
        </div>
    </div>
</x-form.nav-tab>
@end_digital_communication
