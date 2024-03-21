<x-form.nav-tab
    formId="drivers_main_form">
    <div class="row">
        <div class="col-md col-auto mb-2">
            @include('admin.organizations.drivers.create')
        </div>
        <div class="col-md-12">
            <x-form
                :route="route('organization.drivers.update')"
                formId="drivers_main_form"
                method="PATCH">
                <x-data-table.table
                    id="drivers_main_table"
                    type="edit"
                    targets="-1">
                    <x-data-table.head>
                        <x-data-table.th
                            :text="__('contractors.drivers.name')"/>
                        <x-data-table.th/>
                    </x-data-table.head>
                    <x-data-table.body>
                        @foreach($organization->drivers as $key => $driver)
                            <x-data-table.tr
                                :model="$driver">
                                <x-slot name="hiddenInputs">
                                    <x-form.element.input type="hidden"
                                                          name="drivers[{{$key}}][id]"
                                                          value="{{$driver->id}}"/>
                                    <x-form.element.input type="hidden"
                                                          name="drivers[{{$key}}][organization_id]"
                                                          value="{{$organization->id}}"/>
                                </x-slot>
                                <x-data-table.td>
                                    <x-form.element.input
                                        name="drivers[{{$key}}][name]"
                                        :value="$driver->name"
                                        :required="true"/>
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-data-table.button.soft-delete
                                        :trashed="$driver->trashed()"
                                        id="driver-{{$driver->id}}"
                                        route="organization.drivers"
                                        :params="['driver' => $driver->id]"/>
                                </x-data-table.td>
                            </x-data-table.tr>
                        @endforeach
                    </x-data-table.body>
                </x-data-table.table>
                <footer class="mt-auto">
                    <ul class="list-inline mb-0">
                        @if(count($organization->drivers) > 0)
                            <li class="list-inline-item">
                                <x-form.button.save formId="drivers_main_form"/>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <x-data-table.filter.trashed-filter id="drivers_main_table"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </div>
    </div>
</x-form.nav-tab>
