@if($errors->any()){{dd($errors)}} @enderror
<x-forms.collapse.creation cardId="div_attach_aggregation_type"
                           errorName="aggregation_type.*">
    <x-slot name="cardBody">
        <form id="form_attach_aggregation_type"
              method="POST"
              action="{{route('end_products.attach_aggregation_type', ['end_product' => $end_product->id])}}">
            @method('PATCH')
            @csrf
            <x-forms.row id="code"
                         label="{{__('classifiers.nomenclature.products.types_of_aggregation.type_of_aggregation')}}">
                <select id="code"
                        name="aggregation_type[code]"
                        class="form-control form-control-sm
                        @error('aggregation_type.code') is-invalid @enderror"
                        required>
                    @foreach($aggregation_types as $type)
                        <option value="{{$type->code}}">
                            {{$type->code}} - {{$type->name}}
                        </option>
                    @endforeach
                </select>
            </x-forms.row>
            <x-forms.row id="product_quantity"
                         label="{{__('classifiers.nomenclature.products.types_of_aggregation.product_quantity')}}">
                <input id="product_quantity"
                       name="aggregation_type[product_quantity]"
                       class="form-control form-control-sm
                       @error('aggregation_type.product_quantity') is-invalid @enderror"
                       required>
                <x-forms.span-error name="product_quantity"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_attach_aggregation_type"/>
    </x-slot>
</x-forms.collapse.creation>
<x-forms.collapse.card route="{{route('end_products.update_product_quantity', ['end_product' => $end_product->id])}}"
                       cardId="card_aggregation_types"
                       formId="form_aggregation_types"
                       title="{{__('classifiers.nomenclature.products.types_of_aggregation.types_of_aggregation')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_aggregation_types"
                       targets="-1">
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="align-middle text-center border-start">
                    {{__('classifiers.nomenclature.products.types_of_aggregation.code')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('classifiers.nomenclature.products.types_of_aggregation.name')}}
                </th>
                <th scope="col"
                    class="text-center align-middle col-md-2">
                    {{__('classifiers.nomenclature.products.types_of_aggregation.product_quantity')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($end_product->aggregationTypes as $key => $type)
                <tr>
                    <input type="hidden"
                           name="aggregation_types[{{$key}}][code]"
                           value="{{$type->code}}">
                    <td class="align-middle border-start">
                    <span class="d-none">
                        {{$type->code}}
                    </span>
                        {{$type->code}}
                    </td>
                    <td class="align-middle">
                    <span class="d-none">
                        {{$type->name}}
                    </span>
                        {{$type->name}}
                    </td>
                    <td class="align-middle col-md-2">
                    <span class="d-none">
                        {{$type->pivot->product_quantity}}
                    </span>
                        <input type="text"
                               name="aggregation_types[{{$key}}][product_quantity]"
                               class="form-control form-control-sm mb-1 mt-1
                    @error('aggregation_types' . $key . '.product_quntity') is-invalid @enderror"
                               value="{{$type->pivot->product_quantity}}"
                               required>
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.detach
                            route="{{route('end_products.detach_aggregation_type', ['end_product' => $end_product->id])}}"
                            itemId="detach-aggregation-type-{{$type->code}}"
                            detachId="{{$type->code}}"
                            detachName="aggregation_type[code]"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.collapse formId="div_attach_aggregation_type"/>
        @if(count($end_product->aggregationTypes) > 0)
            <x-buttons.save formId="form_aggregation_types"/>
        @endif
    </x-slot>
</x-forms.collapse.card>
