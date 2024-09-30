@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    @include('classifiers.nomenclature.products.registration-numbers.create')
    <x-card
        :title="__('classifiers.nomenclature.products.registration_numbers.registration_numbers')">
        <x-form
            :route="route('registration_numbers.update',
                ['registration_number' => $registrationNumbers->first()->id ?? 1])"
            formId="registration_numbers_edit_form"
            method="PATCH">
            <x-data-table.table
                id="iregistration_numbers_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.nomenclature.products.registration_numbers.number')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($registrationNumbers as $key => $registrationNumber)
                        <x-data-table.tr>
                            <input type="hidden"
                                   name="registration_numbers[{{$key}}][id]"
                                   value="{{$registrationNumber->id}}">
                            <x-data-table.td>
                                <x-form.element.input
                                    name="registration_numbers[{{$key}}][number]"
                                    :value="$registrationNumber->number"
                                    :required="true"
                                    max="30"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($registrationNumbers) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="registration_numbers_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
