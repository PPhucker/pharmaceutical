@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.shipment.protocols.protocols')}}">
        <x-tables.main id="table_protocols"
                       targets="0,-1,-2,-3">
            <x-slot name="filter">
                <div class="list-inline-item">
                    <form></form>
                    <form action="{{route('protocols.index')}}"
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
                <x-tables.filters.trashed-filter tableId="table_protocols"/>
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
            @foreach($protocols as $key => $protocol)
                <tr @if($protocol->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$protocol->packingList->number}}
                    </td>
                    <td class="align-middle text-center">
                        {{$protocol->number}}
                    </td>
                    <td class="align-middle text-center">
                        {{$protocol->date}}
                    </td>
                    <td class="align-middle">
                        {{$protocol->packingList->organization->legalForm->abbreviation}} {{$protocol->packingList->organization->name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$protocol->packingList->contractor->legalForm->abbreviation}} {{$protocol->packingList->contractor->name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$protocol->packingList->contractorPlaceOfBusiness->address}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.href
                            route="{{route('protocols.show', ['protocol' => $protocol->id])}}"
                            title="{{__('form.button.show')}}"
                            icon="bi bi-zoom-in"
                            disabled="{{$protocol->trashed()}}"/>
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit
                            route="{{route('protocols.edit', ['protocol' => $protocol->id])}}"
                            disabled="{{$protocol->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($protocol->trashed())
                            <x-buttons.restore
                                route="{{route('protocols.restore', ['protocol' => $protocol->id])}}"
                                itemId="{{$protocol->id}}"
                                disabled="{{$protocol->packingList->trashed()}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('protocols.destroy', ['protocol' => $protocol->id])}}"
                                itemId="{{$protocol->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
