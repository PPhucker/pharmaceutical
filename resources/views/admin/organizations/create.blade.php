@extends('layouts.app')
@section('content')
    <x-token.dadata-token/>
    <x-card
        :title="__('contractors.organizations.titles.create')"
        :back="route('organizations.index')">
        <x-form
            formId="organization_add_form"
            :route="route('organizations.store')">
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
                            :selected="$legalForm->abbreviation === old('legal_form_type')"/>
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
                    :value="old('name')"
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
                    :value="old('INN')"
                    :required="true"
                    min="10"
                    max="12"/>
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
                    :value="old('OKPO')"
                    :required="true"
                    min="8"
                    max="10"/>
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
                    :value="old('kpp')"
                    :required="true"
                    min="9"
                    max="9"/>
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
                    :value="old('contacts')"/>
            </x-form.row>
            <footer class="mt-auto me-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <x-form.button.save formId="organization_add_form"/>
                    </li>
                </ul>
            </footer>
        </x-form>
    </x-card>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('#name, #INN').suggestions({
                token: $('#dadata_token').val(),
                type: 'PARTY',
                onSelect: function(suggestion) {
                    let name = suggestion.data.name.short
                        ? suggestion.data.name.short
                        : suggestion.data.name.full;
                    $('#name').val('"' + name + '"');
                    $('#legal_form_type').val(suggestion.data.opf.short);
                    $('#INN').val(suggestion.data.inn);
                    $('#OKPO').val(suggestion.data.okpo);
                    $('#kpp').val(suggestion.data.kpp);
                },
            });
        });
    </script>
@endsection
