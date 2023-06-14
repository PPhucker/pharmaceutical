@extends('layouts.app')
@section('content')
    <x-forms.main title="{{$material->name}}"
                  back="{{route('materials.index')}}">
        <x-forms.collapse.card route="{{route('materials.update', ['material' => $material->id])}}"
                               cardId="card_main_info"
                               formId="form_main_info"
                               title="{{__('contractors.main_information')}}">
            <x-slot name="cardBody">
                <input type="hidden"
                       name="id"
                       value="{{$material->id}}">
                <div class="row mb-2">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.materials.name')}}
                    </label>
                    <div class="col-md-6">
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('name') is-invalid @enderror"
                               value="{{$material->name}}"
                               required>
                        @error('name')
                        <span class="invalid-feedback"
                              role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="type_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.materials.type_id')}}
                    </label>
                    <div class="col-md-6">
                        <select name="type_id"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('type_id') is-invalid @enderror">
                            @foreach($typesOfMaterials as $type)
                                <option value="{{$type->id}}"
                                        @if($type->id === $material->type->id) selected @endif>
                                    {{$type->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('type_id')
                        <span class="invalid-feedback"
                              role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="okei_code"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.materials.okei_code')}}
                    </label>
                    <div class="col-md-6">
                        <select name="okei_code"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('okei_code') is-invalid @enderror">
                            @foreach($okeiClassifier as $item)
                                <option value="{{$item->code}}"
                                        @if($item->code === $material->okei->code) selected @endif>
                                    {{$item->symbol}}
                                </option>
                            @endforeach
                        </select>
                        @error('okei_code')
                        <span class="invalid-feedback"
                              role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="price"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.materials.price')}}
                    </label>
                    <div class="col-md-6">
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   id="price"
                                   name="price"
                                   class="form-control form-control-sm text-primary
                                   @error('price') is-invalid @enderror"
                                   value="{{(float)$material->price}}">
                            @error('price')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                            <span class="input-group-text col-md-1">
                                {{__('currency.rub')}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="nds"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.materials.nds')}}
                    </label>
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <input type="text"
                                   id="nds"
                                   name="nds"
                                   class="form-control form-control-sm text-primary
                                   @error('nds') is-invalid @enderror"
                                   value="{{$material->nds * 100}}">
                            <span class="input-group-text col-md-1">
                                {{__('%')}}
                            </span>
                            @error('nds')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </div>
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
                            {{$material->updated_at}}
                        </small>
                    </li>
                </ul>
            </x-slot>
        </x-forms.collapse.card>
    </x-forms.main>
@endsection
