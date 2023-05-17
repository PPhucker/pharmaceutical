@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.shipment.waybills.waybills')}}">
        <x-tables.main id="table_waybills"
                       targets="0,-1,-2,-3">
            <x-slot name="filter">
                <div class="list-inline-item">
                    <form></form>
                    <form action="{{route('waybills.index')}}"
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
                <x-tables.filters.trashed-filter tableId="table_waybills"/>
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
            @foreach($waybills as $key => $waybill)
                <tr @if($waybill->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$waybill->packingList->number}}
                    </td>
                    <td class="align-middle text-center">
                        {{$waybill->number}}
                    </td>
                    <td class="align-middle text-center">
                        {{$waybill->date}}
                    </td>
                    <td class="align-middle">
                        {{$waybill->packingList->organization->legalForm->abbreviation}} {{$waybill->packingList->organization->name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$waybill->packingList->contractor->legalForm->abbreviation}} {{$waybill->packingList->contractor->name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$waybill->packingList->contractorPlaceOfBusiness->address}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.href
                            route="{{route('waybills.show', ['waybill' => $waybill->id])}}"
                            title="{{__('form.button.show')}}"
                            icon="bi bi-zoom-in"
                            disabled="{{$waybill->trashed()}}"/>
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit
                            route="{{route('waybills.edit', ['waybill' => $waybill->id])}}"
                            disabled="{{$waybill->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($waybill->trashed())
                            <x-buttons.restore
                                route="{{route('waybills.restore', ['waybill' => $waybill->id])}}"
                                itemId="{{$waybill->id}}"
                                disabled="{{$waybill->packingList->trashed()}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('waybills.destroy', ['waybill' => $waybill->id])}}"
                                itemId="{{$waybill->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
