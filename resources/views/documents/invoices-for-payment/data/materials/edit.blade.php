@roles(['marketing', 'bookkeeping'])
<x-forms.collapse.creation cardId="div_add_invoice_for_payment_material"
                           errorName="invoice_for_payment_material.*">
    <x-slot name="cardBody">
        <form id="form_add_invoice_for_payment_material"
              method="POST"
              action="{{route('invoices_for_payment_materials.store')}}">
            @csrf
            <input type="hidden"
                   name="invoice_for_payment_material[invoice_for_payment_id]"
                   value="{{$invoiceForPayment->id}}">
            <x-forms.row id="material_id"
                         label="{{__('documents.invoices_for_payment.data.product_catalog_id')}}">
                <select id="material_id"
                        name="invoice_for_payment_material[material_id]"
                        class="form-control form-control-sm text-primary
                        @error('invoice_for_payment_material.materialg_id') is-invalid @enderror"
                        required>
                    @foreach($production as $product)
                        <option value="{{$product->id}}"
                                @if($product->id === (int)(old('invoice_for_payment_product.material_id')))
                                    selected
                            @endif>
                            {{$product->name}}
                        </option>
                    @endforeach
                </select>
                <x-forms.span-error name="invoice_for_payment_material.material_id"/>
            </x-forms.row>
            <x-forms.row id="quantity"
                         label="{{__('documents.invoices_for_payment.data.quantity')}}">
                <input id="qauntity"
                       name="invoice_for_payment_material[quantity]"
                       class="form-control form-control-sm text-primary
                       @error('invoice_for_payment_material.quantity') is-invalid @enderror"
                       value="{{old('invoice_for_payment_material.quantity')}}"
                       required>
                <x-forms.span-error name="invoice_for_payment_material.quantity"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_invoice_for_payment_material"/>
    </x-slot>
</x-forms.collapse.creation>
<x-forms.collapse.card
    route="{{route('invoices_for_payment_materials.update', ['invoices_for_payment_material' => $invoiceForPayment->production->first()->id ?? 1])}}"
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
            <tr class="text-primary">
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
            <tbody class="text-primary">
            @foreach($invoiceForPayment->production as $key => $invoiceProduct)
                <tr @if($invoiceProduct->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="invoice_for_payment_materials[{{$key}}][id]"
                           value="{{$invoiceProduct->id}}">
                    <input type="hidden"
                           name="invoice_for_payment_materials[{{$key}}][material_id]"
                           value="{{$invoiceProduct->material->id}}">
                    <td class="align-middle border-start">
                        {{$invoiceProduct->material->name}}
                    </td>
                    <td class="align-middle">
                            <span class="d-none">
                                {{$invoiceProduct->quantity}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="invoice_for_payment_materials[{{$key}}][quantity]"
                                   class="form-control form-control-sm text-primary
                                   @error('invoice_for_payment_materials.' . $key. '.quantity') is-invalid @enderror"
                                   value="{{$invoiceProduct->quantity}}"
                                   required>
                            <span class="input-group-text col-2">
                                    {{$invoiceProduct->material->okei->symbol}}
                                </span>
                            <x-forms.span-error name="{{'invoice_for_payment_materials.' . $key. '.quantity'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                            <span class="d-none">
                                {{$invoiceProduct->price}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="invoice_for_payment_materials[{{$key}}][price]"
                                   class="form-control form-control-sm text-primary
                                   @error('invoice_for_payment_materials.' . $key. '.price') is-invalid @enderror"
                                   value="{{$invoiceProduct->price}}"
                                   required>
                            <span class="input-group-text">
                                    {{__('currency.rub')}}
                                </span>
                            <x-forms.span-error name="{{'invoice_for_payment_materials.' . $key. '.price'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                            <span class="d-none">
                                {{$invoiceProduct->nds * 100}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="invoice_for_payment_materials[{{$key}}][nds]"
                                   class="form-control form-control-sm text-primary
                                   @error('invoice_for_payment_materials.' . $key. '.nds') is-invalid @enderror"
                                   value="{{$invoiceProduct->nds * 100}}"
                                   required>
                            <span class="input-group-text">%</span>
                            <x-forms.span-error name="{{'invoice_for_payment_materials.' . $key. '.nds'}}"/>
                        </div>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($invoiceProduct->trashed())
                            <x-buttons.restore
                                route="{{route('invoices_for_payment_materials.restore', ['invoices_for_payment_material' => $invoiceProduct->id])}}"
                                itemId="{{$invoiceProduct->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('invoices_for_payment_materials.destroy', ['invoices_for_payment_material' => $invoiceProduct->id])}}"
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
        <x-buttons.collapse formId="div_add_invoice_for_payment_material"/>
        @if(count($invoiceForPayment->production) > 0)
            <x-buttons.save formId="form_invoice_for_payment_production"/>
        @endif
    </x-slot>
</x-forms.collapse.card>
@end_roles
