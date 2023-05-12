@extends('layouts.app')
@section('content')
    <x-forms.main title="{{$organization->legalForm->abbreviation}} {!! $organization->name !!}"
                  back="{{route('organizations.index')}}">
        <x-forms.dadata-token/>
        <x-forms.collapse.card route="{{route('organizations.update', ['organization' => $organization->id])}}"
                               cardId="card_main_info"
                               formId="form_main_info"
                               title="{{__('contractors.main_information')}}">
            <x-slot name="cardBody">
                <input type="hidden"
                       name="id"
                       value="{{$organization->id}}">
                <div class="row mb-2">
                    <label for="legal_form_type"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.legal_forms.legal_form')}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control form-control-sm text-primary
                            @error('legal_form_type') is-invalid @enderror"
                                id="legal_form_type"
                                name="legal_form_type">
                            @foreach($legalForms as $legalForm)
                                <option class="form-control form-control-sm"
                                        value="{{$legalForm->abbreviation}}"
                                        @if($legalForm->abbreviation === $organization->legalForm->abbreviation)
                                            selected
                                    @endif>
                                    {{$legalForm->abbreviation}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="legal_form_type"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('contractors.name')}}
                    </label>
                    <div class="col-md-6">
                        <input id="name"
                               type="text"
                               class="form-control form-control-sm text-primary
                           @error('name') is-invalid @enderror"
                               name="name"
                               value="{{$organization->name}}"
                               required>
                        <x-forms.span-error name="name"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for=""
                           class="col-md-4 col-form-label text-md-end">
                        {{__('contractors.inn')}}
                    </label>
                    <div class="col-md-6">
                        <input id="INN"
                               type="text"
                               class="form-control form-control-sm text-primary
                           @error('INN') is-invalid @enderror"
                               name="INN"
                               value="{{$organization->INN}}"
                               required>
                        <x-forms.span-error name="INN"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="OKPO"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('contractors.okpo')}}
                    </label>
                    <div class="col-md-6">
                        <input id="OKPO"
                               type="text"
                               class="form-control form-control-sm text-primary
                           @error('OKPO') is-invalid @enderror"
                               name="OKPO"
                               value="{{$organization->OKPO}}"
                               required>
                        <x-forms.span-error name="OKPO"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="kpp"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('contractors.kpp')}}
                    </label>
                    <div class="col-md-6">
                        <input id="kpp"
                               type="text"
                               class="form-control form-control-sm text-primary
                           @error('kpp') is-invalid @enderror"
                               name="kpp"
                               value="{{$organization->kpp}}"
                               required>
                        <x-forms.span-error name="kpp"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="contacts"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('contractors.contacts')}}
                    </label>
                    <div class="col-md-6">
                        <input id="contacts"
                               type="text"
                               class="form-control form-control-sm text-primary
                           @error('contacts') is-invalid @enderror"
                               name="contacts"
                               value="{{$organization->contacts}}">
                        <x-forms.span-error name="contacts"/>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-buttons.save formId="form_main_info"/>
            </x-slot>
        </x-forms.collapse.card>

        @include('admin.organizations.places-of-business.create')
        @include('admin.organizations.places-of-business.edit')
        @include('admin.organizations.bank-account-details.create')
        @include('admin.organizations.bank-account-details.edit')
        @include('admin.organizations.staff.create')
        @include('admin.organizations.staff.edit')
        @include('admin.organizations.drivers.create')
        @include('admin.organizations.drivers.edit')
        @include('admin.organizations.cars.create')
        @include('admin.organizations.cars.edit')
        @include('admin.organizations.trailers.create')
        @include('admin.organizations.trailers.edit')

    </x-forms.main>
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
