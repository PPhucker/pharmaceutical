@extends('layouts.app')
@section('content')
    <x-forms.dadata-token/>
    <div id="div_add_type_of_end_product"
         class="@if ($errors->has('types_of_end_products.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_type_of_end_product"
                  method="POST"
                  action="{{route('types_of_end_products.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="name"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.types_of_end_products.name')}}
                    </label>
                    <div class="col-md">
                        <input id="name"
                               type="text"
                               class="form-control form-control-sm
                               @error('type_of_end_product.name') is-invalid @enderror"
                               name="type_of_end_product[name]"
                               value="{{ old('type_of_end_product[name]') }}"
                               required>
                        @error('type_of_end_product.name')
                        <span class="invalid-feedback"
                              role="alert">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="color"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.types_of_end_products.color')}}
                    </label>
                    <div class="col-md">
                        <input id="color"
                               type="color"
                               class="form-control form-control-sm
                               @error('type_of_end_product.color') is-invalid @enderror"
                               name="type_of_end_product[color]"
                               value="{{ old('type_of_end_product[color]') }}"
                               required>
                        @error('type_of_end_product.color')
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
                    <x-buttons.save formId="form_add_type_of_end_product"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.nomenclature.products.types_of_end_products.types_of_end_products')}}">
        <form id="form_types_of_end_products"
              method="POST"
              action="{{route('types_of_end_products.update', ['types_of_end_product' => 1])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_types_of_end_products"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center">
                        ID
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.products.types_of_end_products.name')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.products.types_of_end_products.color')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($typesOfEndProducts as $key => $type)
                    <tr>
                        <td class="align-middle text-center">
                            <input type="hidden"
                                   name="types_of_end_products[{{$key}}][id]"
                                   value="{{$type->id}}">
                            {{$type->id}}
                        </td>
                        <td class="align-middle text-center">
                        <span class="d-none">
                            {{$type->name}}
                        </span>
                            <input type="text"
                                   id="name-{{$key}}"
                                   name="types_of_end_products[{{$key}}][name]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('types_of_end_products.' . $key . '.name') is-invalid @enderror"
                                   value="{{$type->name}}"
                                   required>
                            @error('types_of_end_products.' . $key . '.name')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </td>
                        <td class="align-middle text-center">
                        <span class="d-none">
                            {{$type->color}}
                        </span>
                            <input type="color"
                                   id="name-{{$key}}"
                                   name="types_of_end_products[{{$key}}][color]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('types_of_end_products.' . $key . '.color') is-invalid @enderror"
                                   value="{{$type->color}}"
                                   required>
                            @error('types_of_end_products.' . $key . '.color')
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
                <x-buttons.save formId="form_types_of_end_products"/>
                <x-buttons.collapse formId="div_add_type_of_end_product"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
