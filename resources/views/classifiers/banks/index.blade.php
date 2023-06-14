@extends('layouts.app')
@section('content')
    <x-forms.dadata-token/>
    <div id="div_add_bank"
         class="@if ($errors->has('bank.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_bank"
                  method="POST"
                  action="{{route('banks.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="name"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.banks.name')}}
                    </label>
                    <div class="col-md">
                        <input id="name"
                               type="text"
                               class="form-control form-control-sm
                               @error('bank.name') is-invalid @enderror"
                               name="bank[name]"
                               value="{{ old('bank[name]') }}"
                               required>
                        @error('bank.name')
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
                    <label for="BIC"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.banks.BIC')}}
                    </label>
                    <div class="col-md">
                        <input id="BIC"
                               type="text"
                               class="form-control form-control-sm
                               @error('bank.BIC') is-invalid @enderror"
                               name="bank[BIC]"
                               value="{{ old('bank[BIC]') }}"
                               required>
                        @error('bank.BIC')
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
                    <label for="correspondent_account"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.banks.correspondent_account')}}
                    </label>
                    <div class="col-md">
                        <input id="correspondent_account"
                               type="text"
                               class="form-control form-control-sm
                               @error('bank.correspondent_account') is-invalid @enderror"
                               name="bank[correspondent_account]"
                               value="{{ old('bank[correspondent_account]') }}"
                               required>
                        @error('bank.correspondent_account')
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
                    <x-buttons.save formId="form_add_bank"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.banks.banks')}}">
        <form id="form_banks"
              method="POST"
              action="{{route('banks.update', ['bank' => $banks->first()->BIC ?? '044525196'])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_banks"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center">
                        {{__('classifiers.banks.name')}}
                    </th>
                    <th scope="col"
                        class="text-center col-md-2">
                        {{__('classifiers.banks.BIC')}}
                    </th>
                    <th scope="col"
                        class="text-center col-md-3">
                        {{__('classifiers.banks.correspondent_account')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($banks as $key => $bank)
                    <tr>
                        <td class="align-middle text-center">
                            <span class="d-none">
                                {{$bank->name}}
                            </span>
                            <input type="text"
                                   id="name-{{$key}}"
                                   name="banks[{{$key}}][name]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('name.' . $key . '.BIC') is-invalid @enderror"
                                   value="{{$bank->name}}"
                                   required>
                            @error('banks.' . $key . '.name')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </td>
                        <td class="align-middle text-center col-md-2">
                            <span class="d-none">
                                {{$bank->BIC}}
                            </span>
                            <input type="hidden"
                                   name="banks[{{$key}}][original_BIC]"
                                   value="{{$bank->BIC}}">
                            <input type="text"
                                   id="BIC-{{$key}}"
                                   name="banks[{{$key}}][BIC]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('banks.' . $key . '.BIC') is-invalid @enderror"
                                   value="{{$bank->BIC}}"
                                   required>
                            @error('banks.' . $key . '.BIC')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </td>
                        <td class="align-middle text-center col-md-3">
                            <span class="d-none">
                                {{$bank->correspondent_account}}
                            </span>
                            <input type="text"
                                   id="correspondent_account-{{$key}}"
                                   name="banks[{{$key}}][correspondent_account]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('name.' . $key . '.correspondent_account') is-invalid @enderror"
                                   value="{{$bank->correspondent_account}}"
                                   required>
                            @error('banks.' . $key . '.correspondent_account')
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
                <x-buttons.save formId="form_banks"/>
                <x-buttons.collapse formId="div_add_bank"/>
            </x-slot>
        </form>
    </x-forms.main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('#name, #BIC').suggestions({
                token: $('#dadata_token').val(),
                type: 'BANK',
                onSelect: function(suggestion) {
                    $('#name').val(suggestion.value);
                    $('#BIC').val(suggestion.data.bic);
                    $('#correspondent_account').val(suggestion.data.correspondent_account);
                },
            });
        });
    </script>
@endsection
