<x-form
    :route="route('organization.trailers.store')"
    formId="trailers_add_form">
    <input type="hidden"
           name="trailer[organization_id]"
           value="{{$organization->id}}">
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="trailer_type"
                :text="__('contractors.trailers.type')"/>
        </x-slot>
        <x-form.element.select
            name="trailer[type]">
            <x-form.element.option
                value="п"
                text="п"/>
            <x-form.element.option
                value="п/п"
                text="п/п"/>
        </x-form.element.select>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="trailer_state_number"
                :text="__('contractors.trailers.state_number')"/>
        </x-slot>
        <x-form.element.input
            id="trailer_state_number"
            name="trailer[state_number]"
            :required="true"/>
    </x-form.row>
    <footer class="mt-auto me-auto">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <x-form.button.save formId="trailers_add_form"/>
            </li>
        </ul>
    </footer>
</x-form>
