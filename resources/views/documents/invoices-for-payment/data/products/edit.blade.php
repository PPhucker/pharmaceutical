@roles(['marketing', 'bookkeeping'])
<x-forms.collapse.creation cardId="div_add_invoice_for_payment_product"
                           errorName="invoice_for_payment_products.*">
    <x-slot name="cardBody">
        <form id="form_add_invoice_for_payment_products"
              method="POST"
              action="{{route('invoices_for_payment_products.store')}}">
            @csrf
            <input type="hidden"
                   name="invoice_for_payment_id"
                   value="{{$invoiceForPayment->id}}">
            <input type="hidden"
                   name="organization_id"
                   value="{{$invoiceForPayment->organization->id}}">
            <input type="hidden"
                   name="invoice_for_payment_products[]">
            <x-tables.main id="add_table_product_catalog" targets="0">
                <thead class="bg-secondary">
                <tr class="text-primary small">
                    <th scope="col"
                        class="text-center">
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.products.full_name')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('documents.invoices_for_payment.data.quantity')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.products.product_catalog.place_of_business_id')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($production as $key => $product)
                    <tr class="small">
                        <td class="align-middle text-center">
                            <input type="checkbox"
                                   name="add_invoice_for_payment_products[{{$key}}][product_catalog_id]"
                                   value="{{$product->id}}"
                                   class="form-check-input
                                @error('invoice_for_payment_products.' . $key . '.product_catalog_id')
                                is-invalid
                                @enderror"
                                   @if(
                                   (int)old('add_invoice_for_payment_products.' . $key . '.product_catalog_id')
                                   ===
                                   (int)$product->id
                                   )
                                       checked
                                @endif>
                        </td>
                        <td class="align-middle">
                            {{$product->endProduct->full_name}}
                            @if(
                            $errors->has('invoice_for_payment_products.' . $key . '.price')
                            || $errors->has('invoice_for_payment_products.' . $key . '.nds')
                           )
                                <br><span class="text-danger fw-bolder">
                                ({{__('documents.invoices_for_payment.data.fails.price_list')}})
                            </span>
                            @endif
                        </td>
                        <td class="align-middle text-center">
                            <input name="add_invoice_for_payment_products[{{$key}}][quantity]"
                                   class="form-control form-control-sm text-primary p-1
                                    @error('invoice_for_payment_products.' . $key . '.quantity') is-invalid @enderror"
                                   value="{{old('add_invoice_for_payment_products.' . $key . '.quantity')}}">
                        </td>
                        <td class="align-middle">
                            {{$product->organization->name}} - {{$product->placeOfBusiness->address}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </x-tables.main>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_invoice_for_payment_products"/>
    </x-slot>
</x-forms.collapse.creation>
<x-forms.collapse.card
    route="{{route('invoices_for_payment_products.update', ['invoices_for_payment_product' => $invoiceForPayment->production->first()->id ?? 1])}}"
    cardId="card_invoice_for_payment_production"
    formId="form_invoice_for_payment_production"
    title="{{__('documents.invoices_for_payment.data.data')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_invoice_for_payment_production"
                       targets="-1">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_invoice_for_payment_production"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary small">
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.invoices_for_payment.data.product_catalog_id')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.invoices_for_payment.data.quantity')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.invoices_for_payment.data.price')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.invoices_for_payment.data.nds')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary small">
            @foreach($invoiceForPayment->production as $key => $invoiceProduct)
                <tr @if($invoiceProduct->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="invoice_for_payment_products[{{$key}}][id]"
                           value="{{$invoiceProduct->id}}">
                    <input type="hidden"
                           name="invoice_for_payment_products[{{$key}}][product_catalog_id]"
                           value="{{$invoiceProduct->productCatalog->id}}">
                    <td class="align-middle border-start text-wrap">
                        {{$invoiceProduct->productCatalog->endProduct->full_name}} -
                        <small>
                            {{$invoiceProduct->productCatalog->organization->name}},
                            {{$invoiceProduct->productCatalog->placeOfBusiness->address}}
                        </small>
                    </td>
                    <td class="align-middle">
                            <span class="d-none">
                                {{$invoiceProduct->quantity}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="invoice_for_payment_products[{{$key}}][quantity]"
                                   class="form-control form-control-sm text-primary
                                   @error('invoice_for_payment_products.' . $key. '.quantity') is-invalid @enderror"
                                   value="{{$invoiceProduct->quantity}}"
                                   required>
                            <span class="input-group-text">
                                    {{$invoiceProduct->productCatalog->endProduct->okei->symbol}}
                                </span>
                            <x-forms.span-error name="{{'invoice_for_payment_products.' . $key. '.quantity'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                            <span class="d-none">
                                {{$invoiceProduct->price}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="invoice_for_payment_products[{{$key}}][price]"
                                   class="form-control form-control-sm text-primary
                                   @error('invoice_for_payment_products.' . $key. '.price') is-invalid @enderror"
                                   value="{{$invoiceProduct->price}}"
                                   required>
                            <span class="input-group-text">
                                    {{__('currency.rub')}}
                                </span>
                            <x-forms.span-error name="{{'invoice_for_payment_products.' . $key. '.price'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                            <span class="d-none">
                                {{$invoiceProduct->nds * 100}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="invoice_for_payment_products[{{$key}}][nds]"
                                   class="form-control form-control-sm text-primary
                                   @error('invoice_for_payment_products.' . $key. '.nds') is-invalid @enderror"
                                   value="{{$invoiceProduct->nds * 100}}"
                                   required>
                            <span class="input-group-text">%</span>
                            <x-forms.span-error name="{{'invoice_for_payment_products.' . $key. '.nds'}}"/>
                        </div>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($invoiceProduct->trashed())
                            <x-buttons.restore
                                route="{{route('invoices_for_payment_products.restore', ['invoices_for_payment_product' => $invoiceProduct->id])}}"
                                itemId="{{$invoiceProduct->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('invoices_for_payment_products.destroy', ['invoices_for_payment_product' => $invoiceProduct->id])}}"
                                formId="destroy"
                                itemId="{{$invoiceProduct->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.collapse formId="div_add_invoice_for_payment_product"/>
        @if(count($invoiceForPayment->production) > 0)
            <x-buttons.save formId="form_invoice_for_payment_production"/>
        @endif
    </x-slot>
</x-forms.collapse.card>
@end_roles
