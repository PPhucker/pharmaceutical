@extends('layouts.app')
@section('content')
    <x-card
        :title="$productCatalog->name_with_GTIN"
        :back="route('product_catalog.index')">
        <x-form.nav-tabs>
            <x-card.nav-link
                id="product_catalog_main_form"
                :title="__('classifiers.nomenclature.products.main_information')"
                :active="true"/>
            @digital_communication
            <x-card.nav-link
                id="aggregation_types_main_form"
                :title="__('classifiers.nomenclature.products.types_of_aggregation.types_of_aggregation')"/>
            @end_digital_communication
            @planning
            <x-card.nav-link
                id="materials_main_form"
                :title="__('classifiers.nomenclature.materials.materials')"/>
            @end_planning
        </x-form.nav-tabs>
        <x-notification.alert/>
        <x-form.nav-tab
            formId="product_catalog_main_form"
            :active="true">
            <x-form
                :route="route('product_catalog.update', ['product_catalog' => $productCatalog->id])"
                method="PATCH">
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
                                :selected="$endProduct->id === $productCatalog->product_id"/>
                        @endforeach
                    </x-form.element.select>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="international_name"
                            :text="__('classifiers.nomenclature.products.international_names_of_end_products.international_name_of_end_product')"/>
                    </x-slot>
                    <x-form.element.input
                        id="international_name"
                        :value="$productCatalog->endProduct->internationalName->name"
                        :disabled="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="okpd2"
                            :text="__('classifiers.nomenclature.products.okpd2.okpd2')"/>
                    </x-slot>
                    <x-form.element.input
                        id="okpd2"
                        :value="$productCatalog->endProduct->okpd2->name_with_code"
                        :disabled="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="type"
                            :text="__('classifiers.nomenclature.products.types_of_end_products.type_of_end_product')"/>
                    </x-slot>
                    <x-form.element.input
                        id="type"
                        :value="$productCatalog->endProduct->type->name"
                        :disabled="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="registration_number"
                            :text="__('classifiers.nomenclature.products.registration_numbers.registration_number')"/>
                    </x-slot>
                    <x-form.element.input
                        id="registration_number"
                        :value="$productCatalog->endProduct->registrationNumber->num"
                        :disabled="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="okei"
                            :text="__('classifiers.nomenclature.okei.unit')"/>
                    </x-slot>
                    <x-form.element.input
                        id="okei"
                        :value="$productCatalog->endProduct->okei->unit"
                        :disabled="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="best_before_date"
                            :text="__('classifiers.nomenclature.products.best_before_date')"/>
                    </x-slot>
                    <x-form.element.input
                        id="best_before_date"
                        :value="$productCatalog->endProduct->best_before_date"
                        :disabled="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="marking"
                            :text="__('classifiers.nomenclature.products.marking.marking')"/>
                    </x-slot>
                    <x-form.element.input
                        id="marking"
                        :value="$productCatalog->endProduct->marking_formatted_status"
                        :disabled="true"/>
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
                                :selected="$placeOfBusiness->id === $productCatalog->place_of_business_id"/>
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
                        :value="$productCatalog->GTIN"
                        min="14"
                        max="14"/>
                </x-form.row>
                <footer class="mt-auto me-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <x-form.button.save formId="product_catalog_main_form"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </x-form.nav-tab>
        @include('classifiers.nomenclature.products.product-catalog.aggregation-types')
    </x-card>
@endsection
