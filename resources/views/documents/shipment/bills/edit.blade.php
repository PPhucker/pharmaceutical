@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('bills.index')}}"
                  title="
                  {{__('documents.shipment.bills.bill')
                    . ' №'
                    . $bill->number
                    . ' '
                    . $bill->date}}
                  ">
        <x-forms.collapse.card
            route="{{route('bills.update', ['bill' => $bill->id])}}"
            cardId="card_main_info"
            formId="form_main_info"
            title="{{__('documents.header')}}">
            <x-slot name="cardBody">
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
                               value="{{$bill->number}}"
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
                               value="{{Carbon::create($bill->date)->format('Y-m-d')}}"
                               required>
                        <x-forms.span-error name="date"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for=""
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
                            @if($bill->filename)
                                <li class="list-inline-item">
                                    <a href="{{Storage::url($bill->filename)}}"
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
                            {{$bill->updated_at}}
                        </small>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{$bill->updatedBy->name}}
                        </small>
                    </li>
                </ul>
            </x-slot>
        </x-forms.collapse.card>
    </x-forms.main>
@endsection
