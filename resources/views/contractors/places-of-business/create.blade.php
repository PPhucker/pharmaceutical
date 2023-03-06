<x-forms.collapse.creation cardId="div_add_place_of_business"
                           errorName="place_of_business.*">
    <x-slot name="cardBody">
        <form id="form_add_place_of_business"
              method="POST"
              action="{{route('places_of_business.store')}}">
            @csrf
            <input type="hidden"
                   id="contractor_id"
                   name="place_of_business[contractor_id]"
                   value="{{$contractor->id}}">
            <x-forms.row id="identifier"
                         label="{{__('contractors.places_of_business.identifier')}}">
                <input id="identifier"
                       type="text"
                       class="form-control form-control-sm text-primary
                           @error('place_of_business.identifier') is-invalid @enderror"
                       name="place_of_business[identifier]"
                       value="{{old('place_of_business[identifier]')}}"
                       required>
                <x-forms.span-error name="place_of_business.identifier"/>
            </x-forms.row>
            <x-forms.row id="index" label="{{__('contractors.places_of_business.index')}}">
                <input id="index"
                       type="text"
                       class="form-control form-control-sm text-primary
                           @error('place_of_business.index') is-invalid @enderror"
                       name="place_of_business[index]"
                       value="{{old('place_of_business[index]')}}"
                       required>
                <x-forms.span-error name="place_of_busuness.index"/>
            </x-forms.row>
            <x-forms.row id="address"
                         label="{{__('contractors.places_of_business.address')}}">
                <input id="address"
                       type="text"
                       class="form-control form-control-sm text-primary
                           @error('place_of_business.address') is-invalid @enderror"
                       name="place_of_business[address]"
                       value="{{old('place_of_business[address]')}}"
                       required>
                <x-forms.span-error name="place_of_business.address"/>
            </x-forms.row>
            <x-forms.row id="registered"
                         label="{{__('contractors.places_of_business.registered')}}">
                <ul class="list-inline mb-0 mt-2">
                    <li class="list-inline-item">
                        <input class="form-check-input mb-2"
                               type="checkbox"
                               id="registered"
                               name="place_of_business[registered]"
                               value="1">
                        <x-forms.span-error name="place_of_business.registered"/>
                    </li>
                </ul>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_place_of_business"/>
    </x-slot>
</x-forms.collapse.creation>
<script>
    $('#address, #index').suggestions({
        token: $('#dadata_token').val(),
        type: 'ADDRESS',
        onSelect: function(suggestion) {
            const address = suggestion.data;
            $('#index').val(DaData.showPostalCode(address));
            $('#address').val(DaData.showAddress(address));
        },
    });
</script>
