@extends('layouts.app')
@section('content')
    <x-card
        :title="__('contractors.contractors')">
        <x-data-table.table
            id="contractors_table"
            class="table-bordered"
            targets="-1,-2,-3"
            type="index">
            <x-slot name="filter">
                <x-data-table.filter.trashed-filter tableId="contractors_table"/>
            </x-slot>
            <thead class="bg-secondary text-primary text-nowrap">
            <tr>
                <x-data-table.th
                    class="p-0"
                    rowspan="2"
                    :text="__('ID')"/>
                <x-data-table.th
                    class="p-0"
                    rowspan="2"
                    :text="__('contractors.name')"/>
                <x-data-table.th
                    class="p-0"
                    rowspan="2"
                    :text="__('contractors.comment')"/>
                <x-data-table.th
                    class="p-0"
                    colspan="{{$organizations->count()}}"
                    :text="__('contractors.contracts.contracts')"/>
                <x-data-table.th
                    class="p-0"
                    rowspan="2"
                    :text="__('contractors.inn')"/>
                <x-data-table.th
                    class="p-0"
                    rowspan="2"/>
                <x-data-table.th
                    class="p-0"
                    rowspan="2"/>
                <x-data-table.th
                    class="p-0"
                    rowspan="2"/>
            </tr>
            <tr>
                @foreach($organizations as $organization)
                    <x-data-table.th
                        :text="$organization->name"/>
                @endforeach
            </tr>
            </thead>
            <x-data-table.body>
                @foreach($contractors as $key => $contractor)
                    <x-data-table.tr
                        :model="$contractor">
                        <x-data-table.td>
                            {{$contractor->id}}
                        </x-data-table.td>
                        <x-data-table.td
                            class="text-start">
                            {{$contractor->full_name}}
                        </x-data-table.td>
                        <x-data-table.td
                            class="text-start">
                            {{$contractor->comment}}
                        </x-data-table.td>
                        @foreach($organizations as $organization)
                            <x-data-table.td>
                                @if($contractor->hasContract($organization->id))
                                    <span class="d-none">{{true}}</span>
                                    <i class="bi bi-check-square-fill text-success fs-6 fw-bolder"></i>
                                @else
                                    <span class="d-none">{{false}}</span>
                                @endif
                            </x-data-table.td>
                        @endforeach
                        <x-data-table.td>
                            {{$contractor->INN}}
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
