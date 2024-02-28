@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    @include('classifiers.nomenclature.products.types-of-end-products.create')
    <x-card
        :title="__('classifiers.nomenclature.products.types_of_end_products.types_of_end_products')">
        <x-form
            :route="route('types_of_end_products.update',
                ['type_of_end_product' => $typesOfEndProducts->first()->id ?? 1])"
            formId="types_of_end_products_edit_form"
            method="PATCH">
            <x-data-table.table
                id="types_of_end_products_table"
                class="table-bordered"
                type="edit"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md-1 col-auto"
                        text="ID"/>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.products.types_of_end_products.name')"/>
                    <x-data-table.th
                        class="col-md-1 col-auto"
                        :text="__('classifiers.nomenclature.products.types_of_end_products.color')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($typesOfEndProducts as $key => $type)
                        <x-data-table.tr>
                            <x-data-table.td>
                                <input type="hidden"
                                       name="types_of_end_products[{{$key}}][id]"
                                       value="{{$type->id}}">
                                {{$type->id}}
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="types_of_end_products[{{$key}}][name]"
                                    :value="$type->name"
                                    :required="true"
                                    max="50"/>
                            </x-data-table.td>
                            <x-data-table.td class="text-center">
                                <x-form.element.input
                                    type="color"
                                    class="form-control form-control-color"
                                    name="types_of_end_products[{{$key}}][color]"
                                    :value="$type->color"
                                    max="7"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($typesOfEndProducts) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="types_of_end_products_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
