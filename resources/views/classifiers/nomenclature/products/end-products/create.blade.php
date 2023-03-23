@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('end_products.index')}}"
                  title="{{__('classifiers.nomenclature.products.titles.create')}}">
        <form id="form_add_end_product"
              method="POST"
              action="{{route('end_products.store')}}">
            @csrf
            <div class="row mb-2">
                <label for="short_name"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.short_name')}}
                </label>
                <div class="col-md-6">
                    <input id="short_name"
                           type="text"
                           class="form-control form-control-sm text-primary
                           @error('short_name') is-invalid @enderror"
                           name="short_name"
                           value="{{old('short_name')}}"
                           required>
                    <x-forms.span-error name="short_name"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="full_name"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.full_name')}}
                </label>
                <div class="col-md-6">
                    <input id="full_name"
                           type="text"
                           class="form-control form-control-sm text-primary
                           @error('full_name') is-invalid @enderror"
                           name="full_name"
                           value="{{old('full_name')}}"
                           required>
                    <x-forms.span-error name="full_name"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="international_name_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.international_names_of_end_products.international_name_of_end_product')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('international_name_id') is-invalid @enderror"
                            id="international_name_id"
                            name="international_name_id">
                        @foreach($classifiers['international_names'] as $internationalName)
                            <option class="form-control form-control-sm"
                                    value="{{$internationalName->id}}">
                                {{$internationalName->id}} - {{$internationalName->name}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="international_name_id"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="okpd2_code"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.okpd2.okpd2')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('okpd2_code') is-invalid @enderror"
                            id="okpd2_code"
                            name="okpd2_code">
                        @foreach($classifiers['okpd2'] as $okpd2)
                            <option class="form-control form-control-sm"
                                    value="{{$okpd2->code}}">
                                {{$okpd2->code}} - {{$okpd2->name}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="okei_code"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="type_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.types_of_end_products.type_of_end_product')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('type_id') is-invalid @enderror"
                            id="type_id"
                            name="type_id">
                        @foreach($classifiers['types'] as $type)
                            <option class="form-control form-control-sm"
                                    value="{{$type->id}}">
                                {{$type->id}} - {{$type->name}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="type_id"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="registration_number_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.registration_numbers.registration_number')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('registration_number_id') is-invalid @enderror"
                            id="registration_number_id"
                            name="registration_number_id">
                        <option class="form-control form-control-sm"
                                value="{{null}}">
                            {{__('classifiers.nomenclature.products.registration_numbers.without_registration_number')}}
                        </option>
                        @foreach($classifiers['registration_numbers'] as $registrationNumber)
                            <option class="form-control form-control-sm"
                                    value="{{$registrationNumber->id}}">
                                {{$registrationNumber->id}} - {{$registrationNumber->number}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="registration_number_id"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="okei_code"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.okei.unit')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('okei_code') is-invalid @enderror"
                            id="okei_code"
                            name="okei_code">
                        @foreach($classifiers['okei'] as $okei)
                            <option class="form-control form-control-sm"
                                    value="{{$okei->code}}">
                                {{$okei->code}} - {{$okei->symbol}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="okei_code"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="best_before_date"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.best_before_date')}}
                </label>
                <div class="col-md-6">
                    <input id="best_before_date"
                           type="text"
                           class="form-control form-control-sm text-primary
                           @error('best_before_date') is-invalid @enderror"
                           name="best_before_date"
                           value="{{old('best_before_date')}}"
                           required>
                    <x-forms.span-error name="best_before_date"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="marking"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.marking.marking')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('marking') is-invalid @enderror"
                            id="marking"
                            name="marking">
                            <option class="form-control form-control-sm"
                                    value="1">
                                {{__('classifiers.nomenclature.products.marking.yes')}}
                            </option>
                        <option class="form-control form-control-sm"
                                value="0">
                            {{__('classifiers.nomenclature.products.marking.no')}}
                        </option>
                    </select>
                    <x-forms.span-error name="marking"/>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <x-buttons.save formId="form_add_end_product"/>
        </x-slot>
    </x-forms.main>
@endsection
