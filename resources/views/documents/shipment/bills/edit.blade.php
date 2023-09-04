@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('bills.index')}}"
                  title={{$title}}>
        @if($data)
            <x-forms.document title="{{$title}}">
                @permissions(['approve_shipment_documents'])
                <x-slot name="approval">
                    <x-forms.collapse.card
                        route="{{route('bills.approve', ['bill' => $bill->id])}}"
                        cardId="card_approval"
                        formId="form_approval"
                        title="{{__('documents.shipment.approval.approval')}}">
                        <x-slot name="cardBody">
                            <input type="hidden"
                                   name="bill_id"
                                   value="{{$bill->id}}">
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
                                               value="1" @if($bill->approved === 1) checked @endif>
                                        <label class="form-check-label">
                                            {{__('form.yes')}}
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="approved"
                                               value="0" @if($bill->approved === 0) checked @endif>
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
                                      class="form-control form-control-sm text-primary">{{$bill->comment}}</textarea>
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
                                    <x-buttons.save formId="form_approval"/>
                                </li>
                                @if($bill->approved)
                                    <li class="list-inline-item text-primary">
                                        <small>
                                            {{__('documents.shipment.approval.approved')}}:
                                        </small>
                                    </li>
                                    <li class="list-inline-item text-primary">
                                        <small>
                                            {{$bill->approved_at}}
                                        </small>
                                    </li>
                                    <li class="list-inline-item text-primary">
                                        <small>
                                            {{$bill->approvedBy->name}}
                                        </small>
                                    </li>
                                @endif
                            </ul>
                        </x-slot>
                    </x-forms.collapse.card>
                </x-slot>
                @end_permissions
                @include('templates.documents.shipment.bill.main')
            </x-forms.document>
        @endif
        @roles(['marketing', 'bookkeeping'])
        <x-forms.collapse.card
            route="{{route('bills.update', ['bill' => $bill->id])}}"
            cardId="card_main_info"
            formId="form_main_info"
            title="{{__('documents.header')}}">
            <x-slot name="cardBody">
                <input type="hidden"
                       value="{{$bill->id}}"
                       name="document_id">
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
                @if ($bill->approved !== null)
                    <div class="row mb-2">
                        <label for=""
                               class="col-md-4 col-form-label text-md-end">
                            {{__('documents.shipment.approved')}}
                        </label>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <span
                                    class="input-group-text text-center align-middle bg-transparent fw-bold border-0">
                                @if($bill->approved)
                                        <i class="bi bi-shield-check text-success" style="font-size: 1.5em"></i>
                                    @else
                                        <i class="bi bi-shield-exclamation text-danger" style="font-size: 1.5em"></i>
                                    @endif
                                </span>
                                <span
                                    class="input-group-text text-primary text-center align-middle bg-transparent border-0">
                                    {{$bill->approvedBy->name}}
                                </span>
                                <span
                                    class="input-group-text text-primary text-center align-middle bg-transparent border-0">
                                    {{$bill->approved_at}}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$bill->approved && $bill->approved !== null)
                    <div class="row mb-2">
                        <label for=""
                               class="col-md-4 col-form-label text-md-end">
                            {{__('documents.shipment.comment')}}
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control form-control-sm fw-bolder text-danger bg-transparent"
                                      placeholder="{{__('documents.shipment.comment')}}" rows="1"
                                      disabled>{{trim($bill->comment)}}</textarea>
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
        @end_roles
    </x-forms.main>
@endsection
