@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    @include('classifiers.nomenclature.materials.types-of-materials.create')
    <x-card
        :title="__('classifiers.nomenclature.materials.types_of_materials.types_of_materials')">
        <x-form
            :route="route('types_of_materials.update', ['type_of_material' => $typesOfMaterials->first()->id ?? 1])"
            formId="types_of_materials_edit_form"
            method="PATCH">
            <x-data-table.table
                id="types_of_materials_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.materials.types_of_materials.name')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($typesOfMaterials as $key => $type)
                        <x-data-table.tr>
                            <input type="hidden"
                                   name="types_of_materials[{{$key}}][id]"
                                   value="{{$type->id}}">
                            <x-data-table.td>
                                <x-form.element.input
                                    name="types_of_materials[{{$key}}][name]"
                                    :value="$type->name"
                                    :required="true"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($typesOfMaterials) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="types_of_materials_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
