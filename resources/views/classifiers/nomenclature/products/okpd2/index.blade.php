@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    <x-token.dadata-token/>
    @include('classifiers.nomenclature.products.okpd2.create')
    <x-card
        :title="__('classifiers.nomenclature.products.okpd2.okpd2')">
        <x-form
            :route="route('okpd2.update',
                ['okpd2' => $okpd2Classifier->first()->code ?? 1])"
            formId="okpd2_edit_form"
            method="PATCH">
            <x-data-table.table
                id="okpd2_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md-2 col-auto"
                        :text="__('classifiers.nomenclature.products.okpd2.code')"/>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.products.okpd2.name')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($okpd2Classifier as $key => $okpd2)
                        <x-data-table.tr>
                            <x-data-table.td>
                                <input type="hidden"
                                       name="okpd2[{{$key}}][original_code]"
                                       value="{{$okpd2->code}}">
                                <x-form.element.input
                                    name="okpd2[{{$key}}][code]"
                                    :value="$okpd2->code"
                                    :required="true"
                                    max="20"/>
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="okpd2[{{$key}}][name]"
                                    :value="$okpd2->name"
                                    :required="true"
                                    max="150"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($okpd2Classifier) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="okpd2_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
