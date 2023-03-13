@extends('layouts.app')
@section('content')
    <x-forms.dadata-token/>
    <div id="div_add_okpd2"
         class="@if ($errors->has('okpd2.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_okpd2"
                  method="POST"
                  action="{{route('okpd2.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="name"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.okpd2.name')}}
                    </label>
                    <div class="col-md">
                        <input id="name"
                               type="text"
                               class="form-control form-control-sm
                               @error('okpd2.name') is-invalid @enderror"
                               name="okpd2[name]"
                               value="{{ old('okpd2[name]') }}"
                               required>
                        @error('okpd2.name')
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
                    <label for="code"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.nomenclature.products.okpd2.code')}}
                    </label>
                    <div class="col-md">
                        <input id="code"
                               type="text"
                               class="form-control form-control-sm
                               @error('okpd2.code') is-invalid @enderror"
                               name="okpd2[code]"
                               value="{{ old('okpd2[code]') }}"
                               required>
                        @error('okpd2.code')
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
                    <x-buttons.save formId="form_add_okpd2"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.nomenclature.products.okpd2.okpd2')}}">
        <form id="form_okpd2"
              method="POST"
              action="{{route('okpd2.update', ['okpd2' => $okpd2->first()->code])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_okpd2"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center col-md-2">
                        {{__('classifiers.nomenclature.products.okpd2.code')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.nomenclature.products.okpd2.name')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($okpd2 as $key => $item)
                    <tr>
                        <input type="hidden"
                               name="okpd2[{{$key}}][original_code]"
                               value="{{$item->code}}">
                        <td class="align-middle text-center col-md-2">
                        <span class="d-none">
                            {{$item->code}}
                        </span>
                            <input type="text"
                                   id="code-{{$key}}"
                                   name="okpd2[{{$key}}][code]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('okpd2.' . $key . '.code') is-invalid @enderror"
                                   value="{{$item->code}}"
                                   required>
                            @error('$okpd2.' . $key . '.code')
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
                            {{$item->name}}
                        </span>
                            <input type="text"
                                   id="name-{{$key}}"
                                   name="okpd2[{{$key}}][name]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('okpd2.' . $key . '.name') is-invalid @enderror"
                                   value="{{$item->name}}"
                                   required>
                            @error('okpd2.' . $key . '.name')
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
                <x-buttons.save formId="form_okpd2"/>
                <x-buttons.collapse formId="div_add_okpd2"/>
            </x-slot>
        </form>
    </x-forms.main>
    <script>
        $('#code, #name').suggestions({
            token: $('#dadata_token').val(),
            type: 'okpd2',
            onSelect: function(suggestion) {
                $('#code').val(suggestion.data.kod);
                $('#name').val(suggestion.data.name);
            },
        });
    </script>
@endsection
