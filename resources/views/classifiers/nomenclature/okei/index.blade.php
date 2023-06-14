@extends('layouts.app')
@section('content')
    <div id="div_add_okei"
         class="@if ($errors->has('okei.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_okei"
                  method="POST"
                  action="{{route('okei.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="code"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.okei.code')}}
                    </label>
                    <div class="col-md">
                        <input id="code"
                               type="text"
                               class="form-control form-control-sm
                               @error('okei.code') is-invalid @enderror"
                               name="okei[code]"
                               value="{{ old('okei[code]') }}"
                               required>
                        @error('okei.code')
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
                    <label for="unit"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.okei.unit')}}
                    </label>
                    <div class="col-md">
                        <input id="unit"
                               type="text"
                               class="form-control form-control-sm
                               @error('okei.unit') is-invalid @enderror"
                               name="okei[unit]"
                               value="{{ old('okei[unit]') }}"
                               required>
                        @error('okei.unit')
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
                    <label for="symbol"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.okei.symbol')}}
                    </label>
                    <div class="col-md">
                        <input id="symbol"
                               type="text"
                               class="form-control form-control-sm
                               @error('okei.symbol') is-invalid @enderror"
                               name="okei[symbol]"
                               value="{{ old('okei[symbol]') }}"
                               required>
                        @error('okei.symbol')
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
                    <x-buttons.save formId="form_add_okei"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.nomenclature.okei.okei')}}">
        <form id="form_okei"
              method="POST"
              action="{{route('okei.update', ['okei' => 'okei'])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_okei"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center col-md-2">
                        {{__('classifiers.nomenclature.okei.code')}}
                    </th>
                    <th scope="col"
                        class="text-center col-md">
                        {{__('classifiers.nomenclature.okei.unit')}}
                    </th>
                    <th scope="col"
                        class="text-center col-md-2">
                        {{__('classifiers.nomenclature.okei.symbol')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($okei as $key => $item)
                    <tr>
                        <input type="hidden"
                               name="okei[{{$key}}][original_code]"
                               value="{{$item->code}}">
                        <td class="align-middle text-center border-start col-md-2">
                        <span class="d-none">
                            {{$item->code}}
                        </span>
                            <input type="text"
                                   id="code-{{$key}}"
                                   name="okei[{{$key}}][code]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('okei.' . $key . '.code') is-invalid @enderror"
                                   value="{{$item->code}}"
                                   required>
                            @error('okei.' . $key . '.code')
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
                            {{$item->unit}}
                        </span>
                            <input type="text"
                                   id="unit-{{$key}}"
                                   name="okei[{{$key}}][unit]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('okei.' . $key . '.unit') is-invalid @enderror"
                                   value="{{$item->unit}}"
                                   required>
                            @error('okei.' . $key . '.unit')
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
                            {{$item->symbol}}
                        </span>
                            <input type="text"
                                   id="symbol-{{$key}}"
                                   name="okei[{{$key}}][symbol]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('okei.' . $key . '.symbol') is-invalid @enderror"
                                   value="{{$item->symbol}}"
                                   required>
                            @error('okei.' . $key . '.symbol')
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
                @if(count($okei) > 1)
                    <x-buttons.save formId="form_okei"/>
                @endif
                <x-buttons.collapse formId="div_add_okei"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
