<x-forms.collapse.creation cardId="div_add_driver"
                           errorName="drivers.*">
    <x-slot name="cardBody">
        <form id="form_add_driver"
              method="POST"
              action="{{route('drivers.store')}}">
            @csrf
            <input type="hidden"
                   name="driver[organization_id]"
                   value="{{$organization->id}}">
            <x-forms.row id="driver-name"
                         label="{{__('contractors.drivers.name')}}">
                <input type="text"
                       name="driver[name]"
                       id="driver-name"
                       value="{{old('driver[name]')}}"
                       class="form-control form-control-sm text-primary
                       @error('driver.name') is-invalid @enderror"
                       required>
                <x-forms.span-error name="driver.name"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_driver"/>
    </x-slot>
</x-forms.collapse.creation>
