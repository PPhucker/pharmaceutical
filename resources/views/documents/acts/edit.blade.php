@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('acts.index')}}"
                  title="
                  {{__('documents.acts.act')
                    . ' №'
                    . $act->number
                    . ' '
                    . $act->date}}
                  ">
        <x-forms.collapse.card
            route="{{route('acts.update', ['act' => $act->id])}}"
            cardId="card_main_info"
            formId="form_main_info"
            title="{{__('documents.header')}}">
            <x-slot name="cardBody">
                <div class="row mb-2">
                    <label for="number"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.acts.number')}}
                    </label>
                    <div class="col-md-6">
                        <input id="number"
                               type="text"
                               name="number"
                               class="form-control form-control-sm text-primary
                           @error('number') is-invalid @enderror"
                               value="{{$act->number}}"
                               required>
                        <x-forms.span-error name="number"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="date"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.acts.date')}}
                    </label>
                    <div class="col-md-6">
                        <input id="date"
                               type="date"
                               name="date"
                               class="form-control form-control-sm text-primary
                           @error('date') is-invalid @enderror"
                               value="{{Carbon::create($act->date)->format('Y-m-d')}}"
                               required>
                        <x-forms.span-error name="date"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="organization_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.acts.organization_id')}}
                    </label>
                    <div class="col-md-6 p-2">
                        <span class="text-primary align-middle">
                            {{$act->organization->legalForm->abbreviation}} {{$act->organization->name}}
                        </span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="contractor_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.acts.contractor_id')}}
                    </label>
                    <div class="col-md-6 p-2">
                        <span class="text-primary align-middle">
                            {{$act->contractor->legalForm->abbreviation}} {{$act->contractor->name}}
                        </span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for=""
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.acts.filename')}}
                    </label>
                    <div class="col-md-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <input id="filename"
                                       type="file"
                                       name="filename"
                                       class="form-control form-control-sm text-primary
                                       @error('filename') is-invalid @enderror"
                                       value="{{old('filename')}}">
                                <x-forms.span-error name="filename"/>
                            </li>
                            @if($act->filename)
                                <li class="list-inline-item">
                                    <a href="{{Storage::url($act->filename)}}"
                                       target="_blank">
                                        {{__('form.button.show')}}
                                    </a>
                                </li>
                            @endif
                        </ul>
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
                            {{$act->updated_at}}
                        </small>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{$act->user->name}}
                        </small>
                    </li>
                </ul>
            </x-slot>
        </x-forms.collapse.card>
       {{-- @include('documents.invoices-for-payment.data.products.edit')--}}
    </x-forms.main>
@endsection
