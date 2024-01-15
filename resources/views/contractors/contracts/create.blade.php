<x-form
    :route="route('contracts.store')"
    formId="contracts_add_form">
    <input type="hidden"
           id="contractor_id"
           name="contract[contractor_id]"
           value="{{$contractor->id}}">
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="contract_organization_id"
                :text="__('contractors.contracts.organization_id')"/>
        </x-slot>
        <x-form.element.select
            id="contract_organization_id"
            name="contract[organization_id]"
            :required="true">
            @foreach($organizations as $organization)
                <x-form.element.option
                    :value="$organization->id"
                    :selected="(int)old('contract[organization_id]') === $organization->id"
                    :text="$organization->name"/>
            @endforeach
        </x-form.element.select>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="contract_number"
                :text="__('contractors.contracts.number')"/>
        </x-slot>
        <x-form.element.input
            id="contract_number"
            name="contract[number]"
            :value="old('contract[number]')"
            :required="true"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="contract_date"
                :text="__('contractors.contracts.date')"/>
        </x-slot>
        <x-form.element.input
            id="contract_date"
            name="contract[date]"
            type="date"
            :value="old('contract[number]')"
            :required="true"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="contract_is_valid"
                :text="__('contractors.contracts.is_valid')"/>
        </x-slot>
        <x-form.element.input
            id="contract_is_valid"
            name="contract[is_valid]"
            type="checkbox"
            class="form-check-input mt-2"
            :value="1"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="contract_comment"
                :text="__('contractors.contracts.comment')"/>
        </x-slot>
        <x-form.element.textarea
            id="contract_comment"
            name="contract[comment]"
            :text="old('contract[comment]')"/>
    </x-form.row>
    <footer class="mt-auto me-auto">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <x-form.button.save formId="contracts_add_form"/>
            </li>
        </ul>
    </footer>
</x-form>
