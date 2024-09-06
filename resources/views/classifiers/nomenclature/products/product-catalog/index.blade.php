@extends('layouts.app')
@section('content')
    <x-card
        :title="__('classifiers.nomenclature.products.product_catalog.product_catalog')">
        <x-notification.alert/>
        <x-data-table.table
            id="product_catalog_table"
            class="table-bordered"
            targets="-1,-2,-3"
            type="index"
            pageLength="20">
            <x-slot name="filter">
                <x-data-table.filter.trashed-filter tableId="product_catalog_table"/>
            </x-slot>
            <x-data-table.head>
                <x-data-table.th
                    :text="__('classifiers.nomenclature.products.types_of_end_products.type')"/>
                <x-data-table.th
                    :text="__('classifiers.nomenclature.products.full_name')"/>
                <x-data-table.th
                    :text="__('classifiers.nomenclature.products.product_catalog.GTIN')"/>
                <x-data-table.th
                    :text="__('classifiers.nomenclature.products.product_catalog.price_list')"/>
                <x-data-table.th/>
                <x-data-table.th/>
                <x-data-table.th/>
            </x-data-table.head>
            <x-data-table.body>
                @foreach($productsCatalog as $key => $product)
                    <x-data-table.tr
                        :model="$product">
                        <x-data-table.td
                            :title="$product->endProduct->type->name">
                            <span class="d-none">
                                {{$product->endProduct->type->name}}
                            </span>
                            <i class="bi bi-info-square-fill fs-5" style="color: {{$product->endProduct->type->color}};"
                               title="{{$product->endProduct->type->name}}">
                            </i>
                        </x-data-table.td>
                        <x-data-table.td class="text-start">
                            {{$product->endProduct->full_name}}
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$product->GTIN}}
                        </x-data-table.td>
                        <x-data-table.td>
                            @if(!$product->retailPrice)
                                <i class="bi bi-x text-danger fs-5"
                                   title="{{__('classifiers.nomenclature.products.product_prices.tips.price_not_added')}}">
                                </i>
                                <span class="d-none">0</span>
                            @else
                                <i class="bi bi-check2 text-success fs-5"
                                   title="{{__('classifiers.nomenclature.products.product_prices.tips.price_added')}}">
                                </i>
                                <span class="d-none">1</span>
                            @endif
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.href
                                :route="route('product_catalog.statistic', ['product_catalog' => $product->id])"
                                :title="__('classifiers.nomenclature.products.product_catalog.statistic')"
                                icon="bi bi-bar-chart-fill"
                                :disabled="$product->trashed()"/>
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.edit
                                :route="route('product_catalog.edit', ['product_catalog' => $product->id])"
                                :disabled="$product->trashed()"/>
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.soft-delete
                                :trashed="$product->trashed()"
                                :id="$product->id"
                                route="product_catalog"
                                :params="['product_catalog' => $product->id]"/>
                        </x-data-table.td>
                    </x-data-table.tr>
                @endforeach
            </x-data-table.body>
        </x-data-table.table>
    </x-card>
@endsection
