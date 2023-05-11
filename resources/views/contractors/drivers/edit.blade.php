<x-forms.collapse.card route="{{route('drivers.update', ['driver' => 1])}}"
                       cardId="card_drivers"
                       formId="form_drivers"
                       title="{{__('contractors.drivers.drivers')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_drivers"
                       targets="-1"
                       domOrderType="{{true}}">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_drivers"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('contractors.drivers.name')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($contractor->drivers as $key => $driver)
                <tr @if($driver->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="drivers[{{$key}}][id]"
                           value="{{$driver->id}}">
                    <input type="hidden"
                           name="drivers[{{$key}}][contractor_id]"
                           value="{{$contractor->id}}">
                    <td class="col-11 border-start">
                        <span class="d-none">
                            {{$driver->name}}
                        </span>
                        <input type="text"
                               name="drivers[{{$key}}][name]"
                               value="{{$driver->name}}"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('drivers.' . $key . '.name') is-invalid @enderror">
                        <x-forms.span-error name="drivers.{{$key}}.name"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($driver->trashed())
                            <x-buttons.restore
                                route="{{route('drivers.restore', ['driver' => $driver->id])}}"
                                itemId="driver-{{$driver->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('drivers.destroy', ['driver' => $driver->id])}}"
                                itemId="driver-{{$driver->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        @if(count($contractor->drivers) > 0)
            <x-buttons.save formId="form_drivers"/>
        @endif
        <x-buttons.collapse formId="div_add_driver"/>
    </x-slot>
</x-forms.collapse.card>
