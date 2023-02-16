<x-forms.collapse.card route="{{route('bank_account_details.update')}}"
                       cardId="card_bank_account_details"
                       formId="form_bank_account_details"
                       title="{{__('contractors.bank_account_details.bank_account_details')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_bank_account_details"
                       targets='-1'
                       domOrderType="{{true}}">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_bank_account_details"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('contractors.bank_account_details.bank')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.bank_account_details.payment_account')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('classifiers.banks.BIC')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('classifiers.banks.correspondent_account')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($organization->bankAccountDetails as $key => $account)
                <tr @if($account->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="bank_account_details[{{$key}}][id]"
                           value="{{$account->id}}">
                    <td class="border-start">
                        <span class="d-none" name="print">
                            {{$account->bankClassifier->name}}
                        </span>
                        <select name="bank_account_details[{{$key}}][bank]"
                                class="form-control form-control-sm text-primary
                                @error('bank_account_details.' . $key . '.bank') is-invalid @enderror">
                            @foreach($banks as $bank)
                                <option value="{{$bank->BIC}}"
                                        @if($bank->BIC === $account->bank) selected @endif>
                                    {{$bank->name}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <span class="d-none">
                            {{$account->payment_account}}
                        </span>
                        <input name="bank_account_details[{{$key}}][payment_account]"
                               type="text"
                               value="{{$account->payment_account}}"
                               class="form-control form-control-sm text-primary
                                   @error('bank_account_details.' . $key . '.payment_account') is-invalid @enderror"
                               required>
                        <x-forms.span-error name="bank_account_details.{{$key}}.payment_account"/>
                    </td>
                    <td class="text-center align-middle">
                        {{$account->bankClassifier->BIC}}
                    </td>
                    <td class="text-center align-middle">
                        {{$account->bankClassifier->correspondent_account}}
                    </td>
                    <td class="text-center align-middle">
                        @if($account->trashed())
                            <x-buttons.restore
                                route="{{route('bank_account_details.restore', ['bank_account_detail' => $account->id])}}"
                                itemId="bankAccount-details-{{$account->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('bank_account_details.destroy', ['bank_account_detail' => $account->id])}}"
                                itemId="bankAccount-details-{{$account->id}}"/>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        @if(count($organization->bankAccountDetails) > 0)
            <x-buttons.save formId="form_bank_account_details"/>
        @endif
        <x-buttons.collapse formId="div_add_bank_account_detail"/>
    </x-slot>
</x-forms.collapse.card>
