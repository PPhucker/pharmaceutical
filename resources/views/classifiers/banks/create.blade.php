<x-card
    :title="__('form.titles.add') . ' ' . __('classifiers.banks.bank')"
    :back="route('banks.index')"
    class="sticky-top">
    <x-form
        formId="bank_add_form"
        :route="route('banks.store')">
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="bank_name"
                    :text="__('classifiers.banks.name')"/>
            </x-slot>
            <x-form.element.input
                id="bank_name"
                name="bank[name]"
                :value="old('bank.BIC')"
                :required="true"
                max="120"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="BIC"
                    :text="__('classifiers.banks.BIC')"/>
            </x-slot>
            <x-form.element.input
                id="BIC"
                name="bank[BIC]"
                :value="old('bank.BIC')"
                :required="true"
                min="9"
                max="9"/>
        </x-form.row>
        <x-form.row>
            <x-slot name="label">
                <x-form.label
                    forId="correspondent_account"
                    :text="__('classifiers.banks.correspondent_account')"/>
            </x-slot>
            <x-form.element.input
                id="correspondent_account"
                name="bank[correspondent_account]"
                :value="old('bank.correspondent_account')"
                :required="true"
                min="20"
                max="20"/>
        </x-form.row>
        <footer class="mt-auto me-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <x-form.button.save formId="bank_add_form"/>
                </li>
            </ul>
        </footer>
    </x-form>
</x-card>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#bank_name, #BIC').suggestions({
            token: $('#dadata_token').val(),
            type: 'BANK',
            onSelect: function(suggestion) {
                $('#bank_name').val(suggestion.value);
                $('#BIC').val(suggestion.data.bic);
                $('#correspondent_account').val(suggestion.data.correspondent_account);
            },
        });
    });
</script>
