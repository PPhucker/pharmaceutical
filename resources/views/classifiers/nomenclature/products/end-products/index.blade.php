@extends('layouts.app')
@section('content')
    <x-card
        :title="__('classifiers.nomenclature.products.products')">
        <x-notification.alert/>
        <x-data-table.table
            id="end_products_table"
            class="table-bordered"
            targets="-1,-2"
            type="index"
            pageLength="25">
            <x-slot name="filter">
                <x-data-table.filter.trashed-filter tableId="end_products_table"/>
            </x-slot>
            <x-data-table.head>
                <x-data-table.th
                    text="ID"/>
                <x-data-table.th :text="__('classifiers.nomenclature.products.types_of_end_products.type')"/>
                <x-data-table.th
                    :text="__('classifiers.nomenclature.products.full_name')"/>
                <x-data-table.th/>
                <x-data-table.th/>
            </x-data-table.head>
            <x-data-table.body>
                @foreach($endProducts as $key => $endProduct)
                    <x-data-table.tr
                        :model="$endProduct">
                        <x-data-table.td>
                            {{$endProduct->id}}
                        </x-data-table.td>
                        <x-data-table.td
                            :title="$endProduct->type->name">
                            <span class="d-none">
                                {{$endProduct->type->name}}
                            </span>
                            <i class="bi bi-info-square-fill fs-5" style="color: {{$endProduct->type->color}};"
                               title="{{$endProduct->type->name}}">
                            </i>
                        </x-data-table.td>
                        <x-data-table.td
                            class="text-start">
                            {{$endProduct->full_name}}
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.edit
                                route="{{route('end_products.edit', ['end_product' => $endProduct->id])}}"
                                disabled="{{$endProduct->trashed()}}"/>
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.soft-delete
                                :trashed="$endProduct->trashed()"
                                :id="$endProduct->id"
                                route="end_products"
                                :params="['end_product' => $endProduct->id]"/>
                        </x-data-table.td>
                    </x-data-table.tr>
                @endforeach
            </x-data-table.body>
        </x-data-table.table>
    </x-card>
@endsection
