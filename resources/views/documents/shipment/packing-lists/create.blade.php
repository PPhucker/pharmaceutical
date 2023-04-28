@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.shipment.packing_lists.titles.create')}}"
                  back="{{route('packing_lists.index')}}">
        <form id="form_add_packing_list"
              method="POST"
              action="{{route('packing_lists.store')}}">
            @csrf
            <div class="row mb-2">
                <label for="number"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.number')}}
                </label>
                <div class="col-md-6">
                    <input id="number"
                           type="text"
                           name="number"
                           class="form-control form-control-sm text-primary
                           @error('number') is-invalid @enderror"
                           value="{{old('number')}}"
                           required>
                    <x-forms.span-error name="number"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="date"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.date')}}
                </label>
                <div class="col-md-6">
                    <input id="date"
                           type="date"
                           name="date"
                           class="form-control form-control-sm text-primary
                           @error('date') is-invalid @enderror"
                           value="{{old('date')}}"
                           required>
                    <x-forms.span-error name="date"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="organization_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.organization_id')}}
                </label>
                <div class="col-md-6">
                    <input type="hidden"
                           id="organization_id"
                           name="organization_id"
                           value="{{$organization->id}}">
                    <span class="form-control form-control-sm border-0 bg-transparent text-primary">
                        {{$organization->legalForm->abbreviation}} {{$organization->name}}
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="organization_place_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.organization_place_id')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('organization_place_id') is-invalid @enderror"
                            id="organization_place_id"
                            name="organization_place_id">
                        <option selected disabled></option>
                        @foreach($organization->placesOfbusiness as $placeOfBusiness)
                            <option value="{{$placeOfBusiness->id}}"
                                    @if($placeOfBusiness->id === (int)Request::old('organization_place_id')) selected @endif>
                                {{$placeOfBusiness->address}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="organization_place_id"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="organization_bank_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.organization_bank_id')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('organization_bank_id') is-invalid @enderror"
                            id="organization_bank_id"
                            name="organization_bank_id">
                        @foreach($organization->bankAccountDetails as $bankAccount)
                            <option value="{{$bankAccount->id}}"
                                    @if($bankAccount->id === (int)Request::old('organization_bank_id')) selected @endif>
                                {{$bankAccount->bankClassifier->name}} - {{$bankAccount->payment_account}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="organization_bank_id"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="contractor_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.contractor_id')}}
                </label>
                <div class="col-md-6">
                    <input type="hidden"
                           id="contractor_id"
                           name="contractor_id"
                           value="{{$contractor->id}}">
                    <span class="form-control form-control-sm text-primary border-0 bg-transparent">
                        {{$contractor->legalForm->abbreviation}} {{$contractor->name}}
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <label for="contractor_place_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.contractor_place_id')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('contractor_place_id') is-invalid @enderror"
                            id="contractor_place_id"
                            name="contractor_place_id">
                        @foreach($contractor->placesOfBusiness as $place)
                            <option value="{{$place->id}}"
                                    @if($place->id === (int)Request::old('contractor_place_id')) selected @endif>
                                {{$place->address}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="contractor_place_id"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="contractor_bank_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.contractor_bank_id')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('contractor_bank_id') is-invalid @enderror"
                            id="contractor_bank_id"
                            name="contractor_bank_id">
                        @foreach($contractor->bankAccountDetails as $bankAccount)
                            <option value="{{$bankAccount->id}}"
                                    @if($bankAccount->id === (int)Request::old('contractor_bank_id')) selected @endif>
                                {{$bankAccount->bankClassifier->name}} - {{$bankAccount->payment_account}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="contractor_bank_id"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="director"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.director')}}
                </label>
                <div class="col-md-6">
                    <input id="director"
                           type="text"
                           name="director"
                           class="form-control form-control-sm text-primary
                           @error('director') is-invalid @enderror"
                           value="{{old('director')}}">
                    <x-forms.span-error name="director"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for=""
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.bookkeeper')}}
                </label>
                <div class="col-md-6">
                    <input id="bookkeeper"
                           type="text"
                           name="bookkeeper"
                           class="form-control form-control-sm text-primary
                           @error('bookkeeper') is-invalid @enderror"
                           value="{{old('bookkeeper')}}">
                    <x-forms.span-error name="bookkeeper"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for=""
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.shipment.storekeeper')}}
                </label>
                <div class="col-md-6">
                    <input id="storekeeper"
                           type="text"
                           name="storekeeper"
                           class="form-control form-control-sm text-primary
                           @error('storekeeper') is-invalid @enderror"
                           value="{{old('storekeeper')}}">
                    <x-forms.span-error name="storekeeper"/>
                </div>
            </div>
            <x-tables.main id="table_invoice_for_payment_production"
                           targets="0"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th colspan="7"
                        class="text-center">
                        {{__('documents.shipment.data.titles.choose_products')}}
                    </th>
                </tr>
                <tr class="text-primary">
                    <th></th>
                    <th scope="col"
                        class="text-center align-middle">
                        {{__('documents.shipment.invoice_for_payment_id')}}
                    </th>
                    <th scope="col"
                        class="text-center align-middle">
                        {{__('classifiers.nomenclature.products.full_name')}}
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
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($production as $invoiceForPayment)
                    @foreach($invoiceForPayment as $key => $product)
                        <tr>
                            <td class="text-center align-middle">
                                <input type="checkbox"
                                       name="invoice_for_payment_product[{{$key}}][id]"
                                       value="{{$product->id}}"
                                       class="form-check-input"
                                @if($product->id === (int)Request::old('invoice_for_payment_product.' .$key . '.id')) checked @endif>
                                <input type="hidden"
                                       name="invoice_for_payment_product[{{$key}}][product_catalog_id]"
                                       value="{{$product->productCatalog->id}}">
                            </td>
                            <td class="align-middle">
                                <input type="hidden"
                                       name="invoice_for_payment_product[{{$key}}][invoice_for_payment_id]"
                                       value="{{$product->invoiceForPayment->id}}">
                                №
                                {{$product->invoiceForPayment->number}}
                                {{__('documents.invoices_for_payment.date')}}:
                                {{$product->invoiceForPayment->date}}
                            </td>
                            <td class="align-middle">
                                {{$product->productCatalog->endProduct->full_name}}
                            </td>
                            <td class="align-middle">
                                <div class="dropdown">
                                    <input type="text"
                                           name="invoice_for_payment_product[{{$key}}][series]"
                                           class="form-control form-control-sm text-primary
                                            @error('invoice_for_payment_product.' . $key. '.series') is-invalid @enderror"
                                           value="{{old('invoice_for_payment_product.' .$key . '.series')}}"
                                           placeholder="0000000"
                                           id="dropdown_input_{{$product->id}}"
                                           data-bs-toggle="dropdown"
                                           aria-expanded="false"
                                           required>
                                    <x-forms.span-error name="{{'invoice_for_payment_product.' . $key. '.series'}}"/>
                                    <ul class="dropdown-menu"
                                        aria-labelledby="dropdown_input_{{$product->id}}">
                                        @if(count($series) > 0)
                                            @foreach($series as $seriesNumber)
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="#">
                                                        {{$seriesNumber}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                                    <input type="text"
                                           name="invoice_for_payment_product[{{$key}}][quantity]"
                                           class="form-control form-control-sm text-primary
                                            @error('invoice_for_payment_product.' . $key. '.quantity') is-invalid @enderror"
                                           value="{{$product->quantity}}"
                                           required>
                                    <span class="input-group-text col-md-3">
                                        {{$product->productCatalog->endProduct->okei->symbol}}
                                    </span>
                                    <x-forms.span-error name="{{'invoice_for_payment_product.' . $key. '.quantity'}}"/>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                                    <input type="text"
                                           name="invoice_for_payment_product[{{$key}}][price]"
                                           class="form-control form-control-sm text-primary
                                   @error('invoice_for_payment_product.' . $key. '.price') is-invalid @enderror"
                                           value="{{$product->price}}"
                                           required>
                                    <span class="input-group-text col-md-3">
                                        {{__('currency.rub')}}
                                    </span>
                                    <x-forms.span-error name="{{'invoice_for_payment_product.' . $key. '.price'}}"/>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                                    <input type="text"
                                           name="invoice_for_payment_product[{{$key}}][nds]"
                                           class="form-control form-control-sm text-primary
                                            @error('invoice_for_payment_product.' . $key. '.nds') is-invalid @enderror"
                                           value="{{$product->nds * 100}}"
                                           required>
                                    <span class="input-group-text col-md-3">%</span>
                                    <x-forms.span-error name="{{'invoice_for_payment_product.' . $key. '.nds'}}"/>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </x-tables.main>
        </form>
        <x-slot name="footer">
            <x-buttons.save formId="form_add_packing_list"/>
        </x-slot>
    </x-forms.main>
    <script>
        document.getElementById('organization_place_id').addEventListener('change', async function(e) {
            const url = '/admin/organizations/places_of_business/staff/' + e.target.value;
            const response = await fetch(url);

            if (response.ok) {
                const data = (await response.json())[0];
                document.getElementById('director').value = data.director;
                document.getElementById('bookkeeper').value = data.bookkeeper;
                document.getElementById('storekeeper').value = data.storekeeper;
            } else {
                alert('Ошибка HTTP: ' + response.status);
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('table_invoice_for_payment_production_wrapper');
            for (const list of table.getElementsByClassName('list-inline')) {
                list.classList.add('d-none');
            }
            for (const dropdown of document.getElementsByClassName('dropdown')) {
                for (const input of dropdown.getElementsByTagName('input')) {
                    let i = 1;
                    $('#' + input.id).on('keyup', function() {
                        const value = $(this).val().toLowerCase();
                        $('.dropdown ul li a').filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                        });
                    });
                    for (let a of document.getElementsByTagName('a')) {
                        a.onclick = function() {
                            input.value = this.innerText;
                        };
                        break;
                    }
                    i++;
                }
            }
        });
    </script>
@endsection
