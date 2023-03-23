@extends('layouts.app')
@section('content')
    <div id="div_add_type_of_material"
         class="@if ($errors->has('type_of_material.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_type_of_material"
                  method="POST"
                  action="{{route('types_of_materials.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="name"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.materials.types_of_materials.name')}}
                    </label>
                    <div class="col-md">
                        <input id="name"
                               type="text"
                               class="form-control form-control-sm
                               @error('type_of_material.name') is-invalid @enderror"
                               name="type_of_material[name]"
                               value="{{ old('type_of_material[name]') }}"
                               required>
                        @error('type_of_material.name')
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
                    <x-buttons.save formId="form_add_type_of_material"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.nomenclature.materials.types_of_materials.types_of_materials')}}">
        <form id="form_types_of_materials"
              method="POST"
              action="{{route('types_of_materials.update', ['types_of_material' => 1])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_types_of_materials"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center">
                        ID
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.materials.types_of_materials.name')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($typesOfMaterials as $key => $type)
                    <tr>
                        <td class="align-middle text-center">
                            <input type="hidden"
                                   name="types_of_materials[{{$key}}][id]"
                                   value="{{$type->id}}">
                            {{$type->id}}
                        </td>
                        <td class="align-middle text-center">
                        <span class="d-none">
                            {{$type->name}}
                        </span>
                            <input type="text"
                                   id="name-{{$key}}"
                                   name="types_of_materials[{{$key}}][name]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('types_of_materials.' . $key . '.name') is-invalid @enderror"
                                   value="{{$type->name}}"
                                   required>
                            @error('types_of_materials.' . $key . '.name')
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
                @if(count($typesOfMaterials) > 0)
                    <x-buttons.save formId="form_types_of_materials"/>
                @endif
                <x-buttons.collapse formId="div_add_type_of_material"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
