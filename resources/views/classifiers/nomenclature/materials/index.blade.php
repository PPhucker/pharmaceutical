@extends('layouts.app')
@section('content')
    <div id="div_add_material"
         class="@if ($errors->has('material.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_material"
                  method="POST"
                  action="{{route('materials.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="type_id"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.materials.type_id')}}
                    </label>
                    <div class="col-md">
                        <select
                            name="material[type_id]"
                            class="form-control form-control-sm
                            @error('material.type_id') is-invalid @enderror">
                            @foreach($typesOfMaterials as $type)
                                <option value="{{$type->id}}">
                                    {{$type->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('material.type_id')
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
                    <label for="okei_code"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.materials.okei_code')}}
                    </label>
                    <div class="col-md">
                        <select
                            name="material[okei_code]"
                            class="form-control form-control-sm
                            @error('material.okei_code') is-invalid @enderror">
                            @foreach($okei as $item)
                                <option value="{{$item->code}}">
                                    {{$item->symbol}}
                                </option>
                            @endforeach
                        </select>
                        @error('material.okei_code')
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
                        {{__('classifiers.nomenclature.materials.name')}}
                    </label>
                    <div class="col-md">
                        <input id="name"
                               type="text"
                               class="form-control form-control-sm
                               @error('material.name') is-invalid @enderror"
                               name="material[name]"
                               value="{{ old('material[name]') }}"
                               required>
                        @error('material.name')
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
                    <x-buttons.save formId="form_add_material"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.nomenclature.materials.materials')}}">
        <form id="form_materials"
              method="POST"
              action="{{route('materials.update', ['material' => 1])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_materials"
                           domOrderType="{{true}}">
                <x-slot name="filter">
                    <x-tables.filters.trashed-filter tableId="table_materials"/>
                </x-slot>
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center col-md-1">
                        ID
                    </th>
                    <th scope="col"
                        class="text-center col-md-2">
                        {{__('classifiers.nomenclature.materials.type_id')}}
                    </th>
                    <th scope="col"
                        class="text-center col-md-1">
                        {{__('classifiers.nomenclature.materials.okei_code')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.materials.name')}}
                    </th>
                    <th class="col-md-1">
                    <span class="d-none">
                        {{__('datatable.buttons.delete')}}
                    </span>
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($materials as $key => $material)
                    <tr @if($material->trashed()) class="d-none trashed" @endif>
                        <td class="align-middle text-center">
                            <input type="hidden"
                                   name="materials[{{$key}}][id]"
                                   value="{{$material->id}}">
                            {{$material->id}}
                        </td>
                        <td class="align-middle text-center">
                        <span class="d-none">
                            {{$material->type->name}}
                        </span>
                            <select
                                name="materials[{{$key}}][type_id]"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('materials.' . $key . '.type_id') is-invalid @enderror"
                                @if($material->trashed()) disabled @endif>
                                @foreach($typesOfMaterials as $type)
                                    <option value="{{$type->id}}"
                                            @if($type->id === $material->type->id) selected @endif>
                                        {{$type->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('materials.' . $key . '.type_id')
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
                            {{$material->okei->symbol}}
                        </span>
                            <select
                                name="materials[{{$key}}][okei_code]"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('materials.' . $key . '.okei_code') is-invalid @enderror"
                                @if($material->trashed()) disabled @endif>
                                @foreach($okei as $item)
                                    <option value="{{$item->code}}"
                                            @if($item->code === $material->okei->code) selected @endif>
                                        {{$item->symbol}}
                                    </option>
                                @endforeach
                            </select>
                            @error('materials.' . $key . '.okei_code')
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
                            {{$material->name}}
                        </span>
                            <input type="text"
                                   id="name-{{$key}}"
                                   name="materials[{{$key}}][name]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('materials.' . $key . '.name') is-invalid @enderror"
                                   value="{{$material->name}}"
                                   required
                                   @if($material->trashed()) disabled @endif>
                            @error('materials.' . $key . '.name')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </td>
                        <td class="text-center align-middle col-md-1">
                            @if ($material->trashed())
                                <x-buttons.restore
                                    route="{{route('materials.restore', ['material' => $material->id])}}"
                                    itemId="{{$material->id}}"/>
                            @else
                                <x-buttons.delete
                                    route="{{route('materials.destroy', ['material' => $material->id])}}"
                                    formId="destroy"
                                    itemId="{{$material->id}}"/>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </x-tables.main>
            <x-slot name="footer">
                @if(count($materials) > 0)
                    <x-buttons.save formId="form_materials"/>
                @endif
                <x-buttons.collapse formId="div_add_material"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
