<x-card
    :title="__('form.titles.add')"
    :back="route('registration_numbers.index')">
    <x-form
        formId="registration_number_add_form"
        :route="route('registration_numbers.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="number"
                    :text="__('classifiers.nomenclature.products.registration_numbers.number')"/>
            </x-slot>
            <x-form.element.input
                id="number"
                name="registration_number[number]"
                :required="true"
                max="30"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="egistration_number_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
