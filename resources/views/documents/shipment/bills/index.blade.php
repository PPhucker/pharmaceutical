@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.shipment.bills.bills')}}">
        <x-tables.main id="table_bills"
                       targets="0,-1,-2,-3">
            <x-slot name="filter">
                <div class="list-inline-item">
                    <form></form>
                    <form action="{{route('bills.index')}}"
                          method="GET">
                        <x-tables.filters.date-filter fromDate="{{$filters['from_date']}}"
                                                      toDate="{{$filters['to_date']}}"/>
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
                <x-tables.filters.trashed-filter tableId="table_bills"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.shipment.packing_lists.packing_list')}}
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
            @foreach($bills as $key => $bill)
                <tr @if($bill->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$bill->packingList->number}}
                    </td>
                    <td class="align-middle text-center">
                        {{$bill->number}}
                    </td>
                    <td class="align-middle text-center">
                        {{$bill->date}}
                    </td>
                    <td class="align-middle">
                        {{$bill->packingList->organization->legalForm->abbreviation}} {{$bill->packingList->organization->name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$bill->packingList->contractor->legalForm->abbreviation}} {{$bill->packingList->contractor->name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$bill->packingList->contractorPlaceOfBusiness->address}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.href
                            route="{{route('bills.show', ['bill' => $bill->id])}}"
                            title="{{__('form.button.show')}}"
                            icon="bi bi-zoom-in"
                            disabled="{{$bill->trashed()}}"/>
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit
                            route="{{route('bills.edit', ['bill' => $bill->id])}}"
                            disabled="{{$bill->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($bill->trashed())
                            <x-buttons.restore
                                route="{{route('bills.restore', ['bill' => $bill->id])}}"
                                itemId="{{$bill->id}}"
                                disabled="{{$bill->packingList->trashed()}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('bills.destroy', ['bill' => $bill->id])}}"
                                itemId="{{$bill->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
