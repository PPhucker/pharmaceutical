@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.invoices_for_payment.titles.create')}}"
                  back="{{route('contractors.index')}}">
        <form id="form_add_invoice_for_payment"
              method="POST"
              action="{{route('invoices_for_payment.store')}}">
            @csrf
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
                           value="{{old('number')}}"
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
                           value="{{old('date')}}"
                           required>
                    <x-forms.span-error name="date"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="organization_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.invoices_for_payment.organization_id')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('organization_id') is-invalid @enderror"
                            id="organization_id"
                            name="organization_id">
                        <option selected disabled></option>
                        @foreach($organizations as $organization)
                            <option value="{{$organization->id}}">
                                {{$organization->legalForm->abbreviation}} {{$organization->name}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="organization_id"/>
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
                    </select>
                    <x-forms.span-error name="organization_bank_id"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="contractor_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.invoices_for_payment.contractor_id')}}
                </label>
                <div class="col-md-6">
                    <input type="hidden"
                           id="contractor_id"
                           name="contractor_id"
                           value="{{$contractor->id}}">
                    <span class="form-control form-control-sm text-primary border-0 bg-transparent">
                        {{$contractor->legalForm->abbreviation}} {{$contractor->name}}
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
                        @foreach($contractor->placesOfBusiness as $place)
                            <option value="{{$place->id}}">
                                {{$place->address}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="contractor_place_id"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="contractor_bank_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.invoices_for_payment.contractor_bank_id')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('contractor_bank_id') is-invalid @enderror"
                            id="contractor_bank_id"
                            name="contractor_bank_id">
                        @foreach($contractor->bankAccountDetails as $accountDetail)
                            <option value="{{$accountDetail->id}}">
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
                           value="{{old('director')}}"
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
                           value="{{old('bookkeeper')}}"
                           required>
                    <x-forms.span-error name="bookkeeper"/>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <x-buttons.save formId="form_add_invoice_for_payment"/>
        </x-slot>
    </x-forms.main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('organization_id').addEventListener('change', async function(e) {
                const url = '/admin/organizations/' + e.target.value;
                const response = await fetch(url);

                if (response.ok) {
                    const data = (await response.json()).organization;
                    const selectPlaces = document.getElementById('organization_place_id');

                    selectPlaces.innerHTML = '';

                    const emptyOption = selectPlaces.appendChild(document.createElement('option'));
                    emptyOption.selected = true;
                    emptyOption.disabled = true;

                    for (const place of data.places_of_business) {
                        const option = document.createElement('option');
                        option.value = place.id;
                        option.innerText = place.address;
                        selectPlaces.appendChild(option);
                    }

                    const selectBankAccountDetails = document.getElementById('organization_bank_id');

                    selectBankAccountDetails.innerHTML = '';

                    for (const bank of data.bank_account_details) {
                        const option = document.createElement('option');
                        option.value = bank.id;
                        option.innerText = bank.bank_classifier.name + ' - ' + bank.payment_account;
                        selectBankAccountDetails.appendChild(option);
                    }

                } else {
                    alert('Ошибка HTTP: ' + response.status);
                }
            });
            document.getElementById('organization_place_id').addEventListener('change', async function(e) {
                const url = '/admin/organizations/places_of_business/staff/' + e.target.value;
                const response = await fetch(url);

                if (response.ok) {
                    const data = (await response.json())[0];
                    document.getElementById('director').value = data.director;
                    document.getElementById('bookkeeper').value = data.bookkeeper;
                } else {
                    alert('Ошибка HTTP: ' + response.status);
                }
            });
        });
    </script>
@endsection
