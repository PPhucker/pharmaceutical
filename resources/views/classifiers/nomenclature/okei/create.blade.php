<x-card
    :title="__('form.titles.add')"
    :back="route('okei.index')"
    class="sticky-top">
    <x-form
        formId="okei_add_form"
        :route="route('okei.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="okei_code"
                    :text="__('classifiers.nomenclature.okei.code')"/>
            </x-slot>
            <x-form.element.input
                id="okei_code"
                name="okei[code]"
                :required="true"
                max="10"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="okei_unit"
                    :text="__('classifiers.nomenclature.okei.unit')"/>
            </x-slot>
            <x-form.element.input
                id="okei_unit"
                name="okei[unit]"
                :required="true"
                max="20"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="okei_symbol"
                    :text="__('classifiers.nomenclature.okei.symbol')"/>
            </x-slot>
            <x-form.element.input
                id="okei_symbol"
                name="okei[symbol]"
                :required="true"
                max="10"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="okei_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
