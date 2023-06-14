<x-forms.collapse.creation cardId="div_add_staff"
                           errorName="staff.*">
    <x-slot name="cardBody">
        <form id="form_add_staff"
              method="POST"
              action="{{route('staff.store')}}">
            @csrf
            <input type="hidden"
                   name="staff[organization_id]"
                   value="{{$organization->id}}">
            <x-forms.row id="place_of_business"
                         label="{{__('contractors.places_of_business.place_of_business')}}">
                <select id="place_of_business_id"
                        name="staff[organization_place_of_business_id]"
                        class="form-control form-control-sm text-primary
                        @error('staff.organization_place_of_business_id') is-invalid @enderror">
                    @foreach($organization->placesOfBusiness as $place)
                        <option value="{{$place->id}}">
                            {{$place->address}}
                        </option>
                    @endforeach
                </select>
                <x-forms.span-error name="staff.organization_place_of_business_id"/>
            </x-forms.row>
            <x-forms.row id="staff-name"
                         label="{{__('contractors.staff.name')}}">
                <input type="text"
                       name="staff[name]"
                       id="staff-name"
                       value="{{old('staff[name]')}}"
                       class="form-control form-control-sm text-primary
                       @error('staff.name') is-invalid @enderror"
                       required>
                <x-forms.span-error name="staff.name"/>
            </x-forms.row>
            <x-forms.row id="staff-post"
                         label="{{__('contractors.staff.post')}}">
                <select id="staff-post"
                        name="staff[post]"
                        class="form-control form-control-sm text-primary
                        @error('staff.post') is-invalid @enderror">
                    @foreach($employees as $key => $employee)
                        <option value="{{$key}}">
                            {{$employee}}
                        </option>
                    @endforeach
                </select>
                <x-forms.span-error name="staff.post"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_staff"/>
    </x-slot>
</x-forms.collapse.creation>
