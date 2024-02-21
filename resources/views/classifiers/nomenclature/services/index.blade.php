@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    <x-token.dadata-token/>
    @include('classifiers.nomenclature.services.create')
    <x-card
        :title="__('classifiers.nomenclature.services.services')">
        <x-form
            :route="route('services.update', ['service' => $services->first()->id ?? 1])"
            formId="services_edit_form"
            method="PATCH">
            <x-data-table.table
                id="services_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.services.name')"/>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.okei.unit')"/>
                    <x-data-table.th/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($services as $key => $service)
                        <x-data-table.tr
                            :model="$service">
                            <x-data-table.td>
                                <input type="hidden"
                                       name="services[{{$key}}][id]"
                                       value="{{$service->id}}">
                                <x-form.element.input
                                    name="services[{{$key}}][name]"
                                    :value="$service->name"
                                    :required="true"
                                    max="255"/>
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-form.element.select
                                    name="services[{{$key}}][okei_code]">
                                    @foreach($okeiClassifier as $okei)
                                        <x-form.element.option
                                            :value="$okei->code"
                                            :text="$okei->unit"
                                            :selected="(int)$okei->code === (int)$service->okei_code"/>
                                    @endforeach
                                </x-form.element.select>
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-data-table.button.soft-delete
                                    :trashed="$service->trashed()"
                                    :id="$service->id"
                                    route="services"
                                    :params="['service' => $service->id]"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($services) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="services_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
