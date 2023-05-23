@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('product_catalog.index')}}"
                  title="{{$product->endProduct->full_name . ' - ' . $product->GTIN}}">
        <x-forms.collapse.card route="{{route('product_catalog.update', ['product_catalog' => $product->id])}}"
                               cardId="card_main_info"
                               formId="form_main_info"
                               title="{{__('classifiers.nomenclature.products.main_information')}}">
            <x-slot name="cardBody">
                <input type="hidden"
                       name="id"
                       value="{{$product->id}}">
                <div class="row mb-2">
                    <label for="product_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.product_catalog.product_id')}}
                    </label>
                    <div class="col-md-6">
                        <select id="product_id"
                                name="product_id"
                                class="form-control form-control-sm text-primary
                           @error('product_id') is-invalid @enderror"
                                required>
                            @foreach($end_products as $endProduct)
                                <option value="{{$endProduct->id}}"
                                        @if($endProduct->id === $product->product_id)
                                            selected
                                    @endif>
                                    {{$endProduct->full_name}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="product_id"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="product_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.international_names_of_end_products.international_name_of_end_product')}}
                    </label>
                    <div class="col-md-6 align-items-center pt-1">
                            <small class="text-primary align-items-center">
                                {{$product->endProduct->internationalName->name}}
                            </small>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="product_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.okpd2.okpd2')}}
                    </label>
                    <div class="col-md-6 align-items-center pt-1">
                            <small class="text-primary align-items-center">
                                {{$product->endProduct->okpd2->name}}
                            </small>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="product_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.types_of_end_products.type_of_end_product')}}
                    </label>
                    <div class="col-md-6 align-items-center pt-1">
                            <small class="text-primary align-items-center">
                                {{$product->endProduct->type->name}}
                            </small>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="product_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.registration_numbers.registration_number')}}
                    </label>
                    <div class="col-md-6 align-items-center pt-1">
                            <small class="text-primary align-items-center">
                                @if(!$product->endProduct->registrationNumber)
                                    Без номера
                                @else
                                    {{$product->endProduct->registrationNumber->number}}
                                @endif
                            </small>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="product_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.okei.unit')}}
                    </label>
                    <div class="col-md-6 align-items-center pt-1">
                            <small class="text-primary align-items-center">
                                {{$product->endProduct->okei->symbol}}
                            </small>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="product_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.best_before_date')}}
                    </label>
                    <div class="col-md-6 align-items-center pt-1">
                            <small class="text-primary align-items-center">
                                {{$product->endProduct->best_before_date}}
                            </small>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="product_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.marking.marking')}}
                    </label>
                    <div class="col-md-6 align-items-center pt-1">
                        <small class="text-primary align-items-center">
                            @if($product->endProduct->marking)
                                {{__('classifiers.nomenclature.products.marking.yes')}}
                            @else
                                {{__('classifiers.nomenclature.products.marking.no')}}
                            @endif
                        </small>
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="place_of_business_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.product_catalog.place_of_business_id')}}
                    </label>
                    <div class="col-md-6">
                        <select id="place_of_business_id"
                                name="place_of_business_id"
                                class="form-control form-control-sm text-primary
                           @error('place_of_business_id') is-invalid @enderror"
                                required>
                            @foreach($places_of_business as $place)
                                <option value="{{$place->id}}"
                                        @if($place->id === $product->place_of_business_id)
                                            selected
                                    @endif>
                                    {{$place->organization->name}} - {{$place->address}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="place_of_business_id"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="GTIN"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.product_catalog.GTIN')}}
                    </label>
                    <div class="col-md-6">
                        <input id="GTIN"
                               type="text"
                               class="form-control form-control-sm text-primary
                           @error('GTIN') is-invalid @enderror"
                               name="GTIN"
                               value="{{$product->GTIN}}"
                               required>
                        <x-forms.span-error name="GTIN"/>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item text-md-end">
                        <x-buttons.save formId="form_main_info"/>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{__('form.last_updated')}}:
                        </small>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{$product->updated_at}}
                        </small>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{$product->user->name}}
                        </small>
                    </li>
                </ul>
            </x-slot>
        </x-forms.collapse.card>
        @include('classifiers.nomenclature.products.product-catalog.prices')
        @include('classifiers.nomenclature.products.product-catalog.materials')
        @include('classifiers.nomenclature.products.product-catalog.aggregation-types')
    </x-forms.main>
@endsection
