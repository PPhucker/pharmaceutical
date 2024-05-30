@extends('layouts.app')
@section('content')
    <x-card
        :title="__('classifiers.nomenclature.products.titles.create')"
        :back="route('product_catalog.index')">
        <x-form
            formId="product_catalog_add_form"
            :route="route('product_catalog.store')">
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="product_id"
                        :text="__('classifiers.nomenclature.products.product_catalog.product_id')"/>
                </x-slot>
                <x-form.element.select
                    id="product_id"
                    name="product_id">
                    @foreach($endProducts as $key => $endProduct)
                        <x-form.element.option
                            :value="$endProduct->id"
                            :text="$endProduct->full_name"
                            :selected="$endProduct->id === (int)old('product_id')"/>
                    @endforeach
                </x-form.element.select>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="place_of_business_id"
                        :text="__('classifiers.nomenclature.products.product_catalog.place_of_business_id')"/>
                </x-slot>
                <x-form.element.select
                    id="place_of_business_id"
                    name="place_of_business_id">
                    @foreach($placesOfBusiness as $key => $placeOfBusiness)
                        <x-form.element.option
                            :value="$placeOfBusiness->id"
                            :text="$placeOfBusiness->address_with_organization"
                            :selected="$placeOfBusiness->id === (int)old('place_of_business_id')"/>
                    @endforeach
                </x-form.element.select>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="GTIN"
                        :text="__('classifiers.nomenclature.products.product_catalog.GTIN')"/>
                </x-slot>
                <x-form.element.input
                    type="text"
                    id="GTIN"
                    name="GTIN"
                    :value="old('GTIN')"
                    min="14"
                    max="14"/>
            </x-form.row>
            <footer class="mt-auto me-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <x-form.button.save formId="product_catalog_add_form"/>
                    </li>
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
