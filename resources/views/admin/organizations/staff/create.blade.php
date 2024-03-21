<x-form
    :route="route('organization.staff.store')"
    formId="staff_add_form">
    <input type="hidden"
           name="staff[organization_id]"
           value="{{$organization->id}}"/>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="place_of_business_id"
                :text="__('contractors.places_of_business.place_of_business')"/>
        </x-slot>
        <x-form.element.select
            id="place_of_business_id"
            name="staff[organization_place_of_business_id]">
            @foreach($organization->placesOfBusiness as $place)
                <x-form.element.option
                    :value="$place->id"
                    :text="$place->address"/>
            @endforeach
        </x-form.element.select>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="name"
                :text="__('contractors.staff.name')"/>
        </x-slot>
        <x-form.element.input
            id="name"
            name="staff[name]"
            :value="old('staff[name]')"
            :required="true"/>
    </x-form.row>
    <x-form.row>
        <x-slot name="label">
            <x-form.label
                forId="post"
                :text="__('contractors.staff.post')"/>
        </x-slot>
        <x-form.element.select
            id="post"
            name="staff[post]">
            @foreach($posts as $value => $post)
                <x-form.element.option
                    :value="$value"
                    :text="$post"/>
            @endforeach
        </x-form.element.select>
    </x-form.row>
    <footer class="mt-auto me-auto">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <x-form.button.save formId="staff_add_form"/>
            </li>
        </ul>
    </footer>
</x-form>
