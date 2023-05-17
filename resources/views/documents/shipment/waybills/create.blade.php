@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.shipment.waybills.titles.create')}}"
                  back="{{route('waybills.index')}}">
        <form id="form_add_waybill"
              method="POST"
              action="{{route('waybills.store')}}">
            @csrf
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
                        <option value="standard">
                            {{__('documents.shipment.waybills.licence_card.standard')}}
                        </option>
                        <option value="limited">
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
                        <option value="automotive">
                            {{__('documents.shipment.waybills.type_of_transportation.automotive')}}
                        </option>
                        <option value="manual_movement">
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
                       @foreach($packingList->organization->cars as $car)
                           <option value="{{$car->car_model}} - {{$car->state_number}}">
                               {{$car->car_model}} - {{$car->state_number}}
                           </option>
                       @endforeach
                           @foreach($packingList->contractor->cars as $car)
                               <option value="{{$car->car_model}} - {{$car->state_number}}">
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
                        @foreach($packingList->organization->drivers as $driver)
                            <option value="{{$driver->name}}">
                                {{$driver->name}}
                            </option>
                        @endforeach
                        @foreach($packingList->contractor->drivers as $driver)
                            <option value="{{$driver->name}}">
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
                        @foreach($packingList->organization->trailers as $trailer)
                            <option value="{{$trailer->type - $trailer->state_number}}">
                                {{$trailer->type - $trailer->state_number}}
                            </option>
                        @endforeach
                        @foreach($packingList->contractor->trailers as $trailer)
                            <option value="{{$trailer->type - $trailer->state_number}}">
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
                        @foreach($packingList->organization->trailers as $trailer)
                            <option value="{{$trailer->type - $trailer->state_number}}">
                                {{$trailer->type - $trailer->state_number}}
                            </option>
                        @endforeach
                        @foreach($packingList->contractor->trailers as $trailer)
                            <option value="{{$trailer->type - $trailer->state_number}}">
                                {{$trailer->type - $trailer->state_number}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="second_trailer"/>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <x-buttons.save formId="form_add_waybill"/>
        </x-slot>
    </x-forms.main>
@endsection
