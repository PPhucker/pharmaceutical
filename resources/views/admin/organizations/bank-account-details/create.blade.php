<x-form
    :route="route('organization.bank_account_details.store')"
    formId="account_details_add_form"
    class="mt-2">
    <input type="hidden"
           name="bank_account_detail[organization_id]"
           value="{{$organization->id}}">
    <x-data-table.table
        id="account_details_add_table"
        type="create"
        targets="0,1"
        pageLength="5">
        <x-data-table.head>
            <x-data-table.th/>
            <x-data-table.th
                class="col-md-3"
                :text="__('contractors.bank_account_details.payment_account')"/>
            <x-data-table.th
                :text="__('contractors.bank_account_details.bank')"/>
            <x-data-table.th
                :text="__('contractors.bank_account_details.BIC')"/>
        </x-data-table.head>
        <x-data-table.body>
            @foreach($banks as $key => $bank)
                <x-data-table.tr>
                    <x-data-table.td>
                        <x-form.element.input
                            id="bank_account_detail[{{$key}}][bank]"
                            name="bank_account_detail[bank]"
                            :value="$bank->BIC"
                            type="radio"
                            class="form-check-input"/>
                    </x-data-table.td>
                    <x-data-table.td>
                        <x-form.element.input
                            name="bank_account_detail[payment_account][{{$bank->BIC}}]"
                            :value="old('bank_account_detail[payment_account][{{$bank->BIC}}]')"
                            min="20"
                            max="20"/>
                    </x-data-table.td>
                    <x-data-table.td
                        class="text-start">
                        {{$bank->name}}
                    </x-data-table.td>
                    <x-data-table.td>
                        {{$bank->BIC}}
                    </x-data-table.td>
                </x-data-table.tr>
            @endforeach
        </x-data-table.body>
    </x-data-table.table>
    <footer class="mt-auto me-auto sticky-top">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <x-form.button.save formId="account_details_add_form"/>
            </li>
        </ul>
    </footer>
</x-form>
