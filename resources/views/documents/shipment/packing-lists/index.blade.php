@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.shipment.packing_lists.packing_lists')}}">
        <x-forms.warning message="{{__('documents.shipment.packing_lists.warning')}}"/>
        <form id="form_create_shipment_document"
              method="POST"
              action="{{route('packing_lists.redirect')}}">
            @csrf
            <div class="input-group input-group-sm mb-1">
                <span class="input-group-text">
                    {{__('documents.shipment.packing_lists.buttons.create_based_on')}}
                </span>
                <select name="document"
                        class="form-control form-control-sm text-primary">
                    <option value="bills">
                        {{__('documents.shipment.bills.bill')}}
                    </option>
                    <option value="appendixes">
                        {{__('documents.shipment.appendixes.appendix')}}
                    </option>
                    <option value="protocols">
                        {{__('documents.shipment.protocols.protocol')}}
                    </option>
                    <option value="waybills">
                        {{__('documents.shipment.waybills.waybill')}}
                    </option>
                </select>
                <button type="submit"
                        class="btn btn-sm btn-primary">
                    {{__('form.button.create')}}
                </button>
            </div>
            <x-tables.main id="table_packing_lists"
                           targets="0,-1,-2,-3">
                <x-slot name="filter">
                    <div class="list-inline-item">
                        <form></form>
                        <form action="{{route('packing_lists.index')}}"
                              method="GET">
                            <x-tables.filters.date-filter fromDate="{{$fromDate}}"
                                                          toDate="{{$toDate}}"/>
                            <x-tables.filters.select-filter
                                title="{{__('documents.shipment.organization_id')}}"
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
                    <x-tables.filters.trashed-filter tableId="table_packing_lists"/>
                </x-slot>
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center">
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('documents.shipment.number')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('documents.shipment.date')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('documents.shipment.organization_id')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('documents.shipment.contractor_id')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('documents.shipment.contractor_place_id')}}
                    </th>
                    <x-tables.columns.thead.edit/>
                    <x-tables.columns.thead.delete/>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($packingLists as $key => $packingList)
                    <tr @if($packingList->trashed()) class="d-none trashed" @endif>
                        <td class="text-center align-middle">
                            <input type="radio"
                                   name="packing_list_id"
                                   class="form-check-input"
                                   value="{{$packingList->id}}"
                                   @if($packingList->trashed()) disabled @endif
                                   @if((int)$choice === $packingList->id) checked @endif>
                            <span class="d-none">
                            {{$packingList->id}}
                        </span>
                        </td>
                        <td class="text-center align-middle">
                            {{$packingList->number}}
                        </td>
                        <td class="text-center align-middle">
                            {{$packingList->date}}
                        </td>
                        <td class="align-middle">
                            {{$packingList->organization->legalForm->abbreviation}} {{$packingList->organization->name}}
                        </td>
                        <td class="align-middle text-wrap">
                            {{$packingList->contractor->legalForm->abbreviation}} {{$packingList->contractor->name}}
                        </td>
                        <td class="align-middle text-wrap">
                            {{$packingList->contractorPlaceOfBusiness->address}}
                        </td>
                        <td class="text-center align-middle">
                            <x-buttons.edit
                                route="{{route('packing_lists.edit', ['packing_list' => $packingList->id])}}"
                                disabled="{{$packingList->trashed()}}"/>
                        </td>
                        <x-tables.columns.tbody.delete>
                            @if($packingList->trashed())
                                <x-buttons.restore
                                    route="{{route('packing_lists.restore', ['packing_list' => $packingList->id])}}"
                                    itemId="{{$packingList->id}}"/>
                            @else
                                <x-buttons.delete
                                    route="{{route('packing_lists.destroy', ['packing_list' => $packingList->id])}}"
                                    itemId="{{$packingList->id}}"/>
                            @endif
                        </x-tables.columns.tbody.delete>
                    </tr>
                @endforeach
                </tbody>
            </x-tables.main>
        </form>
    </x-forms.main>
@endsection
