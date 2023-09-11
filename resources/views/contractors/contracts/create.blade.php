<x-forms.collapse.creation cardId="div_add_contract"
                           errorName="contract.*">
    <x-slot name="cardBody">
        <form id="form_add_contract"
              method="POST"
              action="{{route('contracts.store')}}">
            @csrf
            <input type="hidden"
                   id="contractor_id"
                   name="contract[contractor_id]"
                   value="{{$contractor->id}}">
            <x-forms.row id="organization_id"
                         label="{{__('contractors.contracts.organization_id')}}">
                <select id="organization_id"
                        name="contract[organization_id]"
                        class="form-control form-control-sm text-primary
                           @error('place_of_business.identifier') is-invalid @enderror"
                        required>
                    @foreach($organizations as $organization)
                        <option value="{{$organization->id}}"
                                @if((int)old('contract[organization_id]') === $organization->id) selected @endif>
                            {{$organization->legalForm->abbreviation}} {{$organization->name}}
                        </option>
                    @endforeach
                </select>
                <x-forms.span-error name="contractor.organization_id"/>
            </x-forms.row>
            <x-forms.row id="number"
                         label="{{__('contractors.contracts.number')}}">
                <input id="number"
                       type="text"
                       class="form-control form-control-sm text-primary
                           @error('contract.number') is-invalid @enderror"
                       name="contract[number]"
                       value="{{old('contract.number')}}">
                <x-forms.span-error name="contract.number"/>
            </x-forms.row>
            <x-forms.row id="date"
                         label="{{__('contractors.contracts.date')}}">
                <input id="date"
                       type="date"
                       class="form-control form-control-sm text-primary
                           @error('contract.date') is-invalid @enderror"
                       name="contract[date]"
                       value="{{old('contract.date')}}"
                       required>
                <x-forms.span-error name="contract.date"/>
            </x-forms.row>
            <x-forms.row id="is_valid"
                         label="{{__('contractors.contracts.is_valid')}}">
                <input class="form-check-input mt-2"
                       type="checkbox"
                       id="is_valid"
                       name="contract[is_valid]"
                       value="1">
                <x-forms.span-error name="contract.id_valid"/>
            </x-forms.row>
            <x-forms.row id="comment"
                         label="{{__('contractors.contracts.comment')}}">
                <textarea id="comment"
                          class="form-control form-control-sm text-primary
                           @error('contract.comment') is-invalid @enderror"
                          name="contract[comment]">{{old('contract.comment')}}</textarea>
                <x-forms.span-error name="contract.comment"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_contract"/>
    </x-slot>
</x-forms.collapse.creation>
