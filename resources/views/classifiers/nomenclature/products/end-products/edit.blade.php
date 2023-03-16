@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('end_products.index')}}"
                  title="{{__('classifiers.nomenclature.products.titles.edit')}}">
        <x-forms.collapse.card route="{{route('end_products.update', ['end_product' => $end_product->id])}}"
                               cardId="card_main_info"
                               formId="form_main_info"
                               title="{{__('classifiers.nomenclature.products.main_information')}}">
            <x-slot name="cardBody">
                <input type="hidden"
                       name="id"
                       value="{{$end_product->id}}">
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
                               value="{{$end_product->short_name}}"
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
                               value="{{$end_product->full_name}}"
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
                            @foreach($international_names as $internationalName)
                                <option class="form-control form-control-sm"
                                        value="{{$internationalName->id}}"
                                        @if($internationalName->id === $end_product->internationalName->id) selected @endif>
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
                            @foreach($okpd2 as $item)
                                <option class="form-control form-control-sm"
                                        value="{{$item->code}}"
                                        @if($item->code === $end_product->okpd2->code) selected @endif>
                                    {{$item->code}} - {{$item->name}}
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
                            @foreach($types as $type)
                                <option class="form-control form-control-sm"
                                        value="{{$type->id}}"
                                        @if($type->id === $end_product->type->id) selected @endif>
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
                                    value="{{null}}"
                                    @if(!$end_product->registrationNumber->id) selected @endif>
                                {{__('classifiers.nomenclature.products.registration_numbers.without_registration_number')}}
                            </option>
                            @foreach($registration_numbers as $registrationNumber)
                                <option class="form-control form-control-sm"
                                        value="{{$registrationNumber->id}}"
                                        @if($registrationNumber->id === $end_product->registrationNumber->id) selected @endif>
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
                            @foreach($okei as $item)
                                <option class="form-control form-control-sm"
                                        value="{{$item->code}}"
                                        @if($item->code === $end_product->okei->code) selected @endif>
                                    {{$item->code}} - {{$item->symbol}}
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
                               value="{{$end_product->best_before_date}}"
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
                                    value="1"
                                    @if($end_product->marking) selected @endif>
                                {{__('classifiers.nomenclature.products.marking.yes')}}
                            </option>
                            <option class="form-control form-control-sm"
                                    value="0"
                                    @if(!$end_product->marking) selected @endif>
                                {{__('classifiers.nomenclature.products.marking.no')}}
                            </option>
                        </select>
                        <x-forms.span-error name="marking"/>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-buttons.save formId="form_main_info"/>
            </x-slot>
        </x-forms.collapse.card>
    </x-forms.main>
@endsection
