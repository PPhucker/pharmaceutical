@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.shipment.appendixes.appendixes')}}">
        <x-tables.main id="table_appendixes"
                       targets="0,-1,-2,-3">
            <x-slot name="filter">
                <div class="list-inline-item">
                    <form></form>
                    <form action="{{route('appendixes.index')}}"
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
                <x-tables.filters.trashed-filter tableId="table_appendixes"/>
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
                <x-tables.columns.thead.edit/>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($appendixes as $key => $appendix)
                <tr @if($appendix->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$appendix->packingList->number}}
                    </td>
                    <td class="align-middle text-center">
                        {{$appendix->number}}
                    </td>
                    <td class="align-middle text-center">
                        {{$appendix->date}}
                    </td>
                    <td class="align-middle">
                        {{$appendix->packingList->organization->legalForm->abbreviation}} {{$appendix->packingList->organization->name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$appendix->packingList->contractor->legalForm->abbreviation}} {{$appendix->packingList->contractor->name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$appendix->packingList->contractorPlaceOfBusiness->address}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit
                            route="{{route('appendixes.edit', ['appendix' => $appendix->id])}}"
                            disabled="{{$appendix->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($appendix->trashed())
                            <x-buttons.restore
                                route="{{route('appendixes.restore', ['appendix' => $appendix->id])}}"
                                itemId="{{$appendix->id}}"
                                disabled="{{$appendix->packingList->trashed()}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('appendixes.destroy', ['appendix' => $appendix->id])}}"
                                itemId="{{$appendix->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
