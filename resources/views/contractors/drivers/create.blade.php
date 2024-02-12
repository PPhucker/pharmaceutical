<x-form
    :route="route('drivers.store')"
    formId="drivers_add_form">
    <input type="hidden"
           name="driver[contractor_id]"
           value="{{$contractor->id}}">
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="driver_name"
                :text="__('contractors.drivers.name')"/>
        </x-slot>
        <x-form.element.input
            id="driver_name"
            name="driver[name]"
            :required="true"/>
    </x-form.row>
    <footer class="mt-auto me-auto">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <x-form.button.save formId="drivers_add_form"/>
            </li>
        </ul>
    </footer>
</x-form>
