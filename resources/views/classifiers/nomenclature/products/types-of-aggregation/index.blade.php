@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    @include('classifiers.nomenclature.products.types-of-aggregation.create')
    <x-card
        :title="__('classifiers.nomenclature.products.types_of_aggregation.types_of_aggregation')">
        <x-form
            :route="route('types_of_aggregation.update',
                ['type_of_aggregation' => $typesOfAggregation->first()->code ?? 1])"
            formId="types_of_aggregation_edit_form"
            method="PATCH">
            <x-data-table.table
                id="types_of_aggregation_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.products.types_of_aggregation.code')"/>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.products.types_of_aggregation.name')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($typesOfAggregation as $key => $type)
                        <x-data-table.tr>
                            <x-data-table.td>
                                <input type="hidden"
                                       name="types_of_aggregation[{{$key}}][original_code]"
                                       value="{{$type->code}}">
                                <x-form.element.input
                                    name="types_of_aggregation[{{$key}}][code]"
                                    :value="$type->code"
                                    :required="true"
                                    max="10"/>
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="types_of_aggregation[{{$key}}][name]"
                                    :value="$type->name"
                                    :required="true"
                                    max="20"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($typesOfAggregation) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="types_of_aggregation_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
