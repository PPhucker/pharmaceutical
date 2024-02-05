<x-form.nav-tab
    formId="trailers_main_form">
    <div class="row">
        <div class="col-md col-auto mb-2">
            @include('admin.organizations.trailers.create')
        </div>
        <div class="col-md-12">
            <x-form
                :route="route('organization.trailers.update', ['trailer' => $organization->trailers->first()->id ?? 1])"
                formId="trailers_main_form"
                method="PATCH">
                <x-data-table.table
                    id="trailers_main_table"
                    type="edit"
                    targets="-1">
                    <x-data-table.head>
                        <x-data-table.th
                            :text="__('contractors.trailers.type')">
                        </x-data-table.th>
                        <x-data-table.th
                            :text="__('contractors.trailers.state_number')">
                        </x-data-table.th>
                        <x-data-table.th/>
                    </x-data-table.head>
                    <x-data-table.body>
                        @foreach($organization->trailers as $key => $trailer)
                            <x-data-table.tr
                                :model="$trailer">
                                <x-slot name="hiddenInputs">
                                    <input type="hidden"
                                           name="trailers[{{$key}}][id]"
                                           value="{{$trailer->id}}">
                                    <input type="hidden"
                                           name="trailers[{{$key}}][organization_id]"
                                           value="{{$organization->id}}">
                                </x-slot>
                                <x-data-table.td>
                                    <x-form.element.select
                                        name="trailers[{{$key}}][type]"
                                        :readonly="$trailer->trashed()">
                                        <x-form.element.option
                                            value="п"
                                            text="п"
                                            :selected="$trailer->type === 'п'"/>
                                        <x-form.element.option
                                            value="п/п"
                                            text="п/п"
                                            :selected="$trailer->type === 'п/п'"/>
                                    </x-form.element.select>
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-form.element.input
                                        name="trailers[{{$key}}][state_number]"
                                        :value="$trailer->state_number"
                                        :required="true"/>
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-data-table.button.soft-delete
                                        :trashed="$trailer->trashed()"
                                        :id="$trailer->id"
                                        route="organization.trailers"
                                        :params="['trailer' => $trailer->id]"/>
                                </x-data-table.td>
                            </x-data-table.tr>
                        @endforeach
                    </x-data-table.body>
                </x-data-table.table>
                <footer class="mt-auto">
                    <ul class="list-inline mb-0">
                        @if(count($organization->trailers) > 0)
                            <li class="list-inline-item">
                                <x-form.button.save formId="trailers_main_form"/>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <x-data-table.filter.trashed-filter id="trailers_main_table"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </div>
    </div>
</x-form.nav-tab>
