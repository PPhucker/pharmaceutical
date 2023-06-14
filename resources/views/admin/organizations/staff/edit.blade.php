<x-forms.collapse.card route="{{route('staff.update')}}"
                       cardId="card_staff"
                       formId="form_staff"
                       title="{{__('contractors.staff.staff')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_staff"
                       targets="-1"
                       domOrderType="{{true}}">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_staff"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('contractors.places_of_business.place_of_business')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.staff.name')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.staff.post')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($organization->staff as $key => $staff)
                <tr @if($staff->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="staff[{{$key}}][id]"
                           value="{{$staff->id}}">
                    <td class="border-start">
                            <span class="d-none">
                                {{$staff->placeOfBusiness->address}}
                            </span>
                        <select name="staff[{{$key}}][organization_place_of_business_id]"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                @error('staff.' . $key . '.organization_place_of_business_id') is-invalid @enderror">
                            @foreach($organization->placesOfBusiness as $place)
                                <option value="{{$place->id}}"
                                        @if($place->id === $staff->organization_place_of_business_id) selected @endif>
                                    {{$place->address}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <span class="d-none">
                            {{$staff->name}}
                        </span>
                        <input type="text"
                               name="staff[{{$key}}][name]"
                               value="{{$staff->name}}"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('staff.' . $key . '.name') is-invalid @enderror">
                        <x-forms.span-error name="staff.{{$key}}.name"/>
                    </td>
                    <td>
                        <span class="d-none">
                            {{$employees[$staff->post]}}
                        </span>
                        <select name="staff[{{$key}}][post]"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                @error('staff.' . $key . '.post') is-invalid @enderror">
                            @foreach($employees as $value => $employee)
                                <option value="{{$value}}"
                                        @if($value === $staff->post) selected @endif>
                                    {{$employee}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="staff.{{$key}}.post"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($staff->trashed())
                            <x-buttons.restore
                                route="{{route('staff.restore', ['staff' => $staff->id])}}"
                                itemId="staff-{{$staff->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('staff.destroy', ['staff' => $staff->id])}}"
                                itemId="staff-{{$staff->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        @if(count($organization->staff) > 0)
            <x-buttons.save formId="form_staff"/>
        @endif
        <x-buttons.collapse formId="div_add_staff"/>
    </x-slot>
</x-forms.collapse.card>
