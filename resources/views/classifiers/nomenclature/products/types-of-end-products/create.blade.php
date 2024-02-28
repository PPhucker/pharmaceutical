<x-card
    :title="__('form.titles.add')"
    :back="route('types_of_end_products.store')">
    <x-form
        formId="type_of_end_product_add_form"
        :route="route('types_of_end_products.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="name"
                    :text="__('classifiers.nomenclature.products.types_of_end_products.name')"/>
            </x-slot>
            <x-form.element.input
                id="name"
                name="type_of_end_product[name]"
                :required="true"
                max="60"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="color"
                    :text="__('classifiers.nomenclature.products.types_of_end_products.color')"/>
            </x-slot>
            <x-form.element.input
                id="color"
                type="color"
                value="#ffffff"
                name="type_of_end_product[color]"
                class="form-control form-control-color"
                max="7"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="type_of_end_product_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
