@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('classifiers.nomenclature.products.products')}}">
        <x-tables.main id="table_end_products"
                       targets="-1,-2">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_end_products"/>
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
                <x-tables.columns.thead.edit/>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($endProducts as $key => $product)
                <tr @if($product->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$product->id}}
                    </td>
                    <td class="align-middle">
                        {{$product->full_name}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit route="{{route('end_products.edit', ['end_product' => $product->id])}}"
                                        disabled="{{$product->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($product->trashed())
                            <x-buttons.restore
                                route="{{route('end_products.restore', ['end_product' => $product->id])}}"
                                itemId="{{$product->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('end_products.destroy', ['end_product' => $product->id])}}"
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
