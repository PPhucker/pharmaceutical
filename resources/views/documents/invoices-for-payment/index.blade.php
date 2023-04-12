@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.invoices_for_payment.invoices_for_payment')}}">
        <x-forms.warning message="{{__('documents.invoices_for_payment.warning')}}"/>
        <x-tables.main id="table_invoices_for_payment"
                       targets="0,-1,-2,-3">
            <x-slot name="filter">
                <div class="list-inline-item">
                    <form action="{{route('invoices_for_payment.index')}}"
                          method="GET">
                        <x-tables.filters.date-filter fromDate="{{$fromDate}}"
                                                      toDate="{{$toDate}}"/>
                        <x-tables.filters.select-filter title="{{__('documents.invoices_for_payment.organization_id')}}"
                                                        name="organization_id">
                            @foreach($organizations as $organization)
                                <option value="{{$organization->id}}"
                                        @if((int)request('organization_id') === $organization->id) selected @endif>
                                    {{$organization->legalForm->abbreviation}} {{$organization->name}}
                                </option>
                            @endforeach
                        </x-tables.filters.select-filter>
                        <button type="submit"
                                class="btn btn-sm btn-primary">
                            {{__('datatable.filter')}}
                        </button>
                    </form>
                </div>
                <x-tables.filters.trashed-filter tableId="table_invoices_for_payment"/>

            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">

                </th>
                <th scope="col"
                    class="text-center">
                    {{__('documents.invoices_for_payment.number')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('documents.invoices_for_payment.date')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('documents.invoices_for_payment.organization_id')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('documents.invoices_for_payment.contractor_id')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('documents.invoices_for_payment.contractor_place_id')}}
                </th>
                <th scope="col"
                    class="text-center">
                    <span class="d-none">
                        {{__('form.button.show')}}
                    </span>
                </th>
                <x-tables.columns.thead.edit/>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($invoicesForPayment as $key => $invoice)
                <tr @if($invoice->trashed()) class="d-none trashed" @endif>
                    <td class="text-center align-middle">
                        <input type="checkbox"
                               name="invoice_for_payment_id[]"
                               class="form-check-input"
                               value="{{$invoice->id}}"
                               @if($invoice->trashed()) disabled @endif>
                        <span class="d-none">
                            {{$invoice->id}}
                        </span>
                    </td>
                    <td class="text-center align-middle">
                        {{$invoice->number}}
                    </td>
                    <td class="text-center align-middle">
                        {{$invoice->date}}
                    </td>
                    <td class="align-middle">
                        {{$invoice->organization->legalForm->abbreviation}} {{$invoice->organization->name}}
                    </td>
                    <td class="align-middle text-wrap">
                            {{$invoice->contractor->legalForm->abbreviation}} {{$invoice->contractor->name}}
                    </td>
                    <td class="align-middle text-wrap">
                            {{$invoice->contractorPlaceOfBusiness->address}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.href
                            route="{{route('invoices_for_payment.show', ['invoice_for_payment' => $invoice->id])}}"
                            title="{{__('form.button.show')}}"
                            icon="bi bi-zoom-in"
                            disabled="{{$invoice->trashed()}}"/>
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit
                            route="{{route('invoices_for_payment.edit', ['invoice_for_payment' => $invoice->id])}}"
                            disabled="{{$invoice->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($invoice->trashed())
                            <x-buttons.restore
                                route="{{route('invoices_for_payment.restore', ['invoice_for_payment' => $invoice->id])}}"
                                itemId="{{$invoice->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('invoices_for_payment.destroy', ['invoice_for_payment' => $invoice->id])}}"
                                itemId="{{$invoice->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection