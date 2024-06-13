@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    @include('classifiers.nomenclature.products.international-names-of-end-products.create')
    <x-card
        :title="__(
        'classifiers.nomenclature.products.international_names_of_end_products.international_names_of_end_products'
    )">
        <x-form
            :route="route('international_names.update',
                ['international_name' => $internationalNames->first()->id ?? 1])"
            formId="international_names_of_end_product_edit_form"
            method="PATCH">
            <x-data-table.table
                id="international_names_of_end_products_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.products.international_names_of_end_products.name')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($internationalNames as $key => $internationalName)
                        <x-data-table.tr>
                            <input type="hidden"
                                   name="international_names_of_end_products[{{$key}}][id]"
                                   value="{{$internationalName->id}}">
                            <x-data-table.td>
                                <x-form.element.input
                                    name="international_names_of_end_products[{{$key}}][name]"
                                    :value="$internationalName->name"
                                    :required="true"
                                    max="60"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($internationalNames) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="international_names_of_end_product_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
