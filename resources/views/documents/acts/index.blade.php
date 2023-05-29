@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.acts.acts')}}">
        <x-tables.main id="table_acts"
                       targets="0,-1,-2,-3">
            <x-slot name="filter">
                <div class="list-inline-item">
                    <form></form>
                    <form action="{{route('acts.index')}}"
                          method="GET">
                        <x-tables.filters.date-filter fromDate="{{$fromDate}}"
                                                      toDate="{{$toDate}}"/>
                        <x-tables.filters.select-filter
                            title="{{__('documents.acts.organization_id')}}"
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
                <x-tables.filters.trashed-filter tableId="table_acts"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('documents.acts.number')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('documents.acts.date')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('documents.acts.organization_id')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('documents.acts.contractor_id')}}
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
            @foreach($acts as $key => $act)
                <tr @if($act->trashed()) class="d-none trashed" @endif>
                    <td class="text-center align-middle">
                        {{$act->number}}
                    </td>
                    <td class="text-center align-middle">
                        {{$act->date}}
                    </td>
                    <td class="align-middle">
                        {{$act->organization->legalForm->abbreviation}} {{$act->organization->name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$act->contractor->legalForm->abbreviation}} {{$act->contractor->name}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.href
                            route="{{route('acts.show', ['act' => $act->id])}}"
                            title="{{__('form.button.show')}}"
                            icon="bi bi-zoom-in"
                            disabled="{{$act->trashed()}}"/>
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit
                            route="{{route('acts.edit', ['act' => $act->id])}}"
                            disabled="{{$act->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($act->trashed())
                            <x-buttons.restore
                                route="{{route('acts.restore', ['act' => $act->id])}}"
                                itemId="{{$act->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('acts.destroy', ['act' => $act->id])}}"
                                itemId="{{$act->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
