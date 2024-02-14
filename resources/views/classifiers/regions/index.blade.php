@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    <x-token.dadata-token/>
    @include('classifiers.regions.create')
    <x-card
        :title="__('classifiers.regions.regions')">
        <x-form
            :route="route('regions.update', ['region' => $regions->first()->id ?? 1])"
            formId="regions_edit_form"
            method="PATCH">
            <x-notification.info
                :text="__('classifiers.regions.notifications.info')"/>
            <x-data-table.table
                id="regions_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md-2 col-auto"
                        :text="__('classifiers.regions.name')"/>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.regions.zone')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($regions as $key => $region)
                        <x-data-table.tr>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="regions[{{$key}}][name]"
                                    :value="$region->name"
                                    :required="true"/>
                                <input type="hidden"
                                       name="regions[{{$key}}][id]"
                                       value="{{$region->id}}"/>
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="regions[{{$key}}][zone]"
                                    :value="$region->zone"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($regions) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="regions_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
