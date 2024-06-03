@extends('layouts.app')
@section('content')
    <x-notification.alert/>
    <x-card
        :title="__('classifiers.nomenclature.materials.materials')">
        <x-data-table.table
            id="matrials_table"
            class="table-bordered"
            targets="-1,-2"
            type="index"
            pageLength="25">
            <x-slot name="filter">
                <x-data-table.filter.trashed-filter tableId="matrials_table"/>
            </x-slot>
            <x-data-table.head>
                <x-data-table.th
                    text="ID"/>
                <x-data-table.th
                    :text="__('classifiers.nomenclature.materials.type_id')"/>
                <x-data-table.th
                    :text="__('classifiers.nomenclature.materials.name')"/>
                <x-data-table.th/>
                <x-data-table.th/>
            </x-data-table.head>
            <x-data-table.body>
                @foreach($materials as $key => $material)
                    <x-data-table.tr
                        :model="$material">
                        <x-data-table.td>
                            {{$material->id}}
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$material->type->name}}
                        </x-data-table.td>
                        <x-data-table.td class="text-start">
                            {{$material->name}}
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.edit
                                route="{{route('materials.edit', ['material' => $material->id])}}"
                                disabled="{{$material->trashed()}}"/>
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.soft-delete
                                :trashed="$material->trashed()"
                                :id="$material->id"
                                route="materials"
                                :params="['material' => $material->id]"/>
                        </x-data-table.td>
                    </x-data-table.tr>
                @endforeach
            </x-data-table.body>
        </x-data-table.table>
    </x-card>
@endsection
