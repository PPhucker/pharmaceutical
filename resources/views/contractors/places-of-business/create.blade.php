<x-form
    :route="route('places_of_business.store')"
    formId="places_add_form">
    <input type="hidden"
           name="place_of_business[contractor_id]"
           value="{{$contractor->id}}">
    @roles(['digital_communication'])
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="identifier"
                :text="__('contractors.places_of_business.identifier')"/>
        </x-slot>
        <x-form.element.input
            id="identifier"
            name="place_of_business[identifier]"/>
    </x-form.row>
    @end_roles
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="address"
                :text="__('contractors.places_of_business.address')"/>
        </x-slot>
        <x-form.element.input
            id="address"
            name="place_of_business[address]"
            :required="true"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="index"
                :text="__('contractors.places_of_business.index')"/>
        </x-slot>
        <x-form.element.input
            id="index"
            name="place_of_business[index]"
            :required="true"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="registered"
                :text="__('contractors.places_of_business.registered')"/>
        </x-slot>
        <x-form.element.input
            id="registered"
            type="checkbox"
            class="form-check-input mt-2"
            name="place_of_business[registered]"/>
    </x-form.row>
    <footer class="mt-auto me-auto">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <x-form.button.save formId="places_add_form"/>
            </li>
        </ul>
    </footer>
</x-form>
