<x-forms.collapse.card route="{{route('cars.update', ['car' => 1])}}"
                       cardId="card_cars"
                       formId="form_cars"
                       title="{{__('contractors.cars.cars')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_cars"
                       targets="-1"
                       domOrderType="{{true}}">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_cars"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('contractors.cars.car_model')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.cars.state_number')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($contractor->cars as $key => $car)
                <tr @if($car->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="cars[{{$key}}][id]"
                           value="{{$car->id}}">
                    <input type="hidden"
                           name="cars[{{$key}}][contractor_id]"
                           value="{{$contractor->id}}">
                    <td class="border-start">
                        <span class="d-none">
                            {{$car->car_model}}
                        </span>
                        <input type="text"
                               name="cars[{{$key}}][car_model]"
                               value="{{$car->car_model}}"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('cars.' . $key . '.car_model') is-invalid @enderror">
                        <x-forms.span-error name="cars.{{$key}}.car_model"/>
                    </td>
                    <td class="col-11 border-start">
                        <span class="d-none">
                            {{$car->state_number}}
                        </span>
                        <input type="text"
                               name="cars[{{$key}}][state_number]"
                               value="{{$car->state_number}}"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('cars.' . $key . '.state_number') is-invalid @enderror">
                        <x-forms.span-error name="cars.{{$key}}.state_number"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($car->trashed())
                            <x-buttons.restore
                                route="{{route('cars.restore', ['car' => $car->id])}}"
                                itemId="car-{{$car->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('cars.destroy', ['car' => $car->id])}}"
                                itemId="car-{{$car->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        @if(count($contractor->cars) > 0)
            <x-buttons.save formId="form_cars"/>
        @endif
        <x-buttons.collapse formId="div_add_car"/>
    </x-slot>
</x-forms.collapse.card>
