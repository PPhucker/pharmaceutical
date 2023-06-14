@extends('layouts.app')
@section('content')
    {{--@if($errors->any()){{dd($errors)}}@endif--}}
    <div id="div_add_type_of_aggregation"
         class="@if ($errors->has('type_of_aggregation.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_type_of_aggregation"
                  method="POST"
                  action="{{route('types_of_aggregation.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="code"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.types_of_aggregation.code')}}
                    </label>
                    <div class="col-md">
                        <input id="code"
                               type="text"
                               class="form-control form-control-sm
                               @error('type_of_aggregation.code') is-invalid @enderror"
                               name="type_of_aggregation[code]"
                               value="{{ old('type_of_aggregation[code]') }}"
                               required>
                        @error('type_of_aggregation.code')
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
                    <label for="name"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.types_of_aggregation.name')}}
                    </label>
                    <div class="col-md">
                        <input id="name"
                               type="text"
                               class="form-control form-control-sm
                               @error('type_of_aggregation.name') is-invalid @enderror"
                               name="type_of_aggregation[name]"
                               value="{{ old('type_of_aggregation[name]') }}"
                               required>
                        @error('type_of_aggregation.name')
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
                    <x-buttons.save formId="form_add_type_of_aggregation"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.nomenclature.products.types_of_aggregation.types_of_aggregation')}}">
        <form id="form_types_of_aggregation"
              method="POST"
              action="{{route('types_of_aggregation.update', ['types_of_aggregation' => $typesOfAggregation->first() ?: '1'])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_types_of_aggregation"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center col-md-2">
                        {{__('classifiers.nomenclature.products.types_of_aggregation.code')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.products.types_of_aggregation.name')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($typesOfAggregation as $key => $type)
                    <tr>
                        <td class="align-middle col-md-2">
                            <input type="hidden"
                                   name="types_of_aggregation[{{$key}}][original_code]"
                                   value="{{$type->code}}">
                            <span class="d-none">
                                {{$type->code}}
                            </span>
                            <input type="text"
                                   name="types_of_aggregation[{{$key}}][code]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('types_of_aggregation.' . $key . '.code') is-invalid @enderror"
                                   value="{{$type->code}}"
                                   required>
                            @error('types_of_aggregation.' . $key . '.code')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </td>
                        <td class="align-middle">
                            <span class="d-none">
                                {{$type->name}}
                            </span>
                            <input type="text"
                                   name="types_of_aggregation[{{$key}}][name]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('types_of_aggregation.' . $key . '.name') is-invalid @enderror"
                                   value="{{$type->name}}"
                                   required>
                            @error('types_of_aggregation.' . $key . '.name')
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
                <x-buttons.save formId="form_types_of_aggregation"/>
                <x-buttons.collapse formId="div_add_type_of_aggregation"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
