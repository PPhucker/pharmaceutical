@extends('layouts.app')
@section('content')
    <x-card
        :title="__('contractors.edit_card')"
        :back="route('contractors.index')">
        <x-token.dadata-token/>
        <x-form.nav-tabs>
            <x-card.nav-link
                id="contractor_main_form"
                :title="__('contractors.main_information')"
                :active="true"/>
            <x-card.nav-link
                id="places_main_form"
                :title="__('contractors.places_of_business.places_of_business')"/>
            <x-card.nav-link
                id="contracts_main_form"
                :title="__('contractors.contracts.contracts')"/>
            <x-card.nav-link
                id="account_details_main_form"
                :title="__('contractors.bank_account_details.bank_account_details')"/>
            @roles(['marketing'])
            <x-card.nav-link
                id="contact_persons_main_form"
                :title="__('contractors.contact_persons.contact_persons')"/>
            @end_roles
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
            formId="contractor_main_form"
            :active="true">
            <x-form
                :route="route('contractors.update', ['contractor' => $contractor->id])"
                method="PATCH">
                <input type="hidden"
                       name="id"
                       value="{{$contractor->id}}">
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
                                :selected="$legalForm->abbreviation === $contractor->legal_form_type"/>
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
                        :value="$contractor->name"
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
                        :value="$contractor->INN"
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
                        :value="$contractor->OKPO"
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
                        :value="$contractor->kpp"
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
                        :value="$contractor->contacts"/>
                </x-form.row>
                <x-form.row>
                    <x-slot name="label">
                        <x-form.label
                            forId="comment"
                            :text="__('contractors.comment')"/>
                    </x-slot>
                    <x-form.element.textarea
                        id="comment"
                        name="comment"
                        :text="$contractor->comment"/>
                </x-form.row>
                <footer class="mt-auto me-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <x-form.button.save formId="contractor_main_form"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </x-form.nav-tab>
        @include('contractors.places-of-business.edit')
        @include('contractors.contracts.edit')
        @include('contractors.bank-account-details.edit')
        @include('contractors.contact-persons.edit')
        @include('contractors.cars.edit')
        @include('contractors.trailers.edit')
        @include('contractors.drivers.edit')
    </x-card>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('#name, #INN').suggestions({
                token: $('#dadata_token').val(),
                type: 'PARTY',
                onSelect: function(suggestion) {
                    $('#name').val('"' + suggestion.data.name.full + '"');
                    $('#legal_form_type').val(suggestion.data.opf.short);
                    $('#INN').val(suggestion.data.inn);
                    $('#OKPO').val(suggestion.data.okpo);
                },
            });
        });
    </script>
@endsection
