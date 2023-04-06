@extends('layouts.app')
@section('content')
    <div id="div_add_legal_form"
         class="@if ($errors->has('legal_form.*')) collapsed @else collapse @endif mb-2">
        <x-forms.main title="{{__('form.titles.add')}}"
                      withAlert="{{false}}">
            <form id="form_add_legal_form"
                  method="POST"
                  action="{{route('legal_forms.store')}}">
                @csrf
                <div class="row mb-2">
                    <label for="abbrebiation"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.legal_forms.abbreviation')}}
                    </label>
                    <div class="col-md">
                        <input id="abbreviation"
                               type="text"
                               class="form-control form-control-sm
                               @error('legal_form.abbreviation') is-invalid @enderror"
                               name="legal_form[abbreviation]"
                               value="{{ old('legal_form[abbreviation]') }}"
                               required>
                        @error('legal_form.abbreviation')
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
                    <label for="decoding"
                           class="col-md-2 col-form-label text-md-end">
                        {{__('classifiers.legal_forms.decoding')}}
                    </label>
                    <div class="col-md">
                        <input id="decoding"
                               type="text"
                               class="form-control form-control-sm
                               @error('legal_form.decoding') is-invalid @enderror"
                               name="legal_form[decoding]"
                               value="{{ old('legal_form.decoding') }}">
                        @error('legal_form.decoding')
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
                    <x-buttons.save formId="form_add_legal_form"/>
                </x-slot>
            </form>
        </x-forms.main>
    </div>
    <x-forms.main title="{{__('classifiers.legal_forms.legal_forms')}}">
        <form id="form_legal_forms"
              method="POST"
              action="{{route('legal_forms.update', ['legal_form' => $legalForms->first()->abbreviation ?? 'ООО'])}}">
            @method('PATCH')
            @csrf
            <x-tables.main id="table_legal_forms"
                           domOrderType="{{true}}">
                <thead class="bg-secondary">
                <tr class="text-primary">
                    <th scope="col"
                        class="text-center col-md-2">
                        {{__('classifiers.legal_forms.abbreviation')}}
                    </th>
                    <th scope="col"
                        class="text-center col-md">
                        {{__('classifiers.legal_forms.decoding')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($legalForms as $key => $legalForm)
                    <tr>
                        <td class="align-middle col-md-2">
                            <span class="d-none">
                                {{$legalForm->abbreviation}}
                            </span>
                            <input type="hidden"
                                   name="legal_forms[{{$key}}][original_abbreviation]"
                                   value="{{$legalForm->abbreviation}}">
                            <input type="text"
                                   id="abbreviation-{{$key}}"
                                   name="legal_forms[{{$key}}][abbreviation]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                    @error('legal_forms.' . $key . '.abbreviation') is-invalid @enderror"
                                   value="{{$legalForm->abbreviation}}"
                                   required>
                            @error('legal_forms.' . $key . '.abbreviation')
                            <span class="invalid-feedback"
                                  role="alert">
                            <strong>
                                {{$message}}
                            </strong>
                            </span>
                            @enderror
                        </td>
                        <td class="align-middle col-md">
                            <span class="d-none">{{$legalForm->decoding}}</span>
                            <input type="text"
                                   id="decoding-{{$key}}"
                                   name="legal_forms[{{$key}}][decoding]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                    @error('legal_forms.' . $key . '.decoding') is-invalid @enderror"
                                   value="{{$legalForm->decoding}}">
                            @error('legal_forms.' . $key . '.decoding')
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
                <x-buttons.save formId="form_legal_forms"/>
                <x-buttons.collapse formId="div_add_legal_form"/>
            </x-slot>
        </form>
    </x-forms.main>
@endsection
