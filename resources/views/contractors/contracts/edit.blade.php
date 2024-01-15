@php use Carbon\Carbon; @endphp
<x-form.nav-tab formId="contracts_main_form">
    <div class="row">
        <div class="col-md col-auto mb-2">
            @include('contractors.contracts.create')
        </div>
        <div class="col-md-12 col-auto">
            <x-form
                :route="route('contracts.update', ['contract' => $contractor->contracts()->first()->id ?? 1])"
                method="PATCH">
                <x-data-table.table
                    id="contracts"
                    type="edit"
                    targets="-1">
                    <x-data-table.head>
                        <x-data-table.th
                            :text="__('contractors.contracts.organization_id')"/>
                        <x-data-table.th
                            :text="__('contractors.contracts.number')"/>
                        <x-data-table.th
                            :text="__('contractors.contracts.date')"/>
                        <x-data-table.th
                            :text="__('contractors.contracts.comment')"/>
                        <x-data-table.th
                            :text="__('contractors.contracts.is_valid')"/>
                        <x-data-table.th/>
                    </x-data-table.head>
                    <x-data-table.body>
                        @foreach($contractor->contracts as $key => $contract)
                            <x-data-table.tr :model="$contract">
                                <x-slot name="hiddenInputs">
                                    <input type="hidden"
                                           name="contracts[{{$key}}][id]"
                                           value="{{$contract->id}}">
                                    <input type="hidden"
                                           name="contracts[{{$key}}][contractor_id]"
                                           value="{{$contract->contractor_id}}">
                                </x-slot>
                                <x-data-table.td
                                    class="col-md-1 col-auto">
                                    <x-form.element.select
                                        name="contracts[{{$key}}][organization_id]"
                                        :readonly="$contract->trashed()">
                                        @foreach($organizations as $organization)
                                            <x-form.element.option
                                                :value="$organization->id"
                                                :text="$organization->name"
                                                :selected="$organization->id === $contract->organization_id"/>
                                        @endforeach
                                    </x-form.element.select>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="col-md-1 col-auto">
                                    <x-form.element.input
                                        name="contracts[{{$key}}][number]"
                                        :value="$contract->number"
                                        :readonly="$contract->trashed()"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="col-md-1 col-auto">
                                    <x-form.element.input
                                        name="contracts[{{$key}}][date]"
                                        type="date"
                                        :value="Carbon::create($contract->date)->format('Y-m-d')"/>
                                </x-data-table.td>
                                <x-data-table.td>
                                    <x-form.element.textarea
                                        name="contracts[{{$key}}][comment]"
                                        :text="$contract->comment"
                                        rows="1"
                                        :readonly="$contract->trashed()"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="col-md-1 col-auto text-center">
                                    <x-form.element.input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="contracts[{{$key}}][is_valid]"
                                        :value="1"
                                        :checked="$contract->is_valid"/>
                                </x-data-table.td>
                                <x-data-table.td
                                    class="col-md-1 col-auto text-center">
                                    <x-data-table.button.soft-delete
                                        :trashed="$contract->trashed()"
                                        :id="$contract->id"
                                        route="contracts"
                                        :params="['contract' => $contract->id]"/>
                                </x-data-table.td>
                            </x-data-table.tr>
                        @endforeach
                    </x-data-table.body>
                </x-data-table.table>
                <footer class="mt-auto">
                    <ul class="list-inline mb-0">
                        @if(count($contractor->contracts) > 0)
                            <li class="list-inline-item">
                                <x-form.button.save formId="contracts_main_form"/>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <x-data-table.filter.trashed-filter id="contracts"/>
                        </li>
                    </ul>
                </footer>
            </x-form>
        </div>
    </div>
</x-form.nav-tab>
