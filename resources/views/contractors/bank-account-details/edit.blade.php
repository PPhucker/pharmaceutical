<x-form.nav-tab
    formId="account_details_main_form">
    <div class="row">
        <div class="col-md-12">
            <div class="collapse card border-0"
                 id="account_details_add_card">
                <div class="card-header bg-primary text-white">
                    {{__('form.titles.add')}}
                </div>
                <div class="card-body p-1 border-0">
                    @include('contractors.bank-account-details.create')
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <x-form
                :route="route('bank_account_details.update', ['bank_account_detail' => $contractor->bankAccountDetails->first()->id ?? null])"
                formId="account_details_main_form"
                method="PATCH">
                <x-data-table.table
                    id="account_details_main_table"
                    type="edit"
                    targets="-1">
                    <x-data-table.head>
                        <x-data-table.th
                            :text="__('contractors.bank_account_details.bank')"/>
                        <x-data-table.th
                            :text="__('contractors.bank_account_details.payment_account')"/>
                        <x-data-table.th
                            :text="__('classifiers.banks.BIC')"/>
                        <x-data-table.th
                            :text="__('classifiers.banks.correspondent_account')"/>
                        <x-data-table.th/>
                    </x-data-table.head>
                    <x-data-table.body>
                        @foreach($contractor->bankAccountDetails as $key => $account)
                            <x-data-table.tr
                                :model="$account">
                                <x-slot name="hiddenInputs">
                                    <x-form.element.input type="hidden"
                                                          name="bank_account_details[{{$key}}][id]"
                                                          value="{{$account->id}}"/>
                                </x-slot>
                                <x-data-table.td
                                    class="text-start">
                                    {{$account->bankClassifier->name}}
                                </x-data-table.td>
                                <x-data-table.td
                                    class="col-md-2 col-auto">
                                    <x-form.element.input
                                        name="bank_account_details[{{$key}}][payment_account]"
                                        :value="$account->payment_account"
                                        :required="true"
                                        max="20"
                                        min="20"/>
                                </x-data-table.td>
                                <x-data-table.td>
                                    {{$account->bankClassifier->BIC}}
                                </x-data-table.td>
                                <x-data-table.td>
                                    {{$account->bankClassifier->correspondent_account}}
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-data-table.button.soft-delete
                                        :trashed="$account->trashed()"
                                        :id="$account->id"
                                        route="bank_account_details"
                                        :params="['bank_account_detail' => $account->id]"/>
                                </x-data-table.td>
                            </x-data-table.tr>
                        @endforeach
                    </x-data-table.body>
                </x-data-table.table>
                <footer class="mt-auto">
                    <ul class="list-inline mb-0">
                        @if(count($contractor->bankAccountDetails) > 0)
                            <li class="list-inline-item">
                                <x-form.button.save formId="account_details_main_form"/>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <x-form.button.collapse
                                divId="account_details_add_card"
                                :title="__('form.titles.add')"/>
                        </li>
                        <li class="list-inline-item">
                            <x-data-table.filter.trashed-filter id="account_details_main_table"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </div>
    </div>
</x-form.nav-tab>
