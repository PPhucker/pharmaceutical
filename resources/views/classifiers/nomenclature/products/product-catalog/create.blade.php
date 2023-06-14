@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('product_catalog.index')}}"
                  title="{{__('classifiers.nomenclature.products.titles.create')}}">
        <form id="form_add_product_catalog"
              method="POST"
              action="{{route('product_catalog.store')}}">
            @csrf
            <div class="row mb-2">
                <label for="product_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.product_catalog.product_id')}}
                </label>
                <div class="col md-6">
                    <select
                        name="product_id"
                        class="form-control form-control-sm text-primary
                        @error('product_id') is-invalid @enderror"
                        required>
                        @foreach($endProducts as $endProduct)
                            <option value="{{$endProduct->id}}"
                                    @if((int)old('product_id') === $endProduct->id) selected @endif
                                    style="background-color: {{$endProduct->type->color}}">
                                {{$endProduct->full_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <label for="place_of_business"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.product_catalog.place_of_business_id')}}
                </label>
                <div class="col md-6">
                    <select
                        name="place_of_business_id"
                        class="form-control form-control-sm text-primary
                        @error('place_of_business_id') is-invalid @enderror"
                        required>
                        @foreach($placesOfBusiness as $placeOfBusiness)
                            <option value="{{$placeOfBusiness->id}}"
                                    @if((int)old('place_of_business_id') === $placeOfBusiness->id)
                                        selected
                                @endif>
                                {{$placeOfBusiness->organization->name}} - {{$placeOfBusiness->address}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <label for="retail_price"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.products.product_catalog.GTIN')}}
                </label>
                <div class="col-md-2">
                    <input
                        type="text"
                    name="GTIN"
                    class="form-control form-control-sm text-primary
                    @error('GTIN') is-invalid @enderror"
                    value="{{old('GTIN')}}">
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <x-buttons.save formId="form_add_product_catalog"/>
        </x-slot>
    </x-forms.main>
@endsection
