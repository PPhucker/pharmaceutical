<x-forms.collapse.card route="{{route('trailers.update', ['trailer' => 1])}}"
                       cardId="card_trailers"
                       formId="form_trailers"
                       title="{{__('contractors.trailers.trailers')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_trailers"
                       targets="-1"
                       domOrderType="{{true}}">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_trailers"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('contractors.trailers.type')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.trailers.state_number')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($organization->trailers as $key => $trailer)
                <tr @if($trailer->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="trailers[{{$key}}][id]"
                           value="{{$trailer->id}}">
                    <input type="hidden"
                           name="trailers[{{$key}}][organization_id]"
                           value="{{$organization->id}}">
                    <td class="border-start">
                        <span class="d-none">
                            {{$trailer->type}}
                        </span>
                        <select name="trailer[{{$key}}][type]"
                                id="type"
                                class="form-control form-control-sm text-primary
                                @error('trailer.' . $key . '.type') is-invalid @enderror">
                            <option value="п" @if($trailer->type === 'п') selected @endif>Прицеп</option>
                            <option value="п/п" @if($trailer->type === 'п/п') selected @endif>Полуприцеп</option>
                        </select>
                        <x-forms.span-error name="cars.{{$key}}.car_model"/>
                    </td>
                    <td class="col-11 border-start">
                        <span class="d-none">
                            {{$trailer->state_number}}
                        </span>
                        <input type="text"
                               name="trailers[{{$key}}][state_number]"
                               value="{{$trailer->state_number}}"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('trailers.' . $key . '.state_number') is-invalid @enderror">
                        <x-forms.span-error name="trailers.{{$key}}.state_number"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($trailer->trashed())
                            <x-buttons.restore
                                route="{{route('trailers.restore', ['trailer' => $trailer->id])}}"
                                itemId="trailer-{{$trailer->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('trailers.destroy', ['trailer' => $trailer->id])}}"
                                itemId="trailer-{{$trailer->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        @if(count($organization->trailers) > 0)
            <x-buttons.save formId="form_trailers"/>
        @endif
        <x-buttons.collapse formId="div_add_trailer"/>
    </x-slot>
</x-forms.collapse.card>
