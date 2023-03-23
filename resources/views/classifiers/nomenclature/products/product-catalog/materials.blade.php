<x-forms.collapse.creation cardId="div_attach_material"
                           errorName="material.*">
    <x-slot name="cardBody">
        <form id="form_attach_material"
              method="POST"
              action="{{route('product_catalog.attach_material', ['product_catalog' => $product->id])}}">
            @method('PATCH')
            @csrf
            <x-forms.row id="id"
                         label="{{__('classifiers.nomenclature.materials.material')}}">
                <select id="id"
                        name="material[id]"
                        class="form-control form-control-sm
                        @error('material.id') is-invalid @enderror"
                        required>
                    @foreach($materials as $material)
                        <option value="{{$material->id}}">
                            {{$material->name}}
                        </option>
                    @endforeach
                </select>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_attach_material"/>
    </x-slot>
</x-forms.collapse.creation>
<x-forms.collapse.card route=""
                       cardId="card_materials"
                       formId="form_materials"
                       title="{{__('classifiers.nomenclature.materials.materials')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_materials"
                       targets="-1">
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                class="text-center align-middle">
                    {{'ID'}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('classifiers.nomenclature.materials.name')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('classifiers.nomenclature.materials.okei_code')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($product->materials as $key => $material)
                <tr>
                    <td class="text-center">
                    <span class="d-none">
                        {{$material->id}}
                    </span>
                        {{$material->id}}
                    </td>
                    <td>
                    <span class="d-none">
                        {{$material->name}}
                    </span>
                        {{$material->name}}
                    </td>
                    <td class="text-center">
                    <span class="d-none">
                        {{$material->okei->code}}
                    </span>
                        {{$material->okei->symbol}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.detach
                            route="{{route('product_catalog.detach_material', ['product_catalog' => $product->id])}}"
                            itemId="detach-material-{{$material->id}}"
                            detachId="{{$material->id}}"
                            detachName="material[id]"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.collapse formId="div_attach_material"/>
    </x-slot>
</x-forms.collapse.card>
