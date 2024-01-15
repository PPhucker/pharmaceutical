<x-form
    :route="route('contact_persons.store')"
    formId="contact_persons_add_form">
    <input type="hidden"
           name="contact_person[contractor_id]"
           value="{{$contractor->id}}">
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="contact_person[name]"
                :text="__('contractors.contact_persons.name')"/>
        </x-slot>
        <x-form.element.input
            id="contact_person[name]"
            name="contact_person[name]"
            :value="old('contact_person[name]')"
            :required="true"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="contact_person[post]"
                :text="__('contractors.contact_persons.post')"/>
        </x-slot>
        <x-form.element.input
            id="contact_person[post]"
            name="contact_person[post]"
            :value="old('contact_person[post]')"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="contact_person[phone]"
                :text="__('contractors.contact_persons.phone')"/>
        </x-slot>
        <x-form.element.input
            id="contact_person[phone]"
            name="contact_person[phone]"
            :value="old('contact_person[phone]')"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="contact_person[email]"
                :text="__('contractors.contact_persons.email')"/>
        </x-slot>
        <x-form.element.input
            id="contact_person[email]"
            name="contact_person[email]"
            :value="old('contact_person[email]')"/>
    </x-form.row>
    <footer class="mt-auto me-auto">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <x-form.button.save formId="contact_persons_add_form"/>
            </li>
        </ul>
    </footer>
</x-form>
