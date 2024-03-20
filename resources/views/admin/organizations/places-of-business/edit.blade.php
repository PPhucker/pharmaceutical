<x-form.nav-tab
    formId="places_main_form">
    <div class="row">
        <div class="col-md col-auto mb-2">
            @include('admin.organizations.places-of-business.create')
        </div>
        <div class="col-md-12 col-auto">
            <x-form
                :route="route('organization.places_of_business.update')"
                method="PATCH">
                <x-data-table.table
                    id="places_of_business"
                    type="edit"
                    targets="-1,-2">
                    <x-data-table.head>
                        <x-data-table.th
                            :text="__('contractors.places_of_business.identifier')"/>
                        <x-data-table.th
                            :text="__('contractors.places_of_business.index')"/>
                        <x-data-table.th
                            :text="__('contractors.places_of_business.address')"/>
                        <x-data-table.th
                            :text="__('contractors.places_of_business.registered')"/>
                        <x-data-table.th/>
                    </x-data-table.head>
                    <x-data-table.body>
                        @foreach($organization->placesOfBusiness as $key => $place)
                            <x-data-table.tr :model="$place">
                                <x-slot name="hiddenInputs">
                                    <input type="hidden"
                                           name="places_of_business[{{$key}}][id]"
                                           value="{{$place->id}}">
                                    <input type="hidden"
                                           name="places_of_business[{{$key}}][organization_id]"
                                           value="{{$place->organization_id}}">
                                </x-slot>
                                <x-data-table.td
                                    class="col-md-1 col-auto">
                                    <x-form.element.input
                                        name="places_of_business[{{$key}}][identifier]"
                                        :value="$place->identifier"
                                        :readonly="$place->trashed()"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="col-md-1 col-auto">
                                    <x-form.element.input
                                        name="places_of_business[{{$key}}][index]"
                                        :value="$place->index"
                                        :readonly="$place->trashed()"/>
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
                                        id="place-{{$place->id}}"
                                        route="organization.places_of_business"
                                        :params="['place_of_business' => $place->id]"/>
                                </x-data-table.td>
                            </x-data-table.tr>
                        @endforeach
                    </x-data-table.body>
                </x-data-table.table>
                <footer class="mt-auto">
                    <ul class="list-inline mb-0">
                        @if(count($organization->placesOfBusiness) > 0)
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
