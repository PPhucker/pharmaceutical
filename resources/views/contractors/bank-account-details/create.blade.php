<x-forms.collapse.creation cardId="div_add_bank_account_detail"
                           errorName="bank_account_detail.*">
    <x-slot name="cardBody">
        <form id="form_add_bank_account_detail"
              method="POST"
              action="{{route('bank_account_details.store')}}">
            @csrf
            <input type="hidden"
                   name="bank_account_detail[contractor_id]"
                   value="{{$contractor->id}}">
            <x-forms.row id="bank"
                         label="{{__('contractors.bank_account_details.bank')}}">
                <select id="bank"
                        name="bank_account_detail[bank]"
                        class="form-control form-control-sm text-primary
                        @error('bank_account_detail.bank') is-invalid @enderror">
                    @foreach($banks as $bank)
                        <option value="{{$bank->BIC}}">
                            {{"$bank->name ---- $bank->BIC"}}
                        </option>
                    @endforeach
                </select>
                <x-forms.span-error name="bank_account_detail.bank"/>
            </x-forms.row>
            <x-forms.row id="payment_account"
                         label="{{__('contractors.bank_account_details.payment_account')}}">
                <input id="payment_account"
                       name="bank_account_detail[payment_account]"
                       type="text"
                       value="{{old('bank_account_details[payment_account]')}}"
                       class="form-control form-control-sm text-primary
                       @error('bank_account_detail.payment_account') is-invalid @enderror"
                       required>
                <x-forms.span-error name="bank_account_detail.payment_account"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_bank_account_detail"/>
    </x-slot>
</x-forms.collapse.creation>
