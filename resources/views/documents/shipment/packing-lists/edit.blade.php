@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('packing_lists.index')}}"
                  title="
                  {{__('documents.shipment.packing_lists.packing_list')
                    . ' №'
                    . $packingList->number
                    . ' '
                    . $packingList->date}}
                  ">
        <x-forms.collapse.card
            route="{{route('packing_lists.update', ['packing_list' => $packingList->id])}}"
            cardId="card_main_info"
            formId="form_main_info"
            title="{{__('documents.header')}}">
            <x-slot name="cardBody">
                <input type="hidden"
                       name="packing_list_id"
                       value="{{$packingList->id}}">
                <div class="row mb-2">
                    <label for="number"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.number')}}
                    </label>
                    <div class="col-md-6">
                        <input id="number"
                               type="text"
                               name="number"
                               class="form-control form-control-sm text-primary
                           @error('number') is-invalid @enderror"
                               value="{{$packingList->number}}"
                               required>
                        <x-forms.span-error name="number"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="date"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.date')}}
                    </label>
                    <div class="col-md-6">
                        <input id="date"
                               type="date"
                               name="date"
                               class="form-control form-control-sm text-primary
                           @error('date') is-invalid @enderror"
                               value="{{Carbon::create($packingList->date)->format('Y-m-d')}}"
                               required>
                        <x-forms.span-error name="date"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="organization_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.organization_id')}}
                    </label>
                    <div class="col-md-6 p-2">
                        <span class="text-primary align-middle">
                            {{$packingList->organization->legalForm->abbreviation}} {{$packingList->organization->name}}
                        </span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="organization_place_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.organization_place_id')}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control form-control-sm text-primary
                            @error('organization_place_id') is-invalid @enderror"
                                id="organization_place_id"
                                name="organization_place_id">
                            @foreach($packingList->organization->placesOfBusiness as $place)
                                <option value="{{$place->id}}"
                                        @if($packingList->organizationPlaceOfBusiness->id === $place->id)
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
                        {{__('documents.shipment.organization_bank_id')}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control form-control-sm text-primary
                            @error('organization_bank_id') is-invalid @enderror"
                                id="organization_bank_id"
                                name="organization_bank_id">
                            @foreach($packingList->organization->bankAccountDetails as $accountDetail)
                                <option value="{{$accountDetail->id}}"
                                        @if($packingList->organizationBankAccountDetail->id === $accountDetail->id)
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
                            {{$packingList->contractor->legalForm->abbreviation}} {{$packingList->contractor->name}}
                        </span>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="contractor_place_id"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.contractor_place_id')}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control form-control-sm text-primary
                            @error('contractor_place_id') is-invalid @enderror"
                                id="contractor_place_id"
                                name="contractor_place_id">
                            @foreach($packingList->contractor->placesOfBusiness as $place)
                                <option value="{{$place->id}}"
                                        @if($packingList->contractorPlaceOfBusiness->id === $place->id)
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
                        {{__('documents.shipment.contractor_bank_id')}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control form-control-sm text-primary
                            @error('contractor_bank_id') is-invalid @enderror"
                                id="contractor_bank_id"
                                name="contractor_bank_id">
                            @foreach($packingList->contractor->bankAccountDetails as $accountDetail)
                                <option value="{{$accountDetail->id}}"
                                        @if($packingList->contractorBankAccountDetail->id === $accountDetail->id)
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
                        {{__('documents.shipment.director')}}
                    </label>
                    <div class="col-md-6">
                        <input id="director"
                               type="text"
                               name="director"
                               class="form-control form-control-sm text-primary
                           @error('director') is-invalid @enderror"
                               value="{{$packingList->director}}">
                        <x-forms.span-error name="director"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for=""
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.bookkeeper')}}
                    </label>
                    <div class="col-md-6">
                        <input id="bookkeeper"
                               type="text"
                               name="bookkeeper"
                               class="form-control form-control-sm text-primary
                           @error('bookkeeper') is-invalid @enderror"
                               value="{{$packingList->bookkeeper}}">
                        <x-forms.span-error name="bookkeeper"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for=""
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.storekeeper')}}
                    </label>
                    <div class="col-md-6">
                        <input id="storekeeper"
                               type="text"
                               name="storekeeper"
                               class="form-control form-control-sm text-primary
                           @error('store') is-invalid @enderror"
                               value="{{$packingList->storekeeper}}">
                        <x-forms.span-error name="storekeeper"/>
                    </div>
                </div>
                @if ($packingList->approved !== null)
                    <div class="row mb-2">
                        <label for=""
                               class="col-md-4 col-form-label text-md-end">
                            {{__('documents.shipment.approved')}}
                        </label>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <span
                                    class="input-group-text text-center align-middle bg-transparent fw-bold border-0">
                                @if($packingList->approved)
                                        <i class="bi bi-shield-check text-success" style="font-size: 1.5em"></i>
                                    @else
                                        <i class="bi bi-shield-exclamation text-danger" style="font-size: 1.5em"></i>
                                    @endif
                                </span>
                                <span class="input-group-text text-primary text-center align-middle bg-transparent border-0">
                                    {{$packingList->approvedBy->name}}
                                </span>
                                <span class="input-group-text text-primary text-center align-middle bg-transparent border-0">
                                    {{$packingList->approved_at}}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$packingList->approved && $packingList->approved !== null)
                    <div class="row mb-2">
                        <label for=""
                               class="col-md-4 col-form-label text-md-end">
                            {{__('documents.shipment.comment')}}
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control form-control-sm fw-bolder text-danger bg-transparent"
                                      placeholder="{{__('documents.shipment.comment')}}" rows="1"
                                      disabled>{{trim($packingList->comment)}}</textarea>
                        </div>

                    </div>
                @endif
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
                            {{$packingList->updated_at}}
                        </small>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{$packingList->updatedBy->name}}
                        </small>
                    </li>
                </ul>
            </x-slot>
        </x-forms.collapse.card>
        @include('documents.shipment.packing-lists.data.products.edit')
    </x-forms.main>
@endsection
