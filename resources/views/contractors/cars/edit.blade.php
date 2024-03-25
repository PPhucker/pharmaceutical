<x-form.nav-tab
    formId="cars_main_form">
    <div class="row">
        <div class="col-md col-auto mb-2">
            @include('contractors.cars.create')
        </div>
        <div class="col-md-12">
            <x-form
                :route="route('cars.update', ['car' => $contractor->cars->first()->id ?: null])"
                formId="cars_main_form"
                method="PATCH">
                <x-data-table.table
                    id="cars_main_table"
                    type="edit"
                    targets="-1">
                    <x-data-table.head>
                        <x-data-table.th
                            :text="__('contractors.cars.car_model')"/>
                        <x-data-table.th
                            :text="__('contractors.cars.state_number')"/>
                        <x-data-table.th/>
                    </x-data-table.head>
                    <x-data-table.body>
                        @foreach($contractor->cars as $key => $car)
                            <x-data-table.tr
                                :model="$car">
                                <x-slot name="hiddenInputs">
                                    <x-form.element.input type="hidden"
                                                          name="cars[{{$key}}][id]"
                                                          value="{{$car->id}}"/>
                                    <x-form.element.input type="hidden"
                                                          name="cars[{{$key}}][contractor_id]"
                                                          value="{{$contractor->id}}"/>
                                </x-slot>
                                <x-data-table.td>
                                    <x-form.element.input
                                        name="cars[{{$key}}][car_model]"
                                        :value="$car->car_model"
                                        :required="true"/>
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-form.element.input
                                        name="cars[{{$key}}][state_number]"
                                        :value="$car->state_number"
                                        :required="true"/>
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-data-table.button.soft-delete
                                        :trashed="$car->trashed()"
                                        id="cars-{{$car->id}}"
                                        route="cars"
                                        :params="['car' => $car->id]"/>
                                </x-data-table.td>
                            </x-data-table.tr>
                        @endforeach
                    </x-data-table.body>
                </x-data-table.table>
                <footer class="mt-auto">
                    <ul class="list-inline mb-0">
                        @if(count($contractor->cars) > 0)
                            <li class="list-inline-item">
                                <x-form.button.save formId="cars_main_form"/>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <x-data-table.filter.trashed-filter id="cars_main_table"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </div>
    </div>
</x-form.nav-tab>
