@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('classifiers.nomenclature.products.product_catalog.product_catalog')}}">
        <x-tables.main id="table_product_catalog"
                       targets="-1,-2">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_product_catalog"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('ID')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('classifiers.nomenclature.products.full_name')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('classifiers.nomenclature.products.product_catalog.place_of_business_id')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('classifiers.nomenclature.products.product_catalog.GTIN')}}
                </th>
                <th scope="col"
                    class="text-center">
                    <span class="d-none">
                        {{__('form.button.statistic')}}
                    </span>
                </th>
                <x-tables.columns.thead.edit/>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($catalog as $product)
                <tr @if($product->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$product->id}}
                    </td>
                    <td class="text-wrap">
                        {{$product->endProduct->full_name}}
                    </td>
                    <td class="align-middle text-wrap">
                        {{$product->organization->name}} - {{$product->placeOfBusiness->address}}
                    </td>
                    <td class="align-middle text-center">
                        {{$product->GTIN}}
                    </td>
                    <td class="align-middle text-center">
                        <x-buttons.href route="{{route('product_catalog.statistic', ['product_catalog' => $product->id])}}"
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
