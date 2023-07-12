@extends('layouts.app')
@section('content')
    <x-forms.document back="{{route('appendixes.index')}}"
                      title="
                  {{__('documents.shipment.appendixes.appendix')
                    . ' №'
                    . $number
                    . ' '
                    . $date}}
                  ">
        @approve_shipment_documents
        <x-slot name="approval">
            <x-forms.collapse.card
                route="{{route('appendixes.approve', ['appendix' => $appendix->id])}}"
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
                            <textarea name="comment" class="form-control form-control-sm text-primary">{{$appendix->comment}}</textarea>
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
                            <x-buttons.save formId="form_main_info"/>
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
        @end_approve_shipment_documents
        @include('templates.documents.shipment.appendix.main')
    </x-forms.document>
@endsection