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
            <x-tables.main id="add_table_account_detail" targets="0">
                <thead class="bg-secondary">
                <tr class="text-primary small">
                    <th scope="col"
                        class="text-center">
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('contractors.bank_account_details.payment_account')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('contractors.bank_account_details.bank')}}
                    </th>
                    <th scope="col"
                        class="text-center">
                        {{__('contractors.bank_account_details.BIC')}}
                    </th>
                </tr>
                </thead>
                <tbody class="text-primary">
                @foreach($banks as $key => $bank)
                    <tr class="small">
                        <td class="align-middle text-center">
                            <input type="radio"
                                   id="bank_account_detail[{{$key}}][bank]"
                                   name="bank_account_detail[bank]"
                                   value="{{$bank->BIC}}"
                                   class="form-check-input
                                @error('bank_account_detail.bank') is-invalid @enderror">
                        </td>
                        <td class="align-middle">
                            <input id="bank_account_detail[payment_account][{{$bank->BIC}}]"
                                   name="bank_account_detail[payment_account][{{$bank->BIC}}]"
                                   type="text"
                                   minlength="20"
                                   maxlength="20"
                                   value="{{old("bank_account_detail[payment_account][{{$bank->BIC}]")}}"
                                   class="form-control form-control-sm text-primary
                       @error('bank_account_detail.payment_account.' . $bank->BIC) is-invalid @enderror"
                                   required>
                        </td>
                        <td class="align-middle">
                            {{$bank->name}}
                        </td>
                        <td class="align-middle text-center">
                            {{$bank->BIC}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </x-tables.main>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_bank_account_detail"/>
    </x-slot>
</x-forms.collapse.creation>
