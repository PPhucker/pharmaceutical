@extends('layouts.app')
@section('content')
    <div id="div_add_service"
         class="@if ($errors->has('service.*')) collapsed @else collapse @endif mb-2 sticky-top position-sticky">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_service"
                  method="POST"
                  action="{{route('services.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="name"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.services.name')}}
                    </label>
                    <div class="col-md">
                        <input id="name"
                               type="text"
                               class="form-control form-control-sm text-primary
                               @error('service.name') is-invalid @enderror"
                               name="service[name]"
                               value="{{ old('service.name') }}"
                               required>
                        @error('service.name')
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
                    <label for="type_id"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.services.okei')}}
                    </label>
                    <div class="col-md">
                        <select
                            name="service[okei_code]"
                            class="form-control form-control-sm text-primary
                            @error('service.okei_code') is-invalid @enderror">
                            @foreach($okeiClassifier as $okei)
                                <option value="{{$okei->code}}">
                                    {{$okei->symbol}}
                                </option>
                            @endforeach
                        </select>
                        @error('service.okei_code')
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
                    <x-buttons.save formId="form_add_service"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.nomenclature.services.services')}}">
        <form id="form_services"
              method="POST"
              action="{{route('services.update', ['service' => $services->first() ?? 1])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_services"
                           domOrderType="{{true}}">
                <x-slot name="filter">
                    <x-tables.filters.trashed-filter tableId="table_services"/>
                </x-slot>
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center col-md-1">
                        ID
                    </th>
                    <th scope="col"
                        class="text-center col-md-2">
                        {{__('classifiers.nomenclature.services.name')}}
                    </th>
                    <th scope="col"
                        class="text-center col-md-1">
                        {{__('classifiers.nomenclature.services.okei')}}
                    </th>
                    <th class="col-md-1">
                    <span class="d-none">
                        {{__('datatable.buttons.delete')}}
                    </span>
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($services as $key => $service)
                    <tr @if($service->trashed()) class="d-none trashed" @endif>
                        <input type="hidden"
                               name="services[{{$key}}][id]"
                               value="{{$service->id}}">
                        <td class="text-center align-middle col-md-1">
                            {{$service->id}}
                        </td>
                        <td class="align-middle text-center">
                        <span class="d-none">
                            {{$service->name}}
                        </span>
                            <input type="text"
                                   id="name-{{$key}}"
                                   name="services[{{$key}}][name]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('services.' . $key . '.name') is-invalid @enderror"
                                   value="{{$service->name}}"
                                   required
                                   @if($service->trashed()) disabled @endif>
                            @error('services.' . $key . '.name')
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
                            {{$service->okei->symbol}}
                        </span>
                            <select
                                name="services[{{$key}}][okei_code]"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('services.' . $key . '.okei_code') is-invalid @enderror"
                                @if($service->trashed()) disabled @endif>
                                @foreach($okeiClassifier as $okei)
                                    <option value="{{$okei->code}}"
                                            @if($okei->code === $service->okei->code) selected @endif>
                                        {{$service->okei->symbol}}
                                    </option>
                                @endforeach
                            </select>
                            @error('services.' . $key . '.okei_code')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </td>
                        <td class="text-center align-middle col-md-1">
                            @if ($service->trashed())
                                <x-buttons.restore
                                    route="{{route('services.restore', ['service' => $service->id])}}"
                                    itemId="{{$service->id}}"/>
                            @else
                                <x-buttons.delete
                                    route="{{route('services.destroy', ['service' => $service->id])}}"
                                    formId="destroy"
                                    itemId="{{$service->id}}"/>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </x-tables.main>
            <x-slot name="footer">
                @if(count($services) > 0)
                    <x-buttons.save formId="form_services"/>
                @endif
                <x-buttons.collapse formId="div_add_service"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
