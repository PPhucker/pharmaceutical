<x-card
    :title="__('form.titles.add')"
    :back="route('legal_forms.index')"
    class="sticky-top">
    <x-form
        formId="legal_form_add_form"
        :route="route('legal_forms.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="abbreviation"
                    :text="__('classifiers.legal_forms.abbreviation')"/>
            </x-slot>
            <x-form.element.input
                id="abbreviation"
                name="legal_form[abbreviation]"
                :required="true"
                max="15"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="abbreviation"
                    :text="__('classifiers.legal_forms.decoding')"/>
            </x-slot>
            <x-form.element.input
                id="decoding"
                name="legal_form[decoding]"
                :required="true"
                max="120"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="legal_form_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
