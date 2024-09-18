<div class="row">
    <div class="col-md-12">
        <div class="collapse card border-0"
             id="wholesale_prices_add_card">
            <div class="card-header bg-primary text-white">
                {{__('form.titles.add')}}
            </div>
            <div class="card-body p-1 border-0">
                <x-form
                    :route="route('wholesale_prices.store')"
                    formId="wholesale_prices_add_form"
                    class="mt-2">
                    <x-form.element.input
                        type="hidden"
                        name="wholesale_price[product_catalog_id]"
                        :value="$productCatalog->id"/>
                    <x-form.element.input
                        type="hidden"
                        name="wholesale_price[organization_id]"
                        :value="$productCatalog->organization->id"/>
                    <x-form.row>
                        <x-slot name="label">
                            <x-form.label
                                forId="wholesale_price"
                                :text="__('classifiers.nomenclature.products.prices.price')"/>
                        </x-slot>
                        <x-form.element.input
                            id="wholesale_price"
                            name="wholesale_price[wholesale_price]"
                            :value="old('wholesale_price[wholesale_price]')"
                            :required="true"/>
                    </x-form.row>
                    <x-form.row>
                        <x-slot name="label">
                            <x-form.label
                                forId="wholesale_quantity"
                                :text="__('classifiers.nomenclature.products.prices.quantity')"/>
                        </x-slot>
                        <x-form.element.input
                            id="wholesale_quantity"
                            name="wholesale_price[wholesale_quantity]"
                            :value="old('wholesale_price[wholesale_quantity]')"
                            :required="true"/>
                    </x-form.row>
                    <footer class="mt-auto me-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <x-form.button.save formId="wholesale_prices_add_form"/>
                            </li>
                        </ul>
                    </footer>
                </x-form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <x-form
            :route="route('wholesale_prices.update',
                    ['wholesale_price' => $productCatalog->wholesalePrices->first()->id ?? null])"
            formId="wholesale_prices_main_form"
            method="PATCH">
            <x-data-table.table
                id="wholesale_prices_main_table"
                type="edit"
                targets="-1">
                <x-data-table.head>
                    <x-data-table.th
                        :text="__('classifiers.nomenclature.products.prices.price')"/>
                    <x-data-table.th
                        :text="__('classifiers.nomenclature.products.prices.quantity')"/>
                    <x-data-table.th/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($productCatalog->wholesalePrices as $key => $wholesalePrice)
                        <x-data-table.tr
                            :model="$wholesalePrice">
                            <x-slot name="hiddenInputs">
                                <x-form.element.input type="hidden"
                                                      name="wholesale_prices[{{$key}}][id]"
                                                      value="{{$wholesalePrice->id}}"/>
                                <x-form.element.input
                                    type="hidden"
                                    name="wholesale_prices[product_catalog_id]"
                                    :value="$productCatalog->id"/>
                                <x-form.element.input
                                    type="hidden"
                                    name="wholesale_prices[organization_id]"
                                    :value="$productCatalog->organization->id"/>
                            </x-slot>
                            <x-data-table.td
                                class="col">
                                <x-form.element.input
                                    name="wholesale_prices[{{$key}}][wholesale_price]"
                                    :value="$wholesalePrice->wholesale_price"
                                    :required="true"
                                    min="1"/>
                            </x-data-table.td>
                            <x-data-table.td
                                class="col">
                                <x-form.element.input
                                    name="wholesale_prices[{{$key}}][wholesale_quantity]"
                                    :value="$wholesalePrice->wholesale_quantity"
                                    :required="true"
                                    min="1"/>
                            </x-data-table.td>
                            <x-data-table.td
                                class="col-1 text-center">
                                <x-data-table.button.soft-delete
                                    :trashed="$wholesalePrice->trashed()"
                                    id="wholesale-price-{{$wholesalePrice->id}}"
                                    route="wholesale_prices"
                                    :params="['wholesale_price' => $wholesalePrice->id]"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto">
                <ul class="list-inline mb-0">
                    @if(count($productCatalog->wholesalePrices) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="wholesale_prices_main_form"/>
                        </li>
                    @endif
                    <li class="list-inline-item">
                        <x-form.button.collapse
                            divId="wholesale_prices_add_card"
                            :title="__('form.titles.add')"/>
                    </li>
                    <li class="list-inline-item">
                        <x-data-table.filter.trashed-filter id="wholesale_prices_main_table"/>
                    </li>
                </ul>
            </footer>
        </x-form>
    </div>
</div>
