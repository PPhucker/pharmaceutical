@extends('layouts.app')
@section('content')
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
                        name="type_id"
                        class="form-control form-control-sm text-primary
                            @error('type_id') is-invalid @enderror">
                        @foreach($typesOfMaterials as $type)
                            <option value="{{$type->id}}">
                                {{$type->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('type_id')
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
                        name="okei_code"
                        class="form-control form-control-sm text-primary
                            @error('okei_code') is-invalid @enderror">
                        @foreach($okeiClassifier as $item)
                            <option value="{{$item->code}}">
                                {{$item->symbol}}
                            </option>
                        @endforeach
                    </select>
                    @error('okei_code')
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
                           class="form-control form-control-sm text-primary
                               @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') }}"
                           required>
                    @error('name')
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
                <label for="price"
                       class="col-md-2 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.materials.price')}}
                </label>
                <div class="col-md">
                    <input id="price"
                           type="text"
                           class="form-control form-control-sm text-primary
                               @error('price') is-invalid @enderror"
                           name="price"
                           value="{{ old('price') }}">
                    @error('price')
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
                <label for="nds"
                       class="col-md-2 col-form-label text-md-end">
                    {{__('classifiers.nomenclature.materials.nds')}}
                </label>
                <div class="col-md">
                    <input id="name"
                           type="text"
                           class="form-control form-control-sm text-primary
                               @error('nds') is-invalid @enderror"
                           name="nds"
                           value="{{ old('nds') }}"
                           required>
                    @error('nds')
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
@endsection
