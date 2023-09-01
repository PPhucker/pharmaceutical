@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('waybills.index')}}"
                  title="
                  {{__('documents.shipment.waybills.waybill')
                    . ' №'
                    . $waybill->number
                    . ' '
                    . $waybill->date}}
                  ">
        <x-forms.collapse.card
            route="{{route('waybills.update', ['waybill' => $waybill->id])}}"
            cardId="card_approval"
            formId="form_approval"
            title="{{__('documents.header')}}">
            <x-slot name="cardBody">
                <input type="hidden"
                       name="document_id"
                       value="{{$waybill->id}}">
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
                               value="{{$waybill->number}}"
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
                               value="{{Carbon::create($waybill->date)->format('Y-m-d')}}"
                               required>
                        <x-forms.span-error name="date"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="licence_card"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.waybills.licence_card.licence_card')}}
                    </label>
                    <div class="col-md-6">
                        <select id="licence_card"
                                name="licence_card"
                                class="form-control form-control-sm text-primary
                            @error('licence_card') is-invalid @enderror"
                                required>
                            <option value="standard"
                                    @if($waybill->licence_card === 'standard') selected @endif>
                                {{__('documents.shipment.waybills.licence_card.standard')}}
                            </option>
                            <option value="limited"
                                    @if($waybill->licence_card === 'limited') selected @endif>
                                {{__('documents.shipment.waybills.licence_card.limited')}}
                            </option>
                        </select>
                        <x-forms.span-error name="licence_card"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="licence_card"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.waybills.type_of_transportation.type_of_transportation')}}
                    </label>
                    <div class="col-md-6">
                        <select id="type_of_transportation"
                                name="type_of_transportation"
                                class="form-control form-control-sm text-primary
                            @error('type_of_transportation') is-invalid @enderror"
                                required>
                            <option value="automotive"
                                    @if($waybill->type_of_transportation === 'automotive') selected @endif>
                                {{__('documents.shipment.waybills.type_of_transportation.automotive')}}
                            </option>
                            <option value="manual_movement"
                                    @if($waybill->type_of_transportation === 'manual_movement') selected @endif>
                                {{__('documents.shipment.waybills.type_of_transportation.manual_movement')}}
                            </option>
                        </select>
                        <x-forms.span-error name="type_of_transportation"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="card"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.waybills.car_model')}}
                    </label>
                    <div class="col-md-6">
                        <select id="car"
                                name="car"
                                class="form-control form-control-sm text-primary
                            @error('car') is-invalid @enderror"
                                required>
                            <option value="{{null}}">

                            </option>
                            @foreach($waybill->packingList->organization->cars as $car)
                                <option value="{{$car->car_model}} - {{$car->state_number}}"
                                        @if($waybill->car_model === $car->car_model) selected @endif>
                                    {{$car->car_model}} - {{$car->state_number}}
                                </option>
                            @endforeach
                            @foreach($waybill->packingList->contractor->cars as $car)
                                <option value="{{$car->car_model}} - {{$car->state_number}}"
                                        @if($waybill->car_model === $car->car_model) selected @endif>
                                    {{$car->car_model}} - {{$car->state_number}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="car"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="card"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.waybills.driver')}}
                    </label>
                    <div class="col-md-6">
                        <select id="driver"
                                name="driver"
                                class="form-control form-control-sm text-primary
                            @error('driver') is-invalid @enderror"
                                required>
                            <option value="{{null}}">

                            </option>
                            @foreach($waybill->packingList->organization->drivers as $driver)
                                <option value="{{$driver->name}}"
                                        @if($waybill->driver === $driver->name) selected @endif>
                                    {{$driver->name}}
                                </option>
                            @endforeach
                            @foreach($waybill->packingList->contractor->drivers as $driver)
                                <option value="{{$driver->name}}"
                                        @if($waybill->driver === $driver->name) selected @endif>
                                    {{$driver->name}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="driver"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="card"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.waybills.trailer')}}
                    </label>
                    <div class="col-md-6">
                        <select id="first_trailer"
                                name="first_trailer"
                                class="form-control form-control-sm text-primary
                            @error('first_trailer') is-invalid @enderror"
                                required>
                            <option value="{{null}}"></option>
                            @foreach($waybill->packingList->organization->trailers as $trailer)
                                <option value="{{$trailer->type - $trailer->state_number}}"
                                        @if($waybill->trailer_1 === $trailer->type && $waybill->state_trailer_1_number === $trailer->state_number) selected @endif>
                                    {{$trailer->type - $trailer->state_number}}
                                </option>
                            @endforeach
                            @foreach($waybill->packingList->contractor->trailers as $trailer)
                                <option value="{{$trailer->type - $trailer->state_number}}"
                                        @if($waybill->trailer_1 === $trailer->type && $waybill->state_trailer_1_number === $trailer->state_number) selected @endif>
                                    {{$trailer->type - $trailer->state_number}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="first_trailer"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="card"
                           class="col-md-4 col-form-label text-md-end">
                        {{__('documents.shipment.waybills.trailer')}}
                    </label>
                    <div class="col-md-6">
                        <select id="second_trailer"
                                name="second_trailer"
                                class="form-control form-control-sm text-primary
                            @error('second_trailer') is-invalid @enderror"
                                required>
                            <option value="{{null}}"></option>
                            @foreach($waybill->packingList->organization->trailers as $trailer)
                                <option value="{{$trailer->type - $trailer->state_number}}"
                                        @if($waybill->trailer_2 === $trailer->type && $waybill->state_trailer_2_number === $trailer->state_number) selected @endif>
                                    {{$trailer->type - $trailer->state_number}}
                                </option>
                            @endforeach
                            @foreach($waybill->packingList->contractor->trailers as $trailer)
                                <option value="{{$trailer->type - $trailer->state_number}}"
                                        @if($waybill->trailer_2 === $trailer->type && $waybill->state_trailer_2_number === $trailer->state_number) selected @endif>
                                    {{$trailer->type - $trailer->state_number}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="second_trailer"/>
                    </div>
                </div>
                @if ($waybill->approved !== null)
                    <div class="row mb-2">
                        <label for=""
                               class="col-md-4 col-form-label text-md-end">
                            {{__('documents.shipment.approved')}}
                        </label>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <span
                                    class="input-group-text text-center align-middle bg-transparent fw-bold border-0">
                                @if($waybill->approved)
                                        <i class="bi bi-shield-check text-success" style="font-size: 1.5em"></i>
                                    @else
                                        <i class="bi bi-shield-exclamation text-danger" style="font-size: 1.5em"></i>
                                    @endif
                                </span>
                                <span
                                    class="input-group-text text-primary text-center align-middle bg-transparent border-0">
                                    {{$waybill->approvedBy->name}}
                                </span>
                                <span
                                    class="input-group-text text-primary text-center align-middle bg-transparent border-0">
                                    {{$waybill->approved_at}}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$waybill->approved && $waybill->approved !== null)
                    <div class="row mb-2">
                        <label for=""
                               class="col-md-4 col-form-label text-md-end">
                            {{__('documents.shipment.comment')}}
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control form-control-sm fw-bolder text-danger bg-transparent"
                                      placeholder="{{__('documents.shipment.comment')}}" rows="1"
                                      disabled>{{trim($waybill->comment)}}</textarea>
                        </div>
                    </div>
                @endif
            </x-slot>
            <x-slot name="footer">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item text-md-end">
                        <x-buttons.save formId="form_approval"/>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{__('form.last_updated')}}:
                        </small>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{$waybill->updated_at}}
                        </small>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{$waybill->updatedBy->name}}
                        </small>
                    </li>
                </ul>
            </x-slot>
        </x-forms.collapse.card>
        @if($data)
            <x-forms.document back="{{route('waybills.index')}}"
                              title="
                  {{__('documents.shipment.waybills.waybill')
                    . ' №'
                    . $waybill->number
                    . ' '
                    . $waybill->date}}
                  ">
                @permissions(['approve_shipment_documents'])
                <x-slot name="approval">
                    <x-forms.collapse.card
                        route="{{route('waybills.approve', ['waybill' => $waybill->id])}}"
                        cardId="card_main_info"
                        formId="form_main_info"
                        title="{{__('documents.shipment.approval.approval')}}">
                        <x-slot name="cardBody">
                            <div class="row mb-2">
                                <label for="approved"
                                       class="col-md-4 col-form-label text-md-end">
                                    {{__('documents.shipment.approved')}}
                                </label>
                                <div class="col-md-6 pt-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="approved"
                                               value="1" @if($waybill->approved === 1) checked @endif>
                                        <label class="form-check-label">
                                            {{__('form.yes')}}
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="approved"
                                               value="0" @if($waybill->approved === 0) checked @endif>
                                        <label class="form-check-label">
                                            {{__('form.no')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="approved"
                                       class="col-md-4 col-form-label text-md-end">
                                    {{__('documents.shipment.comment')}}
                                </label>
                                <div class="col-md-6">
                                    <textarea name="comment"
                                              class="form-control form-control-sm text-primary">{{$waybill->comment}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="filename"
                                       class="col-md-4 col-form-label text-md-end">
                                    {{__('documents.shipment.filename')}}
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
                                        @if($waybill->filename)
                                            <li class="list-inline-item">
                                                <a href="{{Storage::url($waybill->filename)}}"
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
                                @if($waybill->approved)
                                    <li class="list-inline-item text-primary">
                                        <small>
                                            {{__('documents.shipment.approval.approved')}}:
                                        </small>
                                    </li>
                                    <li class="list-inline-item text-primary">
                                        <small>
                                            {{$waybill->approved_at}}
                                        </small>
                                    </li>
                                    <li class="list-inline-item text-primary">
                                        <small>
                                            {{$waybill->approvedBy->name}}
                                        </small>
                                    </li>
                                @endif
                            </ul>
                        </x-slot>
                    </x-forms.collapse.card>
                </x-slot>
                @end_permissions
                @include('templates.documents.shipment.waybill.main')
            </x-forms.document>
        @endif
    </x-forms.main>
@endsection
