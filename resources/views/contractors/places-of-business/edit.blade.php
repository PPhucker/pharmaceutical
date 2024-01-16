<x-form.nav-tab
    formId="places_main_form">
    <div class="row">
        <div class="col-md col-auto mb-2">
            @include('contractors.places-of-business.create')
        </div>
        <div class="col-md-12 col-auto">
            <x-form
                :route="route('places_of_business.update',
                    ['place_of_business' => $contractor->placesOfBusiness->first()->id ?? 1])"
                method="PATCH">
                <x-data-table.table
                    id="places_of_business"
                    type="edit"
                    targets="-1,-2">
                    <x-data-table.head>
                        @roles(['digital_communication'])
                        <x-data-table.th
                            :text="__('contractors.places_of_business.identifier')"/>
                        @end_roles
                        <x-data-table.th
                            :text="__('contractors.places_of_business.index')"/>
                        <x-data-table.th
                            :text="__('classifiers.regions.region')"/>
                        <x-data-table.th
                            :text="__('contractors.places_of_business.address')"/>
                        <x-data-table.th
                            :text="__('contractors.places_of_business.registered')"/>
                        <x-data-table.th/>
                    </x-data-table.head>
                    <x-data-table.body>
                        @foreach($contractor->placesOfBusiness as $key => $place)
                            <x-data-table.tr :model="$place">
                                <x-slot name="hiddenInputs">
                                    <input type="hidden"
                                           name="places_of_business[{{$key}}][id]"
                                           value="{{$place->id}}">
                                    <input type="hidden"
                                           name="places_of_business[{{$key}}][contractor_id]"
                                           value="{{$place->contractor_id}}">
                                </x-slot>
                                @roles(['digital_communication'])
                                <x-data-table.td
                                    class="col-md-1 col-auto">
                                    <x-form.element.input
                                        name="places_of_business[{{$key}}][identifier]"
                                        :value="$place->identifier"
                                        :readonly="$place->trashed()"/>
                                </x-data-table.td>
                                @end_roles
                                <x-data-table.td
                                    class="col-md-1 col-auto">
                                    <x-form.element.input
                                        name="places_of_business[{{$key}}][index]"
                                        :value="$place->index"
                                        :readonly="$place->trashed()"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="col-md-1 col-auto">
                                    <x-form.element.select
                                        name="places_of_business[{{$key}}][region_id]"
                                        :readonly="$place->trashed()">
                                        <x-form.element.option
                                            :value="null"
                                            text="-"
                                            :selected="true"/>
                                        @foreach($regions as $region)
                                            <x-form.element.option
                                                :value="$region->id"
                                                :text="$region->name"
                                                :selected="($place->region->id ?? null) === $region->id"/>
                                        @endforeach
                                    </x-form.element.select>
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-form.element.textarea
                                        name="places_of_business[{{$key}}][address]"
                                        :text="$place->address"
                                        rows="1"
                                        :readonly="$place->trashed()"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="col-md-1 col-auto text-center">
                                    <x-form.element.input
                                        type="radio"
                                        name="registered"
                                        :value="$place->id"
                                        class="form-check-input"
                                        :checked="$place->registered"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="col-md-1 col-auto text-center">
                                    <x-data-table.button.soft-delete
                                        :trashed="$place->trashed()"
                                        :id="$place->id"
                                        route="places_of_business"
                                        :params="['place_of_business' => $place->id]"/>
                                </x-data-table.td>
                            </x-data-table.tr>
                        @endforeach
                    </x-data-table.body>
                </x-data-table.table>
                <footer class="mt-auto">
                    <ul class="list-inline mb-0">
                        @if(count($contractor->placesOfBusiness) > 0)
                            <li class="list-inline-item">
                                <x-form.button.save formId="places_main_form"/>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <x-data-table.filter.trashed-filter id="places_of_business"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </div>
    </div>

</x-form.nav-tab>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addressInput = $('#address');
        const indexInput = $('#index');
        const dadataToken = $('#dadata_token').val();

        addressInput.suggestions({
            token: dadataToken,
            type: 'ADDRESS',
            onSelect: handleSuggestionSelect,
        });

        function handleSuggestionSelect(suggestion) {
            const address = suggestion.data;
            indexInput.val(DaData.showPostalCode(address));
            addressInput.val(DaData.showAddress(address));
        }
    });

</script>
