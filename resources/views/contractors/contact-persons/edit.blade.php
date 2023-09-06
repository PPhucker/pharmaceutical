@roles(['marketing'])
<x-forms.collapse.card route="{{route('contact_persons.update', ['contact_person' => 1])}}"
                       cardId="card_contact_persons"
                       formId="form_contact_persons"
                       title="{{__('contractors.contact_persons.contact_persons')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_contact_persons"
                       targets="-1"
                       domOrderType="{{true}}">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_contact_persons"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('contractors.contact_persons.name')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.contact_persons.post')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.contact_persons.phone')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.contact_persons.email')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($contractor->contactPersons as $key => $contactPerson)
                <tr @if($contactPerson->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="contact_persons[{{$key}}][id]"
                           value="{{$contactPerson->id}}">
                    <td>
                        <span class="d-none">
                            {{$contactPerson->name}}
                        </span>
                        <input type="text"
                               name="contact_persons[{{$key}}][name]"
                               value="{{$contactPerson->name}}"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('contact_persons.' . $key . '.name') is-invalid @enderror">
                        <x-forms.span-error name="contact_persons.{{$key}}.name"/>
                    </td>
                    <td>
                        <span class="d-none">
                            {{$contactPerson->post}}
                        </span>
                        <input type="text"
                               name="contact_persons[{{$key}}][post]"
                               value="{{$contactPerson->post}}"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('contact_persons.' . $key . '.post') is-invalid @enderror">
                        <x-forms.span-error name="contact_persons.{{$key}}.post"/>
                    </td>
                    <td>
                        <span class="d-none">
                            {{$contactPerson->phone}}
                        </span>
                        <input type="text"
                               name="contact_persons[{{$key}}][phone]"
                               value="{{$contactPerson->phone}}"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('contact_persons.' . $key . '.phone') is-invalid @enderror">
                        <x-forms.span-error name="contact_persons.{{$key}}.phone"/>
                    </td>
                    <td>
                        <span class="d-none">
                            {{$contactPerson->email}}
                        </span>
                        <input type="text"
                               name="contact_persons[{{$key}}][email]"
                               value="{{$contactPerson->email}}"
                               class="form-control form-control-sm text-primary mb-1 mt-1
                               @error('contact_persons.' . $key . '.email') is-invalid @enderror">
                        <x-forms.span-error name="contact_persons.{{$key}}.email"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if($contactPerson->trashed())
                            <x-buttons.restore
                                route="{{route('contact_persons.restore', ['contact_person' => $contactPerson->id])}}"
                                itemId="staff-{{$contactPerson->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('contact_persons.destroy', ['contact_person' => $contactPerson->id])}}"
                                itemId="staff-{{$contactPerson->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        @if(count($contractor->contactPersons) > 0)
            <x-buttons.save formId="form_contact_persons"/>
        @endif
        <x-buttons.collapse formId="div_add_contact_person"/>
    </x-slot>
</x-forms.collapse.card>
@end_roles
