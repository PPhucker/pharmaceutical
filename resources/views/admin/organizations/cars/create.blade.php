<x-form
    :route="route('organization.cars.store')"
    formId="cars_add_form">
    <input type="hidden"
           name="car[organization_id]"
           value="{{$organization->id}}">
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="car_model"
                :text="__('contractors.cars.car_model')"/>
        </x-slot>
        <x-form.element.input
            id="car_model"
            name="car[car_model]"
            :value="old('car[car_model]')"
            :required="true"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="state_number"
                :text="__('contractors.cars.state_number')"/>
        </x-slot>
        <x-form.element.input
            id="state_number"
            name="car[state_number]"
            :value="old('car[state_number]')"
            :required="true"/>
    </x-form.row>
    <footer class="mt-auto me-auto">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <x-form.button.save formId="cars_add_form"/>
            </li>
        </ul>
    </footer>
</x-form>
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
