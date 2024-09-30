<x-card
    :title="__('form.titles.add')"
    :back="route('types_of_aggregation.index')">
    <x-form
        formId="type_of_aggregation_add_form"
        :route="route('types_of_aggregation.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="type_code"
                    :text="__('classifiers.nomenclature.products.types_of_aggregation.code')"/>
            </x-slot>
            <x-form.element.input
                id="type_code"
                name="type_of_aggregation[code]"
                :required="true"
                max="10"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="type_name"
                    :text="__('classifiers.nomenclature.products.types_of_aggregation.name')"/>
            </x-slot>
            <x-form.element.input
                id="type_name"
                name="type_of_aggregation[name]"
                :required="true"
                max="20"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="type_of_aggregation_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
