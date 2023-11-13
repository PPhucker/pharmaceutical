@extends('layouts.app')
@section('content')
    <div id="div_add_region"
         class="@if ($errors->has('region.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_region"
                  method="POST"
                  action="{{route('regions.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="name"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.regions.name')}}
                    </label>
                    <div class="col-md">
                        <input id="name"
                               type="text"
                               class="form-control form-control-sm
                               @error('region.name') is-invalid @enderror"
                               name="region[name]"
                               value="{{ old('region[name]') }}"
                               required>
                        @error('region.name')
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
                    <label for="zone"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.regions.zone')}}
                    </label>
                    <div class="col-md">
                        <textarea id="zone"
                                  rows="3"
                                  class="form-control form-control-sm
                               @error('region.zone') is-invalid @enderror"
                                  name="region[zone]">{{ old('region[zone]') }}</textarea>
                        @error('region.zone')
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
                    <x-buttons.save formId="form_add_region"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.regions.regions')}}">
        <form id="form_regions"
              method="POST"
              action="{{route('regions.update', ['region' => $regions->first()->id ?? 1])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_regions"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center col-md-1">
                        {{__('ID')}}
                    </th>
                    <th scope="col"
                        class="text-center col-md-2">
                        {{__('classifiers.regions.name')}}
                    </th>
                    <th scope="col"
                        class="text-center col-md">
                        {{__('classifiers.regions.zone')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($regions as $key => $region)
                    <tr>
                        <input type="hidden" name="regions[{{$key}}][id]" value="{{$region->id}}">
                        <td class="align-middle text-center border-start">
                            {{$region->id}}
                        </td>
                        <td class="align-middle col-md-2">
                            <span class="d-none">
                                {{$region->name}}
                            </span>
                            <input type="text"
                                   id="name-{{$key}}"
                                   name="regions[{{$key}}][name]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                    @error('regions.' . $key . '.name') is-invalid @enderror"
                                   value="{{$region->name}}"
                                   required>
                            @error('regions.' . $key . '.name')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </td>
                        <td class="align-middle text-wrap col-md fs-6">
                            <span class="d-none">{{$region->zone}}</span>
                            <small>{{$region->zone}}</small>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </x-tables.main>
            <x-slot name="footer">
                <x-buttons.save formId="form_regions"/>
                <x-buttons.collapse formId="div_add_region"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
