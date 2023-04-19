@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('invoices_for_payment.index')}}"
                  title="
                  {{__('documents.invoices_for_payment.invoice_for_payment')
                    . ' №'
                    . $invoiceForPayment->number
                    . ' '
                    . $invoiceForPayment->date}}
                  ">
        <x-forms.collapse.card
            route="{{route('invoices_for_payment.update', ['invoice_for_payment' => $invoiceForPayment->id])}}"
            cardId="card_main_info"
            formId="form_main_info"
            title="{{__('documents.header')}}">
            <x-slot name="cardBody">
                <input type="hidden"
                       name="id"
                       value="{{$invoiceForPayment->id}}">
                <div class="row mb-2">
                    <label for="number"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.number')}}
                    </label>
                    <div class="col-md-6">
                        <input id="number"
                               type="text"
                               name="number"
                               class="form-control form-control-sm text-primary
                           @error('number') is-invalid @enderror"
                               value="{{$invoiceForPayment->number}}"
                               required>
                        <x-forms.span-error name="number"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="date"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.date')}}
                    </label>
                    <div class="col-md-6">
                        <input id="date"
                               type="date"
                               name="date"
                               class="form-control form-control-sm text-primary
                           @error('date') is-invalid @enderror"
                               value="{{Carbon::create($invoiceForPayment->date)->format('Y-m-d')}}"
                               required>
                        <x-forms.span-error name="date"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="organization_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.organization_id')}}
                    </label>
                    <div class="col-md-6 p-2">
                        <span class="text-primary align-middle">
                            {{$invoiceForPayment->organization->legalForm->abbreviation}} {{$invoiceForPayment->organization->name}}
                        </span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="organization_place_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.organization_place_id')}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control form-control-sm text-primary
                            @error('organization_place_id') is-invalid @enderror"
                                id="organization_place_id"
                                name="organization_place_id">
                            @foreach($invoiceForPayment->organization->placesOfBusiness as $place)
                                <option value="{{$place->id}}"
                                        @if($invoiceForPayment->organizationPlaceOfBusiness->id === $place->id)
                                            selected
                                    @endif>
                                    {{$place->address}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="organization_place_id"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="organization_bank_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.organization_bank_id')}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control form-control-sm text-primary
                            @error('organization_bank_id') is-invalid @enderror"
                                id="organization_bank_id"
                                name="organization_bank_id">
                            @foreach($invoiceForPayment->organization->bankAccountDetails as $accountDetail)
                                <option value="{{$accountDetail->id}}"
                                        @if($invoiceForPayment->organizationBankAccountDetail->id === $accountDetail->id)
                                            selected
                                    @endif>
                                    {{$accountDetail->bankClassifier->name}} - {{$accountDetail->payment_account}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="organization_bank_id"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="contractor_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.contractor_id')}}
                    </label>
                    <div class="col-md-6 p-2">
                        <span class="text-primary align-middle">
                            {{$invoiceForPayment->contractor->legalForm->abbreviation}} {{$invoiceForPayment->contractor->name}}
                        </span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="contractor_place_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.contractor_place_id')}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control form-control-sm text-primary
                            @error('contractor_place_id') is-invalid @enderror"
                                id="contractor_place_id"
                                name="contractor_place_id">
                            @foreach($invoiceForPayment->contractor->placesOfBusiness as $place)
                                <option value="{{$place->id}}"
                                        @if($invoiceForPayment->contractorPlaceOfBusiness->id === $place->id)
                                            selected
                                    @endif>
                                    {{$place->address}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="contractor_place_id"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="organization_contractor_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.contractor_bank_id')}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control form-control-sm text-primary
                            @error('contractor_bank_id') is-invalid @enderror"
                                id="contractor_bank_id"
                                name="contractor_bank_id">
                            @foreach($invoiceForPayment->contractor->bankAccountDetails as $accountDetail)
                                <option value="{{$accountDetail->id}}"
                                        @if($invoiceForPayment->contractorBankAccountDetail->id === $accountDetail->id)
                                            selected
                                    @endif>
                                    {{$accountDetail->bankClassifier->name}} - {{$accountDetail->payment_account}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="contractor_bank_id"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="director"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.director')}}
                    </label>
                    <div class="col-md-6">
                        <input id="director"
                               type="text"
                               name="director"
                               class="form-control form-control-sm text-primary
                           @error('director') is-invalid @enderror"
                               value="{{$invoiceForPayment->director}}"
                               required>
                        <x-forms.span-error name="director"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for=""
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.bookkeeper')}}
                    </label>
                    <div class="col-md-6">
                        <input id="bookkeeper"
                               type="text"
                               name="bookkeeper"
                               class="form-control form-control-sm text-primary
                           @error('bookkeeper') is-invalid @enderror"
                               value="{{$invoiceForPayment->bookkeeper}}"
                               required>
                        <x-forms.span-error name="bookkeeper"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for=""
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.invoices_for_payment.filename')}}
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
                            @if($invoiceForPayment->filename)
                                <li class="list-inline-item">
                                    <a href="{{Storage::url($invoiceForPayment->filename)}}"
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
                            {{$invoiceForPayment->updated_at}}
                        </small>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{$invoiceForPayment->user->name}}
                        </small>
                    </li>
                </ul>
            </x-slot>
        </x-forms.collapse.card>
        @include('documents.invoices-for-payment.data.products.edit')
    </x-forms.main>
@endsection
