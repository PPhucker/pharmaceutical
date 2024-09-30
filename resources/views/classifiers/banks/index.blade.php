@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    <x-token.dadata-token/>
    @include('classifiers.banks.create')
    <x-card
        :title="__('classifiers.banks.banks')">
        <x-form
            :route="route('banks.update', ['bank' => $banks->first()->BIC ?? 1])"
            formId="banks_edit_form"
            method="PATCH">
            <x-data-table.table
                id="banks_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.banks.name')"/>
                    <x-data-table.th
                        class="col-md-2 col-auto"
                        :text="__('classifiers.banks.BIC')"/>
                    <x-data-table.th
                        class="col-md-3 col-auto"
                        :text="__('classifiers.banks.correspondent_account')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($banks as $key => $bank)
                        <x-data-table.tr>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="banks[{{$key}}][name]"
                                    :value="$bank->name"
                                    :required="true"
                                    max="120"/>
                            </x-data-table.td>
                            <x-data-table.td>
                                <input type="hidden"
                                       name="banks[{{$key}}][original_BIC]"
                                       value="{{$bank->BIC}}">
                                <x-form.element.input
                                    name="banks[{{$key}}][BIC]"
                                    :value="$bank->BIC"
                                    :required="true"
                                    min="9"
                                    max="9"/>
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="banks[{{$key}}][correspondent_account]"
                                    :value="$bank->correspondent_account"
                                    :required="true"
                                    min="20"
                                    max="20"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($banks) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="banks_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
