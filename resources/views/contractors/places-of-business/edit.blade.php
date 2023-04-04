<x-forms.collapse.card route="{{route('places_of_business.update', ['places_of_business' => 1])}}"
                       cardId="card_places_of_business"
                       formId="form_places_of_business"
                       title="{{__('contractors.places_of_business.places_of_business')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_places_of_business"
                       targets='-1,-2'
                       domOrderType="{{true}}">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_places_of_business"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                @digital_communication
                <th scope="col"
                    class="text-center">
                    {{__('contractors.places_of_business.identifier')}}
                </th>
                @end_digital_communication
                <th scope="col"
                    class="text-center">
                    {{__('contractors.places_of_business.index')}}
                </th>
                <th scope="col"
                    class="text-center col-md-6">
                    {{__('contractors.places_of_business.address')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.places_of_business.registered')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($contractor->placesOfBusiness as $key => $place)
                <tr @if($place->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="places_of_business[{{$key}}][id]"
                           value="{{$place->id}}">
                    <input type="hidden"
                           name="places_of_business[{{$key}}][contractor_id]"
                           value="{{$place->contractor_id}}">

                    @digital_communication
                    <td class="border-start">
                        <span class="d-none">
                            {{$place->identifier}}
                        </span>
                        <input type="text"
                               name="places_of_business[{{$key}}][identifier]"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('places_of_business.' . $key . '.identifier') is-invalid @enderror"
                               value="{{$place->identifier}}">
                        <x-forms.span-error name="places_of_business.{{$key}}.identifier"/>
                    </td>
                    @end_digital_communication
                    <td>
                        <span class="d-none">
                            {{$place->index}}
                        </span>
                        <input type="text"
                               name="places_of_business[{{$key}}][index]"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('places_of_business.' . $key . '.index') is-invalid @enderror"
                               value="{{$place->index}}">
                        <x-forms.span-error name="places_of_business.{{$key}}.index"/>
                    </td>
                    <td class="col-md-6">
                        <span class="d-none">
                            {{$place->address}}
                        </span>
                        <input type="text"
                               name="places_of_business[{{$key}}][address]"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('places_of_business.' . $key . '.address') is-invalid @enderror"
                               value="{{$place->address}}">
                        <x-forms.span-error name="places_of_business.{{$key}}.address"/>
                    </td>
                    <td class="align-middle text-center">
                        <span class="d-none">
                            @if($place->registered)
                                {{__('contractors.places_of_business.is_registered')}}
                            @endif
                        </span>
                        <input type="radio"
                               name="registered"
                               value="{{$place->id}}"
                               class="form-check-input
                               @error('registered') is-invalid @enderror"
                               @if($place->registered) checked @endif>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($place->trashed())
                            <x-buttons.restore
                                route="{{route('places_of_business.restore', ['places_of_business' => $place->id])}}"
                                itemId="places-of-business-{{$place->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('places_of_business.destroy', ['places_of_business' => $place->id])}}"
                                itemId="places-of-business-{{$place->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        @if(count($contractor->placesOfBusiness) > 0)
            <x-buttons.save formId="form_places_of_business"/>
        @endif
        <x-buttons.collapse formId="div_add_place_of_business"/>
    </x-slot>
</x-forms.collapse.card>
