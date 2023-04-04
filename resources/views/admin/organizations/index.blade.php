@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('contractors.organizations.organizations')}}">
        <x-tables.main id="table_organizations"
                       targets="-1,-2">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_organizations"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('ID')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.name')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.inn')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.okpo')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.contacts')}}
                </th>
                <x-tables.columns.thead.edit/>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($organizations as $key => $organization)
                <tr @if($organization->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$organization->id}}
                    </td>
                    <td class="align-middle">
                        {{$organization->legalForm->abbreviation}} {{$organization->name}}
                    </td>
                    <td class="align-middle text-center">
                        {{$organization->INN}}
                    </td>
                    <td class="align-middle text-center">
                        {{$organization->OKPO}}
                    </td>
                    <td class="align-middle">
                        {{$organization->contacts}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit route="{{route('organizations.edit', ['organization' => $organization->id])}}"
                                        disabled="{{$organization->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($organization->trashed())
                            <x-buttons.restore
                                route="{{route('organizations.restore', ['organization' => $organization->id])}}"
                                itemId="{{$organization->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('organizations.destroy', ['organization' => $organization->id])}}"
                                formId="destroy"
                                itemId="{{$organization->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
