@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('classifiers.nomenclature.materials.materials')}}">
        <x-tables.main id="table_materials"
                       domOrderType="{{true}}">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_materials"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center col-md-1">
                    ID
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('classifiers.nomenclature.materials.name')}}
                </th>
                <th class="col-md-1">
                    <span class="d-none">
                        {{__('datatable.buttons.edit')}}
                    </span>
                </th>
                <th class="col-md-1">
                    <span class="d-none">
                        {{__('datatable.buttons.delete')}}
                    </span>
                </th>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($materials as $key => $material)
                <tr @if($material->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$material->id}}
                    </td>
                    <td class="align-middle text-start">
                        {{$material->name}}
                    </td>
                    <td class="text-center align-middle col-md-1">
                        <x-buttons.edit
                            route="{{route('materials.edit', ['material' => $material->id])}}"
                            disabled="{{$material->trashed()}}"/>
                    </td>
                    <td class="text-center align-middle col-md-1">
                        @if ($material->trashed())
                            <x-buttons.restore
                                route="{{route('materials.restore', ['material' => $material->id])}}"
                                itemId="{{$material->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('materials.destroy', ['material' => $material->id])}}"
                                formId="destroy"
                                itemId="{{$material->id}}"/>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
