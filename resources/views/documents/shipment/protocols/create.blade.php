@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.shipment.protocols.titles.create')}}"
                  back="{{route('protocols.index')}}">
        <form id="form_add_protocol"
              method="POST"
              action="{{route('protocols.store')}}">
            @csrf
            <input type="hidden"
                   name="packing_list_id"
                   value="{{$packingListId}}">
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
                           value="{{old('number')}}"
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
                           value="{{old('date')}}"
                           required>
                    <x-forms.span-error name="date"/>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <x-buttons.save formId="form_add_protocol"/>
        </x-slot>
    </x-forms.main>
@endsection
