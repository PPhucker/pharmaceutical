@php use Illuminate\Support\Carbon; @endphp
@roles(['marketing'])
<x-forms.collapse.card route="{{route('contracts.update', ['contract' => 1])}}"
                       cardId="card_contracts"
                       formId="form_contracts"
                       title="{{__('contractors.contracts.contracts')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_contracts"
                       targets='-1,-2'
                       domOrderType="{{true}}">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_contracts"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('contractors.contracts.organization_id')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.contracts.number')}}
                </th>
                <th scope="col"
                    class="text-center border-start">
                    {{__('contractors.contracts.date')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.contracts.comment')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('contractors.contracts.is_valid')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($contractor->contracts as $key => $contract)
                <tr @if($contract->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="contracts[{{$key}}][id]"
                           value="{{$contract->id}}">
                    <input type="hidden"
                           name="contracts[{{$key}}][contractor_id]"
                           value="{{$contract->contractor_id}}">
                    <td class="border-start">
                        <span class="d-none">
                            {{$contract->organization->legalForm->abbreviation}} {{$contract->organization->name}}
                        </span>
                        <select name="contracts[{{$key}}][organization_id]"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('contracts.' . $key . '.organization_id') is-invalid @enderror">
                            @foreach($organizations as $organization)
                                <option value="{{$organization->id}}"
                                        @if($organization->id === $contract->organization_id) selected @endif>
                                    {{$contract->organization->legalForm->abbreviation}} {{$contract->organization->name}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="contracts.{{$key}}.organization_id"/>
                    </td>
                    <td>
                        <span class="d-none">
                            {{$contract->number}}
                        </span>
                        <input type="text"
                               name="contracts[{{$key}}][number]"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('contracts.' . $key . '.number') is-invalid @enderror"
                               value="{{$contract->number}}">
                        <x-forms.span-error name="contracts.{{$key}}.number"/>
                    </td>
                    <td>
                        <span class="d-none">
                            {{$contract->date}}
                        </span>
                        <input type="date"
                               name="contracts[{{$key}}][date]"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('contracts.' . $key . '.date') is-invalid @enderror"
                               value="{{Carbon::create($contract->date)->format('Y-m-d')}}">
                        <x-forms.span-error name="contracts.{{$key}}.date"/>
                    </td>
                    <td class="align-middle text-center">
                        <span class="d-none">
                            {{$contract->comment}}
                        </span>
                        <textarea class="form-control form-control-sm text-primary
                                   @error('contracts.' . $key . '.comment') is-invalid @enderror"
                                  rows="1"
                                  name="contracts[{{$key}}][comment]">{{$contract->comment}}</textarea>
                        <x-forms.span-error name="contracts.{{$key}}.comment"/>
                    </td>
                    <td class="text-center">
                        <span class="d-none">
                            @if($contract->is_valid)
                                {{__('form.yes')}}
                            @else
                                {{__('form.no')}}
                            @endif
                        </span>
                        <input type="checkbox"
                               name="contracts[{{$key}}][is_valid]"
                               value="1"
                               class="form-check-input mt-2
                               @error('contracts.' . $key . '.is_valid') is-invalid @enderror"
                               @if($contract->is_valid) checked @endif>
                        <x-forms.span-error name="contracts.{{$key}}.is_valid"/>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($contract->trashed())
                            <x-buttons.restore
                                route="{{route('contracts.restore', ['contract' => $contract->id])}}"
                                itemId="contracts-{{$contract->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('contracts.destroy', ['contract' => $contract->id])}}"
                                itemId="contracts-{{$contract->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        @if(count($contractor->contracts) > 0)
            <x-buttons.save formId="form_contracts"/>
        @endif
        <x-buttons.collapse formId="div_add_contract"/>
    </x-slot>
</x-forms.collapse.card>
@end_roles
