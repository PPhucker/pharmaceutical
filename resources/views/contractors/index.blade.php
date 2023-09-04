@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('contractors.contractors')}}">
        <x-tables.main id="table_contractors"
                       targets="-1,-2,-3">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_contractors"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('ID')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.name')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.comment')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.inn')}}
                </th>
                <th>
                    <span class="d-none">
                        {{__('documents.invoices_for_payment.buttons.create')}}
                    </span>
                </th>
                <th>
                    <span class="d-none">
                        {{__('datatable.buttons.edit')}}
                    </span>
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($contractors as $key => $contractor)
                <tr @if($contractor->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$contractor->id}}
                    </td>
                    <td class="align-middle">
                        {{$contractor->legalForm->abbreviation}} {{$contractor->name}}
                    </td>
                    <td class="align-middle">
                        {{$contractor->comment}}
                    </td>
                    <td class="align-middle text-center">
                        {{$contractor->INN}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.href
                            route="{{route('invoices_for_payment.create', ['contractor' => $contractor->id])}}"
                            title="{{__('documents.invoices_for_payment.buttons.create')}}"
                            icon="{{'bi bi-file-earmark-fill'}}"/>
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit route="{{route('contractors.edit', ['contractor' => $contractor->id])}}"
                                        disabled="{{$contractor->trashed()}}"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($contractor->trashed())
                            <x-buttons.restore
                                route="{{route('contractors.restore', ['contractor' => $contractor->id])}}"
                                itemId="{{$contractor->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('contractors.destroy', ['contractor' => $contractor->id])}}"
                                formId="destroy"
                                itemId="{{$contractor->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
