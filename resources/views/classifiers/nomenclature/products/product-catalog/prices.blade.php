@roles(['marketing', 'bookkeeping'])
<x-form.nav-tab
    formId="prices_main_form">
    <div class="row">
        <div class="col-md col-auto mb-2">
            <div class="card">
                <div class="card-header bg-secondary text-primary fw-bold border-0">
                    {{__('classifiers.nomenclature.products.prices.retail')}}
                </div>
                <div class="card-body">
                    @php
                        $route = $productCatalog->retailPrice
                            ? route('product_prices.update', ['product_price' => $productCatalog->retailPrice->id])
                            : route('product_prices.store');
                        $method = $productCatalog->retailPrice
                            ? 'PATCH'
                            : 'POST';
                    @endphp
                    <x-form
                        :route="$route"
                        formId="retail_price_main_form"
                        :method="$method">
                        <x-form.element.input
                            type="hidden"
                            name="product_price[product_catalog_id]"
                            :value="$productCatalog->id"/>
                        <x-form.element.input
                            type="hidden"
                            name="product_price[organization_id]"
                            :value="$productCatalog->organization->id"/>
                        @if($productCatalog->retailPrice)
                            <x-form.element.input
                                type="hidden"
                                name="product_price[id]"
                                :value="$productCatalog->retailPrice->id"/>
                        @endif
                        <x-form.row>
                            <x-slot name="label">
                                <x-form.label
                                    forId="price"
                                    :text="__('classifiers.nomenclature.products.prices.price')"/>
                            </x-slot>
                            <x-form.element.input
                                id="price"
                                name="product_price[price]"
                                :value="$productCatalog->retailPrice->price ?? 0"/>
                        </x-form.row>
                        <x-form.row>
                            <x-slot name="label">
                                <x-form.label
                                    forId="nds"
                                    :text="__('classifiers.nomenclature.products.prices.nds')"/>
                            </x-slot>
                            <x-form.element.input
                                id="nds"
                                name="product_price[nds]"
                                :value="isset($productCatalog->retailPrice->nds)
                                    ? $productCatalog->retailPrice->nds * 100 : 0"/>
                        </x-form.row>
                        <footer class="mt-auto me-auto">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <x-form.button.save formId="product_price_main_form"/>
                                </li>
                            </ul>
                        </footer>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md col-auto mb-2">
            <div class="card">
                <div class="card-header bg-secondary text-primary fw-bold border-0">
                    {{__('classifiers.nomenclature.products.prices.wholesale')}}
                </div>
                <div class="card-body">
                    @include('classifiers.nomenclature.products.product-catalog.wholesale-prices')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md col-auto mb-2">
            <div class="card">
                <div class="card-header bg-secondary text-primary fw-bold border-0">
                    {{__('classifiers.nomenclature.products.prices.specific')}}
                </div>
                <div class="card-body">2</div>
            </div>
        </div>
    </div>
</x-form.nav-tab>
@end_roles
