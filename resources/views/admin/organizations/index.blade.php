@extends('layouts.app')
@section('content')
    <x-notification.alert/>
    <x-card
        :title="__('contractors.organizations.organizations')">
        <x-data-table.table
            id="organizations_table"
            class="table-bordered"
            targets="-1,-2"
            type="index">
            <x-slot name="filter">
                <x-data-table.filter.trashed-filter tableId="organizations_table"/>
            </x-slot>
            <x-data-table.head>
                <x-data-table.th
                    :text="__('contractors.name')"/>
                <x-data-table.th
                    :text="__('contractors.inn')"/>
                <x-data-table.th
                    :text="__('contractors.kpp')"/>
                <x-data-table.th/>
                <x-data-table.th/>
            </x-data-table.head>
            <x-data-table.body>
                @foreach($organizations as $key => $organization)
                    <x-data-table.tr
                        :model="$organization">
                        <x-data-table.td
                            class="text-start">
                            {{$organization->full_name}}
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$organization->INN}}
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$organization->kpp}}
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.edit
                                route="{{route('organizations.edit', ['organization' => $organization->id])}}"
                                disabled="{{$organization->trashed()}}"/>
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.soft-delete
                                :trashed="$organization->trashed()"
                                :id="$organization->id"
                                route="organizations"
                                :params="['organization' => $organization->id]"/>
                        </x-data-table.td>
                    </x-data-table.tr>
                @endforeach
            </x-data-table.body>
        </x-data-table.table>
    </x-card>
@endsection
