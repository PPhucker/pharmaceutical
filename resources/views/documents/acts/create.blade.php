@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.acts.titles.create')}}"
                  back="{{route('acts.index')}}">
        <form id="form_add_act"
              method="POST"
              action="{{route('acts.store')}}">
            @csrf
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
                           value="{{old('number')}}"
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
                           value="{{old('date')}}"
                           required>
                    <x-forms.span-error name="date"/>
                </div>
            </div>
            <div class="row mb-2">
                <label for="organization_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.acts.organization_id')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('organization_id') is-invalid @enderror"
                            id="organization_id"
                            name="organization_id">
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
                <label for="contractor_id"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('documents.acts.contractor_id')}}
                </label>
                <div class="col-md-6">
                    <select class="form-control form-control-sm text-primary
                            @error('organization_id') is-invalid @enderror"
                            id="contractor_id"
                            name="contractor_id">
                        @foreach($organizations as $organization)
                            <option value="{{$organization->id}}">
                                {{$organization->legalForm->abbreviation}} {{$organization->name}}
                            </option>
                        @endforeach
                    </select>
                    <x-forms.span-error name="contractor_id"/>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <x-buttons.save formId="form_add_act"/>
        </x-slot>
    </x-forms.main>
@endsection
