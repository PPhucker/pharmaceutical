<x-card
    :title="__('form.titles.add')"
    :back="route('types_of_materials.index')">
    <x-form
        formId="type_of_material_add_form"
        :route="route('types_of_materials.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="type_name"
                    :text="__('classifiers.nomenclature.materials.types_of_materials.name')"/>
            </x-slot>
            <x-form.element.input
                id="type_name"
                name="type_of_material[name]"
                :required="true"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="type_of_material_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
