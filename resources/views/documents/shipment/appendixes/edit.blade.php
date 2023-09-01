@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('appendixes.index')}}"
                  title="{{$title}}">
        <x-forms.collapse.card
            route="{{route('appendixes.update', ['appendix' => $appendix->id])}}"
            cardId="card_approval"
            formId="form_approval"
            title="{{__('documents.header')}}">
            <x-slot name="cardBody">
                <input name="document_id"
                       type="hidden"
                       value="{{$appendix->id}}">
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
                               value="{{$appendix->number}}"
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
                               value="{{Carbon::create($appendix->date)->format('Y-m-d')}}"
                               required>
                        <x-forms.span-error name="date"/>
                    </div>
                </div>
                @if ($appendix->approved !== null)
                    <div class="row mb-2">
                        <label for=""
                               class="col-md-4 col-form-label text-md-end">
                            {{__('documents.shipment.approved')}}
                        </label>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <span
                                    class="input-group-text text-center align-middle bg-transparent fw-bold border-0">
                                @if($appendix->approved)
                                        <i class="bi bi-shield-check text-success" style="font-size: 1.5em"></i>
                                    @else
                                        <i class="bi bi-shield-exclamation text-danger" style="font-size: 1.5em"></i>
                                    @endif
                                </span>
                                <span
                                    class="input-group-text text-primary text-center align-middle bg-transparent border-0">
                                    {{$appendix->approvedBy->name}}
                                </span>
                                <span
                                    class="input-group-text text-primary text-center align-middle bg-transparent border-0">
                                    {{$appendix->approved_at}}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$appendix->approved && $appendix->approved !== null)
                    <div class="row mb-2">
                        <label for=""
                               class="col-md-4 col-form-label text-md-end">
                            {{__('documents.shipment.comment')}}
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control form-control-sm fw-bolder text-danger bg-transparent"
                                      placeholder="{{__('documents.shipment.comment')}}" rows="1"
                                      disabled>{{trim($appendix->comment)}}</textarea>
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
                            {{$appendix->updated_at}}
                        </small>
                    </li>
                    <li class="list-inline-item text-primary">
                        <small>
                            {{$appendix->updatedBy->name}}
                        </small>
                    </li>
                </ul>
            </x-slot>
        </x-forms.collapse.card>
        @if($data)
            <x-forms.document back="{{route('appendixes.index')}}"
                              title="{{$title}}">
                @permissions(['approve_shipment_documents'])
                <x-slot name="approval">
                    <x-forms.collapse.card
                        route="{{route('appendixes.approve', ['appendix' => $appendix->id])}}"
                        cardId="card_approval"
                        formId="form_approval"
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
                                               value="1" @if($appendix->approved === 1) checked @endif>
                                        <label class="form-check-label">
                                            {{__('form.yes')}}
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="approved"
                                               value="0" @if($appendix->approved === 0) checked @endif>
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
                                          class="form-control form-control-sm text-primary">{{$appendix->comment}}</textarea>
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
                                        @if($appendix->filename)
                                            <li class="list-inline-item">
                                                <a href="{{Storage::url($appendix->filename)}}"
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
                                @if($appendix->approved)
                                    <li class="list-inline-item text-primary">
                                        <small>
                                            {{__('documents.shipment.approval.approved')}}:
                                        </small>
                                    </li>
                                    <li class="list-inline-item text-primary">
                                        <small>
                                            {{$appendix->approved_at}}
                                        </small>
                                    </li>
                                    <li class="list-inline-item text-primary">
                                        <small>
                                            {{$appendix->approvedBy->name}}
                                        </small>
                                    </li>
                                @endif
                            </ul>
                        </x-slot>
                    </x-forms.collapse.card>
                </x-slot>
                @end_permissions
                @include('templates.documents.shipment.appendix.main')
            </x-forms.document>
        @endif
    </x-forms.main>
@endsection
