@extends('layouts.app')
@section('content')
    <div id="div_add_registration_number_of_end_product"
         class="@if ($errors->has('registration_number.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_registration_number_of_end_product"
                  method="POST"
                  action="{{route('registration_numbers.store')}}">
                @csrf
                <div class="row mb-0">
                    <label for="number"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.registration_numbers.number')}}
                    </label>
                    <div class="col-md">
                        <input id="number"
                               type="text"
                               class="form-control form-control-sm
                               @error('registration_number.number') is-invalid @enderror"
                               name="registration_number[number]"
                               value="{{ old('registration_number[number]') }}"
                               required>
                        @error('registration_number.number')
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
                    <x-buttons.save formId="form_add_registration_number_of_end_product"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.nomenclature.products.registration_numbers.registration_numbers')}}">
        <form id="form_registration_numbers_of_end_products"
              method="POST"
              action="{{route('registration_numbers.update', ['registration_number' => 1])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_registration_numbers_of_end_products"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center col-md-1">
                        ID
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.products.registration_numbers.number')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($registrationNumbers as $key => $registrationNumber)
                    <tr>
                        <td class="align-middle text-center col-md-1">
                            <input type="hidden"
                                   name="registration_numbers[{{$key}}][id]"
                                   value="{{$registrationNumber->id}}">
                            {{$registrationNumber->id}}
                        </td>
                        <td class="align-middle text-center">
                        <span class="d-none">
                            {{$registrationNumber->number}}
                        </span>
                            <input type="text"
                                   id="number-{{$key}}"
                                   name="registration_numbers[{{$key}}][number]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('registration_numbers.' . $key . '.number') is-invalid @enderror"
                                   value="{{$registrationNumber->number}}"
                                   required>
                            @error('registration_numbers.' . $key . '.number')
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
                <x-buttons.save formId="form_registration_numbers_of_end_products"/>
                <x-buttons.collapse formId="div_add_registration_number_of_end_product"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
