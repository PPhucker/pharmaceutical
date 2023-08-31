@roles(['marketing', 'bookkeeping'])
<x-forms.collapse.creation cardId="div_add_packing_list_product"
                           errorName="packing_list_product.*">
    <x-slot name="cardBody">
        <form id="form_add_packing_list_product"
              method="POST"
              action="{{route('packing_list_products.store')}}">
            @csrf
            <input type="hidden"
                   name="packing_list_product[packing_list_id]"
                   value="{{$packingList->id}}">
            <x-forms.row id="product_catalog_id"
                         label="{{__('documents.shipment.data.product_catalog_id')}}">
                <select id="invoice_for_payment_product_id"
                        name="packing_list_product[invoice_for_payment_product_id]"
                        class="form-control form-control-sm text-primary
                        @error('packing_list_product.invoice_for_payment_product_id') is-invalid @enderror"
                        required>
                    @foreach($invoicesForPaymentProduction as $production)
                        @foreach($production as $key => $product)
                            <option value="{{$product->id}}"
                                    style="background-color: {{$product->productCatalog->endProduct->type->color}}"
                                    @if($product->id === (int)(old('packing_list_product.invoice_for_payment_product_id')))
                                        selected
                                @endif>
                                {{$product->productCatalog->endProduct->short_name}}
                                - {{$product->productCatalog->organization->name}}
                                - {{$product->productCatalog->placeOfBusiness->address}}
                            </option>
                        @endforeach
                    @endforeach
                </select>
                <x-forms.span-error name="packing_list_product.invoice_for_payment_product_id"/>
            </x-forms.row>
            <x-forms.row id="quantity"
                         label="{{__('documents.shipment.data.quantity')}}">
                <input id="qauntity"
                       name="packing_list_product[quantity]"
                       class="form-control form-control-sm text-primary
                       @error('packing_list_product.quantity') is-invalid @enderror"
                       value="{{old('packing_list_product.quantity')}}"
                       required>
                <x-forms.span-error name="packing_list_product.quantity"/>
            </x-forms.row>
            <x-forms.row id="series"
                         label="{{__('documents.shipment.data.series')}}">
                <input id="series"
                       name="packing_list_product[series]"
                       class="form-control form-control-sm text-primary
                       @error('packing_list_product.series') is-invalid @enderror"
                       value="{{old('packing_list_product.series')}}"
                       required>
                <x-forms.span-error name="packing_list_product.series"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_packing_list_product"/>
    </x-slot>
</x-forms.collapse.creation>
<x-forms.collapse.card
    route="{{route('packing_list_products.update', ['packing_list_product' => $packingList->production->first()->id ?? 1])}}"
    cardId="card_packing_list_production"
    formId="form_packing_list_production"
    title="{{__('documents.shipment.data.production')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_packing_list_production"
                       targets="-1">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_packing_list_production"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center align-middle col-6">
                    {{__('documents.shipment.data.product_catalog_id')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.shipment.data.series')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.shipment.data.quantity')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.shipment.data.price')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.shipment.data.nds')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($packingList->production as $key => $packingListProduct)
                <tr @if($packingListProduct->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="packing_list_products[{{$key}}][id]"
                           value="{{$packingListProduct->id}}">
                    <input type="hidden"
                           name="packing_list_products[{{$key}}][product_id]"
                           value="{{$packingListProduct->productCatalog->id}}">
                    <td class="align-middle border-start col-6">
                        {{$packingListProduct->productCatalog->endProduct->full_name}} -
                        {{$packingListProduct->productCatalog->organization->name}},
                        {{$packingListProduct->productCatalog->placeOfBusiness->address}}
                    </td>
                    <td class="align-middle">
                        <span class="d-none">
                                {{$packingListProduct->series}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="packing_list_products[{{$key}}][series]"
                                   class="form-control form-control-sm text-primary
                                   @error('packing_list_products.' . $key. '.series') is-invalid @enderror"
                                   value="{{$packingListProduct->series}}"
                                   required>
                            <x-forms.span-error name="{{'packing_list_products.' . $key. '.series'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                        <span class="d-none">
                                {{$packingListProduct->quantity}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="packing_list_products[{{$key}}][quantity]"
                                   class="form-control form-control-sm text-primary
                                   @error('packing_list_products.' . $key. '.quantity') is-invalid @enderror"
                                   value="{{$packingListProduct->quantity}}"
                                   required>
                            <span class="input-group-text col-2">
                                    {{$packingListProduct->productCatalog->endProduct->okei->symbol}}
                                </span>
                            <x-forms.span-error name="{{'packing_list_products.' . $key. '.quantity'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                        <span class="d-none">
                                {{$packingListProduct->price}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="packing_list_products[{{$key}}][price]"
                                   class="form-control form-control-sm text-primary
                                   @error('packing_list_products.' . $key. '.price') is-invalid @enderror"
                                   value="{{$packingListProduct->price}}"
                                   required>
                            <span class="input-group-text">
                                    {{__('currency.rub')}}
                                </span>
                            <x-forms.span-error name="{{'packing_list_products.' . $key. '.price'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                        <span class="d-none">
                                {{$packingListProduct->nds * 100}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="packing_list_products[{{$key}}][nds]"
                                   class="form-control form-control-sm text-primary
                                   @error('packing_list_products.' . $key. '.nds') is-invalid @enderror"
                                   value="{{$packingListProduct->nds * 100}}"
                                   required>
                            <span class="input-group-text">%</span>
                            <x-forms.span-error name="{{'packing_list_products.' . $key. '.nds'}}"/>
                        </div>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($packingListProduct->trashed())
                            <x-buttons.restore
                                route="{{route('packing_list_products.restore', ['packing_list_product' => $packingListProduct->id])}}"
                                itemId="{{$packingListProduct->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('packing_list_products.destroy', ['packing_list_product' => $packingListProduct->id])}}"
                                formId="destroy"
                                itemId="{{$packingListProduct->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.collapse formId="div_add_packing_list_product"/>
        @if(count($packingList->production) > 0)
            <x-buttons.save formId="form_packing_list_production"/>
        @endif
    </x-slot>
</x-forms.collapse.card>
@end_roles
