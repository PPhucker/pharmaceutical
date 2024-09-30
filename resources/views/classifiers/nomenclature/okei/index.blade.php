@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    <x-token.dadata-token/>
    @include('classifiers.nomenclature.okei.create')
    <x-card
        :title="__('classifiers.nomenclature.okei.okei')">
        <x-form
            :route="route('okei.update', ['okei' => $okeiClassifier->first()->code ?? 1])"
            formId="okei_edit_form"
            method="PATCH">
            <x-data-table.table
                id="okei_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.okei.code')"/>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.okei.unit')"/>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.okei.symbol')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($okeiClassifier as $key => $okei)
                        <x-data-table.tr>
                            <x-data-table.td>
                                <input type="hidden"
                                       name="okei[{{$key}}][original_code]"
                                       value="{{$okei->code}}">
                                <x-form.element.input
                                    name="okei[{{$key}}][code]"
                                    :value="$okei->code"
                                    :required="true"
                                    max="10"/>
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="okei[{{$key}}][unit]"
                                    :value="$okei->unit"
                                    :required="true"
                                    max="20"/>
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="okei[{{$key}}][symbol]"
                                    :value="$okei->symbol"
                                    :required="true"
                                    max="10"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($okeiClassifier) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="okei_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
