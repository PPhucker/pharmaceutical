@roles(['marketing'])
<x-form.nav-tab
    formId="contact_persons_main_form">
    <div class="row">
        <div class="col-md-12 col-auto">
            @include('contractors.contact-persons.create')
        </div>
        <div class="col-md-12 col-auto">
            <x-form
                :route="route('contact_persons.update', ['contact_person' => $contractor->contactPersons->first()->id ?? null])"
                formId="contact_persons_main_form"
                method="PATCH">
                <x-data-table.table
                    id="contact_persons_main_table"
                    type="edit"
                    targets="-1">
                    <x-data-table.head>
                        <x-data-table.th
                            :text="__('contractors.contact_persons.name')"/>
                        <x-data-table.th
                            :text="__('contractors.contact_persons.post')"/>
                        <x-data-table.th
                            :text="__('contractors.contact_persons.phone')"/>
                        <x-data-table.th
                            :text="__('contractors.contact_persons.email')"/>
                        <x-data-table.th/>
                    </x-data-table.head>
                    <x-data-table.body>
                        @foreach($contractor->contactPersons as $key => $contactPerson)
                            <x-data-table.tr
                                :model="$contactPerson">
                                <x-slot name="hiddenInputs">
                                    <x-form.element.input type="hidden"
                                                          name="contact_persons[{{$key}}][id]"
                                                          value="{{$contactPerson->id ?? null}}"/>
                                </x-slot>
                                <x-data-table.td
                                    class="">
                                    <x-form.element.input
                                        name="contact_persons[{{$key}}][name]"
                                        :value="$contactPerson->name"
                                        :required="true"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="">
                                    <x-form.element.input
                                        name="contact_persons[{{$key}}][post]"
                                        :value="$contactPerson->post"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="">
                                    <x-form.element.input
                                        name="contact_persons[{{$key}}][phone]"
                                        :value="$contactPerson->phone"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="">
                                    <x-form.element.input
                                        name="contact_persons[{{$key}}][email]"
                                        :value="$contactPerson->email"/>
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-data-table.button.soft-delete
                                        :trashed="$contactPerson->trashed()"
                                        id="contact-person-{{$contactPerson->id}}"
                                        route="contact_persons"
                                        :params="['contact_person' => $contactPerson->id]"/>
                                </x-data-table.td>
                            </x-data-table.tr>
                        @endforeach
                    </x-data-table.body>
                </x-data-table.table>
                <footer class="mt-auto">
                    <ul class="list-inline mb-0">
                        @if(count($contractor->contactPersons) > 0)
                            <li class="list-inline-item">
                                <x-form.button.save formId="contact_persons_main_form"/>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <x-data-table.filter.trashed-filter id="contact_persons_main_table"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </div>
    </div>
</x-form.nav-tab>
@end_roles
