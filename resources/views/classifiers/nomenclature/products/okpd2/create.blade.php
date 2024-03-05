<x-card
    :title="__('form.titles.add')"
    :back="route('okpd2.index')"
    class="sticky-top">
    <x-form
        formId="okpd2_add_form"
        :route="route('okpd2.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="okpd2_code"
                    :text="__('classifiers.nomenclature.products.okpd2.code')"/>
            </x-slot>
            <x-form.element.input
                id="okpd2_code"
                name="okpd2[code]"
                :required="true"
                max="20"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="okpd2_name"
                    :text="__('classifiers.nomenclature.products.okpd2.name')"/>
            </x-slot>
            <x-form.element.input
                id="okpd2_name"
                name="okpd2[name]"
                :required="true"
                max="150"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="okpd2_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
