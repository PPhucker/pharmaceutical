@extends('layouts.app')
@section('content')
    <x-forms.main title="{{$contractor->legalForm->abbreviation}} {!! $contractor->name !!}"
                  back="{{route('contractors.index')}}">
        <x-forms.dadata-token/>
        <x-forms.collapse.card route="{{route('contractors.update', ['contractor' => $contractor->id])}}"
                               cardId="card_main_info"
                               formId="form_main_info"
                               title="{{__('contractors.main_information')}}">
            <x-slot name="cardBody">
                <input type="hidden"
                       name="id"
                       value="{{$contractor->id}}">
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
                                        @if($legalForm->abbreviation === $contractor->legalForm->abbreviation)
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
                               value="{{$contractor->name}}"
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
                               value="{{$contractor->INN}}"
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
                               value="{{$contractor->OKPO}}"
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
                               value="{{$contractor->kpp}}"
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
                               value="{{$contractor->contacts}}">
                        <x-forms.span-error name="contacts"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for=""
                           class="col-md-4 col-form-label text-md-end">
                        {{__('contractors.comment')}}
                    </label>
                    <div class="col-md-6">
                        <textarea
                            class="form-control form-control-sm text-primary @error('comment') is-invalid @enderror"
                            id="comment" name="comment" rows="3">{{$contractor->comment}}</textarea>
                        <x-forms.span-error name="comment"/>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-buttons.save formId="form_main_info"/>
            </x-slot>
        </x-forms.collapse.card>

        @include('contractors.places-of-business.create')
        @include('contractors.places-of-business.edit')
        @include('contractors.contracts.create')
        @include('contractors.contracts.edit')
        @include('contractors.bank-account-details.create')
        @include('contractors.bank-account-details.edit')
        @include('contractors.contact-persons.create')
        @include('contractors.contact-persons.edit')
        @include('contractors.drivers.create')
        @include('contractors.drivers.edit')
        @include('contractors.cars.create')
        @include('contractors.cars.edit')
        @include('contractors.trailers.create')
        @include('contractors.trailers.edit')

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
