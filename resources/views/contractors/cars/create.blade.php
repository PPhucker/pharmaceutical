<x-forms.collapse.creation cardId="div_add_car"
                           errorName="car.*">
    <x-slot name="cardBody">
        <form id="form_add_car"
              method="POST"
              action="{{route('cars.store')}}">
            @csrf
            <input type="hidden"
                   name="car[contractor_id]"
                   value="{{$contractor->id}}">
            <x-forms.row id="car_model"
                         label="{{__('contractors.cars.car_model')}}">
                <input type="text"
                       name="car[car_model]"
                       id="car_model"
                       value="{{old('car.car_model')}}"
                       class="form-control form-control-sm text-primary
                       @error('car.car_model') is-invalid @enderror"
                       required>
                <x-forms.span-error name="car.car_model"/>
            </x-forms.row>
            <x-forms.row id="state_number"
                         label="{{__('contractors.cars.state_number')}}">
                <input type="text"
                       name="car[state_number]"
                       id="state_number"
                       value="{{old('car.state_number')}}"
                       class="form-control form-control-sm text-primary
                       @error('car.state_number') is-invalid @enderror"
                       required>
                <x-forms.span-error name="car.state_number"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_car"/>
    </x-slot>
</x-forms.collapse.creation>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#car_model').suggestions({
            token: $('#dadata_token').val(),
            type: 'car_brand',
            onSelect: function(suggestion) {
                const car = suggestion.data;
                $('#car_model').val(car.name_ru);
            },
        });
    });
</script>
