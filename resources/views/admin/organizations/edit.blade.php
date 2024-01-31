@extends('layouts.app')
@section('content')
    <x-card
        :title="$organization->full_name"
        :back="route('organizations.index')">
        <x-token.dadata-token/>
        <x-form.nav-tabs>
            <x-card.nav-link
                id="organization_main_form"
                :title="__('contractors.main_information')"
                :active="true"/>
            <x-card.nav-link
                id="places_main_form"
                :title="__('contractors.places_of_business.places_of_business')"/>
            <x-card.nav-link
                id="account_details_main_form"
                :title="__('contractors.bank_account_details.bank_account_details')"/>
            <x-card.nav-link
                id="staff_main_form"
                :title="__('contractors.staff.staff')"/>
            <x-card.nav-item-dropdown
                :title="__('contractors.transport')">
                <li>
                    <x-card.dropdown-item
                        id="cars_main_form"
                        :title="__('contractors.cars.cars')"
                        class="dropdown-item"/>
                </li>
                <li>
                    <x-card.dropdown-item
                        id="trailers_main_form"
                        :title="__('contractors.trailers.trailers')"
                        class="dropdown-item"/>
                </li>
                <li>
                    <x-card.dropdown-item
                        id="drivers_main_form"
                        :title="__('contractors.drivers.drivers')"
                        class="dropdown-item"/>
                </li>
            </x-card.nav-item-dropdown>
        </x-form.nav-tabs>
        <x-notification.alert/>
        <x-form.nav-tab
            formId="organization_main_form"
            :active="true">
            <x-form
                :route="route('organizations.update', ['organization' => $organization->id])"
                method="PATCH">
                <input type="hidden"
                       name="id"
                       value="{{$organization->id}}">
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="legal_form_type"
                            :text="__('classifiers.legal_forms.legal_form')"/>
                    </x-slot>
                    <x-form.element.select
                        id="legal_form_type"
                        name="legal_form_type">
                        @foreach($legalForms as $legalForm)
                            <x-form.element.option
                                :value="$legalForm->abbreviation"
                                :text="$legalForm->abbreviation"
                                :selected="$legalForm->abbreviation === $organization->legal_form_type"/>
                        @endforeach
                    </x-form.element.select>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="name"
                            :text="__('contractors.name')"/>
                    </x-slot>
                    <x-form.element.input
                        id="name"
                        name="name"
                        :value="$organization->name"
                        :required="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="INN"
                            :text="__('contractors.inn')"/>
                    </x-slot>
                    <x-form.element.input
                        id="INN"
                        name="INN"
                        :value="$organization->INN"
                        :required="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="OKPO"
                            :text="__('contractors.okpo')"/>
                    </x-slot>
                    <x-form.element.input
                        id="OKPO"
                        name="OKPO"
                        :value="$organization->OKPO"
                        :required="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="kpp"
                            :text="__('contractors.kpp')"/>
                    </x-slot>
                    <x-form.element.input
                        id="kpp"
                        name="kpp"
                        :value="$organization->kpp"
                        :required="true"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="contacts"
                            :text="__('contractors.contacts')"/>
                    </x-slot>
                    <x-form.element.input
                        id="contacts"
                        name="contacts"
                        :value="$organization->contacts"/>
                </x-form.row>
                <footer class="mt-auto me-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <x-form.button.save formId="organization_main_form"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </x-form.nav-tab>
        @include('admin.organizations.places-of-business.edit')
        {{--@include('admin.organizations.bank-account-details.edit')--}}
        {{--@include('admin.organizations..cars.edit')--}}
        {{--@include('admin.organizations..trailers.edit')--}}
        {{--@include('admin.organizations..drivers.edit')--}}
    </x-card>
@endsection
