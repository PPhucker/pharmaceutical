<x-card
    :title="__('form.titles.add')"
    :back="route('international_names.index')">
    <x-form
        formId="international_names_add_form"
        :route="route('international_names.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="name"
                    :text="__('classifiers.nomenclature.products.international_names_of_end_products.name')"/>
            </x-slot>
            <x-form.element.input
                id="name"
                name="international_name_of_end_product[name]"
                :required="true"
                max="60"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="international_names_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
