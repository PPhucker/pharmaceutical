<x-form.nav-tab
    formId="staff_main_form">
    <div class="col-md col-auto mb-2">
        @include('admin.organizations.staff.create')
    </div>
    <div class="col-md-12 col-auto">
        <x-form
            :route="route('organization.staff.update', ['staff' => $organization->staff->first()->id ?? 1])"
            method="PATCH">
            <x-data-table.table
                id="staff_table"
                type="edit"
                targets="-1,-2">
                <x-data-table.head>
                    <x-data-table.th
                        :text="__('contractors.places_of_business.place_of_business')"/>
                    <x-data-table.th
                        :text="__('contractors.staff.name')"/>
                    <x-data-table.th
                        :text="__('contractors.staff.post')"/>
                    <x-data-table.th/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($organization->staff as $key => $staff)
                        <x-data-table.tr
                            :model="$staff">
                            <x-form.element.input type="hidden"
                                                  name="staff[{{$key}}][id]"
                                                  value="{{$staff->id}}"/>
                            <x-data-table.td
                                class="col-md-5 col-auto">
                                <x-form.element.select
                                    name="staff[{{$key}}][organization_place_of_business_id]"
                                    :disabled="$staff->trashed()">
                                    @foreach($organization->placesOfBusiness as $place)
                                        <x-form.element.option
                                            :value="$place->id"
                                            :text="$place->address"
                                            :selected="$place->id === $staff->organization_place_of_business_id"/>
                                    @endforeach
                                </x-form.element.select>
                            </x-data-table.td>
                            <x-data-table.td
                                class="col-md-2 col-auto">
                                <x-form.element.input
                                    name="staff[{{$key}}][name]"
                                    :value="$staff->name"
                                    :readonly="$staff->trashed()"/>
                            </x-data-table.td>
                            <x-data-table.td
                                class="col-md col-auto">
                                <x-form.element.select
                                    name="staff[{{$key}}][post]"
                                    :readonly="$staff->trashed()">
                                    @foreach($posts as $value => $post)
                                        <x-form.element.option
                                            :value="$value"
                                            :text="$post"
                                            :selected="$value === $staff->post"/>
                                    @endforeach
                                </x-form.element.select>
                            </x-data-table.td>
                            <x-data-table.td
                                class="col-md-1 col-auto text-center">
                                <x-data-table.button.soft-delete
                                    :trashed="$staff->trashed()"
                                    id="staff-{{$staff->id}}"
                                    route="organization.staff"
                                    :params="['staff' => $staff->id]"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto">
                <ul class="list-inline mb-0">
                    @if(count($organization->staff) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="staff_main_form"/>
                        </li>
                    @endif
                    <li class="list-inline-item">
                        <x-data-table.filter.trashed-filter id="staff_table"/>
                    </li>
                </ul>
            </footer>
        </x-form>
    </div>
</x-form.nav-tab>
