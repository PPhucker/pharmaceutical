<x-card
    :title="__('form.titles.add')"
    :back="route('services.index')"
    class="sticky-top">
    <x-form
        formId="service_add_form"
        :route="route('services.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="service_name"
                    :text="__('classifiers.nomenclature.services.name')"/>
            </x-slot>
            <x-form.element.input
                id="service_name"
                name="service[name]"
                :required="true"
                max="255"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="okei_code"
                    :text="__('classifiers.nomenclature.okei.unit')"/>
            </x-slot>
            <x-form.element.select
                id="okei_code"
                name="service[okei_code]"
                :required="true">
                @foreach($okeiClassifier as $okei)
                    <x-form.element.option
                        :value="$okei->code"
                        :text="$okei->unit"/>
                @endforeach
            </x-form.element.select>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="service_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
