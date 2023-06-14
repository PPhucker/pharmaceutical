<x-forms.collapse.creation cardId="div_add_trailer"
                           errorName="trailer.*">
    <x-slot name="cardBody">
        <form id="form_add_trailer"
              method="POST"
              action="{{route('trailers.store')}}">
            @csrf
            <input type="hidden"
                   name="trailer[organization_id]"
                   value="{{$organization->id}}">
            <x-forms.row id="type"
                         label="{{__('contractors.trailers.type')}}">
                <select name="trailer[type]"
                        id="type"
                        class="form-control form-control-sm text-primary  @error('trailer.type') is-invalid @enderror">
                    <option value="п">Прицеп</option>
                    <option value="п/п">Полуприцеп</option>
                </select>
                <x-forms.span-error name="trailer.type"/>
            </x-forms.row>
            <x-forms.row id="state_number"
                         label="{{__('contractors.trailers.state_number')}}">
                <input type="text"
                       name="trailer[state_number]"
                       id="state_number"
                       value="{{old('trailer.state_number')}}"
                       class="form-control form-control-sm text-primary
                       @error('trailer.state_number') is-invalid @enderror"
                       required>
                <x-forms.span-error name="trailer.state_number"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_trailer"/>
    </x-slot>
</x-forms.collapse.creation>
