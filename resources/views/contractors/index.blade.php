@extends('layouts.app')
@section('content')
    <x-card
        :title="__('contractors.contractors')">
        <x-notification.alert/>
        <x-data-table.table
            id="contractors_table"
            class="table-bordered"
            targets="-1,-2,-3"
            type="index"
            pageLength="20">
            <x-slot name="filter">
                <x-data-table.filter.trashed-filter tableId="contractors_table"/>
            </x-slot>
            <x-data-table.head>
                <x-data-table.th
                    :text="__('contractors.name')"/>
                <x-data-table.th
                    :text="__('contractors.inn')"/>
                <x-data-table.th
                    :text="__('contractors.kpp')"/>
                <x-data-table.th
                    :text="__('contractors.comment')"/>
                <x-data-table.th
                    :text="__('contractors.contracts.contracts')"/>
                <x-data-table.th/>
                <x-data-table.th/>
                <x-data-table.th/>
            </x-data-table.head>
            <x-data-table.body>
                @foreach($contractors as $key => $contractor)
                    <x-data-table.tr
                        :model="$contractor">
                        <x-data-table.td
                            class="text-start">
                            {{$contractor->full_name}}
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$contractor->INN}}
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$contractor->kpp}}
                        </x-data-table.td>
                        <x-data-table.td
                            class="text-start">
                            {{$contractor->comment}}
                        </x-data-table.td>

                        <x-data-table.td>
                            @if($contractor->contracts->count())
                                <button type="button"
                                        title="{{__('datatable.entries.show')}}"
                                        class="btn btn-hover"
                                        data-bs-toggle="modal"
                                        data-bs-target="#contractsModal{{$key}}">
                                    <i class="bi bi-eye-fill fs-6"></i>
                                </button>
                                <div class="modal fade"
                                     id="contractsModal{{$key}}"
                                     tabindex="-1"
                                     aria-labelledby="contractsModal{{$key}}Label"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header text-primary">
                                                <h5 class="modal-title"
                                                    id="contractsModal{{$key}}Label">
                                                    {{__('contractors.contracts.contracts') . ' ' . $contractor->full_name}}
                                                </h5>
                                                <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered text-primary">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th scope="col"
                                                            class="text-center">
                                                            {{__('contractors.contracts.number')}}
                                                        </th>
                                                        <th scope="col"
                                                            class="text-center">
                                                            {{__('contractors.contracts.date')}}
                                                        </th>
                                                        <th scope="col"
                                                            class="text-center">
                                                            {{__('contractors.contracts.comment')}}
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contractor->contracts as $contract)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{$contract->number}}
                                                            </td>
                                                            <td>
                                                                @if($contract->is_expired)
                                                                    <i class="bi bi bi-exclamation-square-fill text-danger fs-6 fw-bolder"></i>
                                                                @else
                                                                    <i class="bi bi-check-square-fill text-success fs-6 fw-bolder"></i>
                                                                @endif
                                                                <span>{{$contract->date}}</span>
                                                            </td>
                                                            <td class="text-start">
                                                                {{$contract->comment}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </x-data-table.td>

                        <x-data-table.td>
                            <x-data-table.button.href
                                route="{{route('invoices_for_payment.create', ['contractor' => $contractor->id])}}"
                                title="{{__('documents.invoices_for_payment.buttons.create')}}"
                                icon="bi bi-file-earmark-fill"
                                :disabled="$contractor->trashed()"/>
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.edit
                                route="{{route('contractors.edit', ['contractor' => $contractor->id])}}"
                                disabled="{{$contractor->trashed()}}"/>
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.soft-delete
                                :trashed="$contractor->trashed()"
                                :id="$contractor->id"
                                route="contractors"
                                :params="['contractor' => $contractor->id]"/>
                        </x-data-table.td>
                    </x-data-table.tr>
                @endforeach
            </x-data-table.body>
        </x-data-table.table>
    </x-card>
@endsection
