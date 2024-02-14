<x-card
    :title="__('form.titles.add') . ' ' . __('classifiers.regions.region')"
    :back="route('regions.index')"
    class="sticky-top">
    <x-form
        formId="region_add_form"
        :route="route('regions.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="region_name"
                    :text="__('classifiers.regions.name')"/>
            </x-slot>
            <x-form.element.input
                id="region_name"
                name="region[name]"
                :required="true"
                max="120"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="zone"
                    :text="__('classifiers.regions.zone')"/>
            </x-slot>
            <x-form.element.input
                id="zone"
                name="region[zone]"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="region_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
