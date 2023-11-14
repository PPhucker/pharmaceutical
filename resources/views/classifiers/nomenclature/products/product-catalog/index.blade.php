@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('classifiers.nomenclature.products.product_catalog.product_catalog')}}">
        <x-tables.main id="table_product_catalog"
                       targets="-1,-2">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_product_catalog"/>
            </x-slot>
            <thead class="bg-primary text-white">
            <tr>
                <td class="text-center">
                    {{__('ID')}}
                </td>
                <td class="text-center">
                </td>
                <td class="text-center">
                    {{__('classifiers.nomenclature.products.full_name')}}
                </td>
                <td class="text-center">
                    {{__('classifiers.nomenclature.products.product_catalog.place_of_business_id')}}
                </td>
                <td class="text-center">
                    {{__('classifiers.nomenclature.products.product_catalog.GTIN')}}
                </td>
                <td class="text-center">
                    <span class="d-none">
                        {{__('form.button.statistic')}}
                    </span>
                </td>
                <x-tables.columns.thead.edit/>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($catalog as $product)
                <tr @if($product->trashed()) class="d-none trashed"@endif>
                    <td class="align-middle text-center">
                        {{$product->id}}
                    </td>
                    <td class="align-middle text-center">
                        @if(!count($product->prices))
                            <i class="bi bi-info-square-fill text-warning fs-5"
                               title="{{__('classifiers.nomenclature.products.product_prices.tips.price_not_added')}}">
                            </i>
                            <span class="d-none">0</span>
                        @else
                            <i class="bi bi-info-square-fill text-success fs-5"
                               title="{{__('classifiers.nomenclature.products.product_prices.tips.price_added')}}">

                            </i>
                            <span class="d-none">1</span>
                        @endif
                    </td>
                    <td class="text-wrap align-middle">
                        {{$product->endProduct->full_name}}
                    </td>
                    <td class="align-middle">
                        {{$product->organization->name}} - {{$product->placeOfBusiness->address}}
                    </td>
                    <td class="align-middle text-center">
                        {{$product->GTIN}}
                    </td>
                    <td class="align-middle text-center">
                        <x-buttons.href
                            route="{{route('product_catalog.statistic', ['product_catalog' => $product->id])}}"
                            title=" {{__('classifiers.nomenclature.products.product_catalog.statistic')}}"
                            icon="bi bi-bar-chart-fill"/>
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit route="{{route('product_catalog.edit', ['product_catalog' => $product->id])}}"
                                        disabled="{{$product->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($product->trashed())
                            <x-buttons.restore
                                route="{{route('product_catalog.restore', ['product_catalog' => $product->id])}}"
                                itemId="{{$product->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('product_catalog.destroy', ['product_catalog' => $product->id])}}"
                                formId="destroy"
                                itemId="{{$product->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
