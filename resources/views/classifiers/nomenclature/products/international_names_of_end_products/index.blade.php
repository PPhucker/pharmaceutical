@extends('layouts.app')
@section('content')
    <x-forms.dadata-token/>
    <div id="div_add_international_name_of_end_product"
         class="@if ($errors->has('international_name_of_end_product.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_international_name_of_end_product"
                  method="POST"
                  action="{{route('international_names.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="name"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.international_names_of_end_products.name')}}
                    </label>
                    <div class="col-md">
                        <input type="text"
                               class="form-control form-control-sm
                               @error('international_name_of_end_product.name') is-invalid @enderror"
                               name="international_name_of_end_product[name]"
                               value="{{ old('international_name_of_end_product[name]') }}"
                               required>
                        @error('international_name_of_end_product.name')
                        <span class="invalid-feedback"
                              role="alert">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <x-slot name="footer">
                    <x-buttons.save formId="form_add_international_name_of_end_product"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main
        title="{{__('classifiers.nomenclature.products.international_names_of_end_products.international_names_of_end_products')}}">
        <form id="form_international_names_of_end_products"
              method="POST"
              action="{{route('international_names.update', ['international_name' => 1])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_international_names_of_end_products"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center">
                        ID
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.products.international_names_of_end_products.name')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($internationalNamesOfEndProducts as $key => $internationalName)
                    <tr>
                        <td class="align-middle text-center">
                            <input type="hidden"
                                   name="international_names_of_end_products[{{$key}}][id]"
                                   value="{{$internationalName->id}}">
                            {{$internationalName->id}}
                        </td>
                        <td class="align-middle text-center">
                        <span class="d-none">
                            {{$internationalName->name}}
                        </span>
                            <input type="text"
                                   name="international_names_of_end_products[{{$key}}][name]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('international_names_of_end_products.' . $key . '.name') is-invalid @enderror"
                                   value="{{$internationalName->name}}"
                                   required>
                            @error('international_names_of_end_products.' . $key . '.name')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </x-tables.main>
            <x-slot name="footer">
                <x-buttons.save formId="form_international_names_of_end_products"/>
                <x-buttons.collapse formId="div_add_international_name_of_end_product"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
