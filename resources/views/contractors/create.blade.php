@extends('layouts.app')
@section('content')
    <x-forms.dadata-token/>
    <x-forms.main back="{{route('contractors.index')}}"
                  title="{{__('contractors.titles.create')}}">
        <form id="form_add_contractor"
              method="POST"
              action="{{route('contractors.store')}}">
            @csrf
            <div class="row mb-2">
                <label for="legal_form_type"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.legal_forms.legal_form')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control- text-primary
                            @error('legal_form_type') is-invalid @enderror"
                            id="legal_form_type"
                            name="legal_form_type">
                        @foreach($legalForms as $legalForm)
                            <option class="form-control form-control-sm"
                                    value="{{$legalForm->abbreviation}}">
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
                           value="{{old('name')}}"
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
                           value="{{old('INN')}}"
                           required>
                    <x-forms.span-error name="INN"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="OKPO" class="col-md-4 col-form-label text-md-end">
                    {{__('contractors.okpo')}}
                </label>
                <div class="col-md-6">
                    <input id="OKPO"
                           type="text"
                           class="form-control form-control-sm text-primary
                           @error('OKPO') is-invalid @enderror"
                           name="OKPO"
                           value="{{old('OKPO')}}"
                           required>
                    <x-forms.span-error name="OKPO"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="kpp" class="col-md-4 col-form-label text-md-end">
                    {{__('contractors.kpp')}}
                </label>
                <div class="col-md-6">
                    <input id="kpp"
                           type="text"
                           class="form-control form-control-sm text-primary
                           @error('kpp') is-invalid @enderror"
                           name="kpp"
                           value="{{old('kpp')}}"
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
                           value="{{old('contacts')}}">
                    <x-forms.span-error name="contacts"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="name"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('contractors.comment')}}
                </label>
                <div class="col-md-6">
                    <textarea class="form-control form-control-sm text-primary @error('comment') is-invalid @enderror"
                              id="comment" name="comment" rows="3">{{old('comment')}}</textarea>
                    <x-forms.span-error name="comment"/>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <x-buttons.save formId="form_add_contractor"/>
        </x-slot>
    </x-forms.main>
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
