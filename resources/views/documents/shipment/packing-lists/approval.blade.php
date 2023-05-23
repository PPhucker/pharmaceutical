@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('documents.shipment.approval.approval')}}">
        <div class="list-inline-item">
            <form action="{{route('shipment.approval')}}"
                  method="GET">
                <x-tables.filters.date-filter fromDate="{{$fromDate}}"
                                              toDate="{{$toDate}}"/>
                <x-tables.filters.select-filter
                    title="{{__('documents.shipment.organization_id')}}"
                    name="organization_id">
                    @foreach($organizations as $organization)
                        <option value="{{$organization->id}}"
                                @if((int)request('organization_id') === $organization->id) selected @endif>
                            {{$organization->legalForm->abbreviation}} {{$organization->name}}
                        </option>
                    @endforeach
                </x-tables.filters.select-filter>
                <button type="submit"
                        class="btn btn-sm btn-primary">
                    {{__('datatable.filter')}}
                </button>
            </form>
        </div>
        @foreach($packingLists as $packingList)
            <x-forms.collapse.card
                route=""
                cardId="card_approval_{{$packingList->id}}"
                formId="form_approval_{{$packingList->id}}"
                title="{{$packingList->organization->legalForm->abbreviation}}
                {!!$packingList->organization->name !!}
                №{{$packingList->number}}">
                <x-slot name="cardBody">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover text-nowrap w-100 mb-0">
                            <thead class="text-primary bg-secondary">
                            <tr>
                                <th class="align-middle text-center">
                                    {{__('documents.shipment.approval.document')}}
                                </th>
                                <th class="text-center align-middle">
                                    {{__('documents.shipment.number')}}
                                </th>
                                <th class="text-center align-middle">
                                    {{__('documents.shipment.date')}}
                                </th>
                                <th colspan="2"
                                    class="text-center align-middle">
                                    {{__('documents.shipment.approval.approved_by')}}
                                </th>
                                <th colspan="2"
                                    class="text-center align-middle">
                                    {{__('documents.shipment.approval.approved')}}
                                </th>
                                <th colspan="2"
                                    class="text-center align-middle">
                                    {{__('documents.shipment.approval.updated')}}
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="text-primary">
                            {{-- ТН --}}
                            <tr>
                                <td class="text-start align-middle">
                                    {{__('documents.shipment.packing_lists.packing_list')}}
                                </td>
                                <td class="text-start align-middle">
                                    {{$packingList->number}}
                                </td>
                                <td class="text-center align-middle">
                                    {{$packingList->date}}
                                </td>
                                <td colspan="2"
                                    class="text-start align-middle">
                                    @if($packingList->approvedBy)
                                        {{$packingList->approvedBy->name}}
                                    @else
                                        {{__('documents.shipment.approval.not_viewed')}}
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if($packingList->approved === 1)
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @elseif($packingList->approved === 0)
                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    {{$packingList->approved_at}}
                                </td>
                                <td class="text-start align-middle">
                                    {{$packingList->updatedBy->name}}
                                </td>
                                <td class="text-center align-middle">
                                    {{$packingList->updated_at}}
                                </td>
                                <td class="text-center align-middle">
                                    <x-buttons.href
                                        route="{{route('packing_lists.show', ['packing_list' => $packingList->id])}}"
                                        title="{{__('form.button.show')}}"
                                        icon="bi bi-zoom-in"
                                        target="_blank"
                                        disabled="{{$packingList->trashed() || !$packingList->production}}"/>
                                </td>
                                <td class="text-center align-middle">
                                    <x-buttons.edit
                                        route="{{route('packing_lists.edit', ['packing_list' => $packingList->id])}}"
                                        target="_blank"
                                        disabled="{{$packingList->trashed()}}"/>
                                </td>
                            </tr>

                            {{-- Счет-фактура --}}
                            <tr>
                                <td class="text-start align-middle">
                                    {{__('documents.shipment.bills.bill')}}
                                </td>
                                <td class="text-start align-middle">
                                    {{$packingList->bill->number}}
                                </td>
                                <td class="text-center align-middle">
                                    {{$packingList->bill->date}}
                                </td>
                                <td colspan="2"
                                    class="text-start align-middle">
                                    @if($packingList->bill->approvedBy)
                                        {{$packingList->bill->approvedBy->name}}
                                    @else
                                        {{__('documents.shipment.approval.not_viewed')}}
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if($packingList->bill->approved === 1)
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @elseif($packingList->bill->approved === 0)
                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    {{$packingList->bill->approved_at}}
                                </td>
                                <td class="text-start align-middle">
                                    {{$packingList->bill->updatedBy->name}}
                                </td>
                                <td class="text-center align-middle">
                                    {{$packingList->bill->updated_at}}
                                </td>
                                <td class="text-center align-middle">
                                    <x-buttons.href
                                        route="{{route('bills.show', ['bill' => $packingList->bill->id])}}"
                                        title="{{__('form.button.show')}}"
                                        target="_blank"
                                        icon="bi bi-zoom-in"
                                        disabled="{{$packingList->bill->trashed()}}"/>
                                </td>
                                <td class="text-center align-middle">
                                    <x-buttons.edit
                                        route="{{route('bills.edit', ['bill' => $packingList->bill->id])}}"
                                        target="_blank"
                                        disabled="{{$packingList->bill->trashed()}}"/>
                                </td>
                            </tr>

                            {{-- Приложение --}}
                            @if($packingList->appendix)
                                <tr>
                                    <td class="text-start align-middle">
                                        {{__('documents.shipment.appendixes.appendix')}}
                                    </td>
                                    <td class="text-start align-middle">
                                        {{$packingList->appendix->number}}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{$packingList->appendix->date}}
                                    </td>
                                    <td colspan="2"
                                        class="text-start align-middle">
                                        @if($packingList->appendix->approvedBy)
                                            {{$packingList->appendix->approvedBy->name}}
                                        @else
                                            {{__('documents.shipment.approval.not_viewed')}}
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($packingList->appendix->approved === 1)
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        @elseif($packingList->appendix->approved === 0)
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        {{$packingList->appendix->approved_at}}
                                    </td>
                                    <td class="text-start align-middle">
                                        {{$packingList->appendix->updatedBy->name}}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{$packingList->appendix->updated_at}}
                                    </td>
                                    <td class="text-center align-middle">
                                        <x-buttons.href
                                            route="{{route('appendixes.show', ['appendix' => $packingList->appendix->id])}}"
                                            title="{{__('form.button.show')}}"
                                            target="_blank"
                                            icon="bi bi-zoom-in"
                                            disabled="{{$packingList->appendix->trashed()}}"/>
                                    </td>
                                    <td class="text-center align-middle">
                                        <x-buttons.edit
                                            route="{{route('appendixes.edit', ['appendix' => $packingList->appendix->id])}}"
                                            target="_blank"
                                            disabled="{{$packingList->appendix->trashed()}}"/>
                                    </td>
                                </tr>
                            @endif

                            {{-- Протокол --}}
                            @if($packingList->protocol)
                                <tr>
                                    <td class="text-start align-middle">
                                        {{__('documents.shipment.protocols.protocol')}}
                                    </td>
                                    <td class="text-start align-middle">
                                        {{$packingList->protocol->number}}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{$packingList->protocol->date}}
                                    </td>
                                    <td colspan="2"
                                        class="text-start align-middle">
                                        @if($packingList->protocol->approvedBy)
                                            {{$packingList->protocol->approvedBy->name}}
                                        @else
                                            {{__('documents.shipment.approval.not_viewed')}}
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($packingList->protocol->approved === 1)
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        @elseif($packingList->protocol->approved === 0)
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        {{$packingList->protocol->approved_at}}
                                    </td>
                                    <td class="text-start align-middle">
                                        {{$packingList->protocol->updatedBy->name}}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{$packingList->protocol->updated_at}}
                                    </td>
                                    <td class="text-center align-middle">
                                        <x-buttons.href
                                            route="{{route('protocols.show', ['protocol' => $packingList->protocol->id])}}"
                                            title="{{__('form.button.show')}}"
                                            target="_blank"
                                            icon="bi bi-zoom-in"
                                            disabled="{{$packingList->protocol->trashed()}}"/>
                                    </td>
                                    <td class="text-center align-middle">
                                        <x-buttons.edit
                                            route="{{route('protocols.edit', ['protocol' => $packingList->protocol->id])}}"
                                            target="_blank"
                                            disabled="{{$packingList->protocol->trashed()}}"/>
                                    </td>
                                </tr>
                            @endif
                            {{-- ТТН --}}
                            <tr>
                                <td class="text-start align-middle">
                                    {{__('documents.shipment.waybills.waybill')}}
                                </td>
                                <td class="text-start align-middle">
                                    {{$packingList->waybill->number}}
                                </td>
                                <td class="text-center align-middle">
                                    {{$packingList->waybill->date}}
                                </td>
                                <td colspan="2"
                                    class="text-start align-middle">
                                    @if($packingList->waybill->approvedBy)
                                        {{$packingList->waybill->approvedBy->name}}
                                    @else
                                        {{__('documents.shipment.approval.not_viewed')}}
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if($packingList->waybill->approved === 1)
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @elseif($packingList->waybill->approved === 0)
                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    {{$packingList->waybill->approved_at}}
                                </td>
                                <td class="text-start align-middle">
                                    {{$packingList->waybill->updatedBy->name}}
                                </td>
                                <td class="text-center align-middle">
                                    {{$packingList->waybill->updated_at}}
                                </td>
                                <td class="text-center align-middle">
                                    <x-buttons.href
                                        route="{{route('waybills.show', ['waybill' => $packingList->waybill->id])}}"
                                        title="{{__('form.button.show')}}"
                                        icon="bi bi-zoom-in"
                                        target="_blank"
                                        disabled="{{$packingList->waybill->trashed()}}"/>
                                </td>
                                <td class="text-center align-middle">
                                    <x-buttons.edit
                                        route="{{route('waybills.edit', ['waybill' => $packingList->waybill->id])}}"
                                        target="_blank"
                                        disabled="{{$packingList->waybill->trashed()}}"/>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <ul class="list-inline mb-0">
                        @roles(['marketing'])
                        <li class="list-inline-item text-primary">
                            <small>
                                {{__('documents.shipment.approval.e-mail.send.to.digital_comunication')}}:
                            </small>
                        </li>
                        <li class="list-inline-item text-md-end">
                            <form
                                action="{{route('approval.send_email_to_digital_comunication', ['packing_list' => $packingList->id])}}"
                                method="POST">
                                @csrf
                                <button class="btn btn-sm btn-primary"
                                        type="submit">
                                    <i class="bi bi-envelope-at">
                                        {{__('documents.shipment.approval.e-mail.send.send')}}
                                    </i>
                                </button>
                            </form>
                        </li>
                        @end_roles
                        @permissions(['approve_shipment_documents'])
                        <li class="list-inline-item text-primary">
                            <small>
                                {{__('documents.shipment.approval.e-mail.send.to.markeing')}}:
                            </small>
                        </li>
                        <li class="list-inline-item text-md-end">
                            <form
                                action="{{route('approval.send_email_to_marketing', ['packing_list' => $packingList->id])}}"
                                method="POST">
                                @csrf
                                <button class="btn btn-sm btn-primary"
                                        type="submit">
                                    <i class="bi bi-envelope-at">
                                        {{__('documents.shipment.approval.e-mail.send.send')}}
                                    </i>
                                </button>
                            </form>
                        </li>
                        @end_permissions
                    </ul>
                </x-slot>
            </x-forms.collapse.card>
        @endforeach

    </x-forms.main>
@endsection
